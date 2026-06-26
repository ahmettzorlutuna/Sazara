<?php
/**
 * Ajax içerik hub'ı arşivi (/ajax-alarm/).
 *
 * Hero → Konu filtresi → Yazı grid → CTA.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$topics = get_terms(
	[
		'taxonomy'   => 'ajax_topic',
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC',
	]
);

if ( is_wp_error( $topics ) ) {
	$topics = [];
}

$active_topic = is_tax( 'ajax_topic' ) ? get_queried_object() : null;

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact">
		<div class="hero__media">
			<img src="/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg" alt="" loading="eager" fetchpriority="high">
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php esc_html_e( 'Ajax Kablosuz Alarm · Bilgi Merkezi', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--small"><?php esc_html_e( 'Ajax\'ı tanımak ve doğru kurmak için her şey.', 'sazara' ); ?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Ürün kılavuzları, kurulum senaryoları, ev/işyeri karşılaştırmaları ve sık sorulan sorular. Saha tecrübemizden çıkardığımız notları burada topluyoruz.', 'sazara' ); ?></p>
		</div>
	</section>

	<!-- ════════ KONU FİLTRESİ ════════ -->
	<?php if ( ! empty( $topics ) ) : ?>
	<section class="section ajax-hub-filter-section">
		<div class="wrap">
			<nav class="ajax-hub-filter reveal" aria-label="<?php esc_attr_e( 'Konuya göre filtrele', 'sazara' ); ?>">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'ajax_content' ) ); ?>"
				   class="ajax-hub-filter__pill<?php echo ! $active_topic ? ' is-active' : ''; ?>">
					<?php esc_html_e( 'Tümü', 'sazara' ); ?>
				</a>
				<?php foreach ( $topics as $topic ) : ?>
					<a href="<?php echo esc_url( get_term_link( $topic ) ); ?>"
					   class="ajax-hub-filter__pill<?php echo ( $active_topic && (int) $active_topic->term_id === (int) $topic->term_id ) ? ' is-active' : ''; ?>">
						<?php echo esc_html( $topic->name ); ?>
						<span class="ajax-hub-filter__count"><?php echo (int) $topic->count; ?></span>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ YAZI GRID ════════ -->
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num">
					<?php
					if ( $active_topic ) {
						/* translators: %s: topic name */
						printf( esc_html__( 'Konu: %s', 'sazara' ), esc_html( $active_topic->name ) );
					} else {
						esc_html_e( 'Tüm içerikler', 'sazara' );
					}
					?>
				</span>
				<h2 class="section__title">
					<?php
					if ( $active_topic ) {
						echo esc_html( $active_topic->name );
					} else {
						esc_html_e( 'Saha notları, kurulum kılavuzları ve karşılaştırmalar.', 'sazara' );
					}
					?>
				</h2>
				<?php if ( $active_topic && $active_topic->description ) : ?>
					<p class="section__lead"><?php echo esc_html( $active_topic->description ); ?></p>
				<?php endif; ?>
			</header>

			<?php if ( have_posts() ) : ?>
				<ul class="case-grid case-grid--3col ajax-hub-grid" role="list">
					<?php
					while ( have_posts() ) :
						the_post();
						$post_topics = get_the_terms( get_the_ID(), 'ajax_topic' );
						$first_topic = ( $post_topics && ! is_wp_error( $post_topics ) ) ? $post_topics[0] : null;
						?>
						<li class="case-card reveal">
							<a href="<?php the_permalink(); ?>"
							   class="case-card__media"
							   aria-label="<?php echo esc_attr( get_the_title() ); ?>">
								<?php if ( $first_topic ) : ?>
									<span class="case-card__sector"><?php echo esc_html( $first_topic->name ); ?></span>
								<?php endif; ?>
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'sazara-card-4-3', [ 'loading' => 'lazy' ] ); ?>
								<?php else : ?>
									<img src="/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg" alt="" loading="lazy">
								<?php endif; ?>
							</a>
							<div class="case-card__body">
								<span class="case-card__meta">
									<?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
								</span>
								<h3 class="case-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p class="case-card__tagline"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
								<div class="case-card__footer">
									<span class="case-card__scope"><?php esc_html_e( 'Okumaya başla', 'sazara' ); ?></span>
									<span class="case-card__arrow" aria-hidden="true">
										<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
									</span>
								</div>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>

				<?php
				the_posts_pagination(
					[
						'mid_size'  => 2,
						'prev_text' => __( '← Önceki', 'sazara' ),
						'next_text' => __( 'Sonraki →', 'sazara' ),
					]
				);
				?>
			<?php else : ?>
				<p class="ajax-hub-empty">
					<?php esc_html_e( 'Bu konuda henüz içerik yayınlanmadı. Yakında.', 'sazara' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</section>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Ajax kurulumu mu düşünüyorsun?', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Saha keşfiyle başlıyoruz, doğru sensör + doğru topoloji öneriyoruz, sertifikalı kurulum bizden.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="btn btn--primary">
						<span><?php esc_html_e( 'Teklif al', 'sazara' ); ?></span>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
					<a href="https://wa.me/905555555555" class="btn btn--ghost">WhatsApp</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
