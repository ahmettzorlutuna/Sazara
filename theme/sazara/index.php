<?php
/**
 * Fallback template — listing & single olmadığında.
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
				<h1 class="section__title"><?php
					if ( is_home() ) {
						single_post_title();
					} elseif ( is_archive() ) {
						the_archive_title();
					} else {
						esc_html_e( 'İçerik', 'sazara' );
					}
				?></h1>
				<?php
				if ( is_archive() && get_the_archive_description() ) {
					echo '<p class="section__lead">' . wp_kses_post( get_the_archive_description() ) . '</p>';
				}
				?>
			</header>

			<?php if ( have_posts() ) : ?>
				<ul class="services" role="list">
					<?php while ( have_posts() ) : the_post(); ?>
						<li class="service-card reveal">
							<a href="<?php the_permalink(); ?>" class="service-card__media">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'sazara-card-16-10', [ 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
								<?php endif; ?>
							</a>
							<div class="service-card__body">
								<span class="service-card__num"><?php echo esc_html( get_the_date() ); ?></span>
								<h2 class="service-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="service-card__desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
								<a href="<?php the_permalink(); ?>" class="service-card__cta"><?php esc_html_e( 'Devamını oku', 'sazara' ); ?></a>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php
				the_posts_pagination(
					[
						'prev_text' => '← ' . esc_html__( 'Önceki', 'sazara' ),
						'next_text' => esc_html__( 'Sonraki', 'sazara' ) . ' →',
					]
				);
				?>
			<?php else : ?>
				<p><?php esc_html_e( 'Henüz içerik yok.', 'sazara' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
