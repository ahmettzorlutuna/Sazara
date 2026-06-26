<?php
/**
 * Ajax içeriği tekil sayfası (/ajax-alarm/<post>/).
 *
 * Hero (başlık + meta) → İçerik gövdesi → İlgili içerikler → CTA.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$topics      = get_the_terms( get_the_ID(), 'ajax_topic' );
	$topics      = ( $topics && ! is_wp_error( $topics ) ) ? $topics : [];
	$first_topic = $topics ? $topics[0] : null;

	// İlgili içerikler — aynı konudaki diğer yazılar.
	$related = [];
	if ( $first_topic ) {
		$related_query = new WP_Query(
			[
				'post_type'      => 'ajax_content',
				'posts_per_page' => 3,
				'post__not_in'   => [ get_the_ID() ],
				'tax_query'      => [
					[
						'taxonomy' => 'ajax_topic',
						'field'    => 'term_id',
						'terms'    => $first_topic->term_id,
					],
				],
			]
		);
		$related = $related_query->posts;
	}
	?>

	<main id="main-content" class="main">

		<!-- ════════ HERO ════════ -->
		<section class="hero hero--compact ajax-hub-single__hero">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="hero__media">
					<?php the_post_thumbnail( 'sazara-hero', [ 'loading' => 'eager', 'fetchpriority' => 'high' ] ); ?>
				</div>
			<?php else : ?>
				<div class="hero__media">
					<img src="/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg" alt="" loading="eager" fetchpriority="high">
				</div>
			<?php endif; ?>
			<div class="wrap hero__content hero__content--compact">
				<p class="hero__eyebrow">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'ajax_content' ) ); ?>" class="ajax-hub-single__crumb">
						<?php esc_html_e( 'Ajax Bilgi Merkezi', 'sazara' ); ?>
					</a>
					<?php if ( $first_topic ) : ?>
						<span aria-hidden="true"> · </span>
						<a href="<?php echo esc_url( get_term_link( $first_topic ) ); ?>" class="ajax-hub-single__crumb">
							<?php echo esc_html( $first_topic->name ); ?>
						</a>
					<?php endif; ?>
				</p>
				<h1 class="hero__title hero__title--small"><?php the_title(); ?></h1>
				<p class="hero__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<p class="ajax-hub-single__meta">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
					</time>
				</p>
			</div>
		</section>

		<!-- ════════ İÇERİK GÖVDESİ ════════ -->
		<section class="section ajax-hub-single__body">
			<div class="wrap wrap--narrow">
				<article class="ajax-hub-article reveal">
					<?php the_content(); ?>
				</article>
			</div>
		</section>

		<!-- ════════ İLGİLİ İÇERİKLER ════════ -->
		<?php if ( ! empty( $related ) ) : ?>
		<section class="section section--canvas">
			<div class="wrap">
				<header class="section__head reveal">
					<span class="section__num"><?php esc_html_e( 'İlgili içerikler', 'sazara' ); ?></span>
					<h2 class="section__title">
						<?php
						/* translators: %s: topic name */
						printf( esc_html__( 'Aynı konuda diğer notlar: %s', 'sazara' ), esc_html( $first_topic->name ) );
						?>
					</h2>
				</header>

				<ul class="case-grid case-grid--3col ajax-hub-grid" role="list">
					<?php foreach ( $related as $rel ) : ?>
						<li class="case-card reveal">
							<a href="<?php echo esc_url( get_permalink( $rel ) ); ?>"
							   class="case-card__media"
							   aria-label="<?php echo esc_attr( get_the_title( $rel ) ); ?>">
								<?php if ( has_post_thumbnail( $rel ) ) : ?>
									<?php echo get_the_post_thumbnail( $rel, 'sazara-card-4-3', [ 'loading' => 'lazy' ] ); ?>
								<?php else : ?>
									<img src="/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg" alt="" loading="lazy">
								<?php endif; ?>
							</a>
							<div class="case-card__body">
								<span class="case-card__meta"><?php echo esc_html( get_the_date( 'd M Y', $rel ) ); ?></span>
								<h3 class="case-card__title">
									<a href="<?php echo esc_url( get_permalink( $rel ) ); ?>"><?php echo esc_html( get_the_title( $rel ) ); ?></a>
								</h3>
								<p class="case-card__tagline"><?php echo esc_html( wp_trim_words( get_the_excerpt( $rel ), 18 ) ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
		<?php endif; ?>

		<!-- ════════ CTA ════════ -->
		<section class="cta">
			<div class="wrap">
				<div class="cta__inner reveal">
					<h2 class="cta__title"><?php esc_html_e( 'Bu içerikteki konuda yardım lazım mı?', 'sazara' ); ?></h2>
					<p class="cta__lead"><?php esc_html_e( 'Saha keşfinden kuruluma kadar Sazara olarak yanındayız.', 'sazara' ); ?></p>
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

<?php endwhile; ?>

<?php
get_footer();
