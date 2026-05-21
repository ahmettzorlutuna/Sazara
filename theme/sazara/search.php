<?php
/**
 * Search results.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="main">
	<section class="section">
		<div class="wrap">
			<header class="section__head">
				<span class="section__num"><?php esc_html_e( 'Arama', 'sazara' ); ?></span>
				<h1 class="section__title">
					<?php
					/* translators: %s: search query */
					printf( esc_html__( '"%s" için sonuçlar', 'sazara' ), esc_html( get_search_query() ) );
					?>
				</h1>
			</header>

			<?php if ( have_posts() ) : ?>
				<ul class="services" role="list">
					<?php while ( have_posts() ) : the_post(); ?>
						<li class="service-card reveal">
							<a href="<?php the_permalink(); ?>" class="service-card__media">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'sazara-card-16-10', [ 'loading' => 'lazy' ] ); ?>
								<?php endif; ?>
							</a>
							<div class="service-card__body">
								<span class="service-card__num"><?php echo esc_html( get_post_type() ); ?></span>
								<h2 class="service-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="service-card__desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
								<a href="<?php the_permalink(); ?>" class="service-card__cta"><?php esc_html_e( 'Görüntüle', 'sazara' ); ?></a>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<p style="color: var(--ink-soft);"><?php esc_html_e( 'Aramana uygun sonuç bulunamadı. Farklı bir kelimeyle deneyebilirsin.', 'sazara' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
