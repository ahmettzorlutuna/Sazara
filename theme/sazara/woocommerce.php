<?php
/**
 * WooCommerce master template — tüm WC route'ları (shop, kategori, ürün) için.
 * Vitrin (catalog) modu — sepet/checkout kapalı, "Teklif al" CTA'sı.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="main">
	<section class="section">
		<div class="wrap">

			<?php if ( is_singular( 'product' ) ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<header class="section__head">
						<span class="section__num"><?php echo esc_html( get_the_term_list( get_the_ID(), 'product_cat', '', ' / ', '' ) ); ?></span>
						<h1 class="section__title"><?php the_title(); ?></h1>
					</header>

					<div class="services" style="grid-template-columns: 1fr;">
						<div class="service-card">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="service-card__media">
									<?php the_post_thumbnail( 'sazara-portrait', [ 'loading' => 'eager' ] ); ?>
								</div>
							<?php endif; ?>
							<div class="service-card__body">
								<div class="service-card__desc"><?php the_content(); ?></div>
								<div class="hero__cta-row" style="margin-top: var(--space-md);">
									<?php
									$product = wc_get_product( get_the_ID() );
									$wa_text = rawurlencode( sprintf( 'Merhaba, %s ürünü için teklif almak istiyorum.', get_the_title() ) );
									?>
									<a href="https://wa.me/905555555555?text=<?php echo esc_attr( $wa_text ); ?>" class="btn btn--primary">
										<span><?php esc_html_e( 'WhatsApp ile teklif al', 'sazara' ); ?></span>
										<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
									</a>
									<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="btn btn--ghost"><?php esc_html_e( 'İletişim formu', 'sazara' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>

			<?php else : ?>
				<header class="section__head">
					<span class="section__num"><?php esc_html_e( 'Ürünler', 'sazara' ); ?></span>
					<h1 class="section__title">
						<?php
						if ( is_product_category() ) {
							single_term_title();
						} else {
							woocommerce_page_title();
						}
						?>
					</h1>
				</header>

				<?php if ( woocommerce_product_loop() ) : ?>
					<ul class="services" role="list">
						<?php
						if ( wc_get_loop_prop( 'is_shortcode' ) ) {
							$columns = absint( wc_get_loop_prop( 'columns' ) );
						} else {
							$columns = wc_get_default_products_per_row();
						}
						wc_set_loop_prop( 'columns', $columns );

						while ( have_posts() ) :
							the_post();
							global $product;
							?>
							<li class="service-card reveal">
								<a href="<?php the_permalink(); ?>" class="service-card__media">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'sazara-card-4-3', [ 'loading' => 'lazy' ] ); ?>
									<?php endif; ?>
									<?php
									$tags = get_the_terms( get_the_ID(), 'product_cat' );
									if ( $tags && ! is_wp_error( $tags ) ) :
										?>
										<span class="service-card__tag"><?php echo esc_html( $tags[0]->name ); ?></span>
									<?php endif; ?>
								</a>
								<div class="service-card__body">
									<h2 class="service-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<p class="service-card__desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
									<a href="<?php the_permalink(); ?>" class="service-card__cta"><?php esc_html_e( 'Detay', 'sazara' ); ?></a>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php woocommerce_pagination(); ?>
				<?php else : ?>
					<p style="color: var(--ink-soft);"><?php esc_html_e( 'Bu kategoride henüz ürün yok.', 'sazara' ); ?></p>
				<?php endif; ?>
			<?php endif; ?>

		</div>
	</section>
</main>

<?php
get_footer();
