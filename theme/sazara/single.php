<?php
/**
 * Default single post template.
 * Faz 2'de single-service.php, single-product.php gibi özel template'ler.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="main">
	<section class="section">
		<div class="wrap">

			<?php while ( have_posts() ) : the_post(); ?>
				<header class="section__head">
					<span class="section__num"><?php echo esc_html( get_the_date() ); ?></span>
					<h1 class="section__title"><?php the_title(); ?></h1>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="atmosphere" style="margin-bottom: var(--space-lg);">
						<?php the_post_thumbnail( 'sazara-hero', [ 'loading' => 'eager', 'fetchpriority' => 'high' ] ); ?>
					</figure>
				<?php endif; ?>

				<article class="page-content" style="max-width: 62ch;">
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>

		</div>
	</section>
</main>

<?php
get_footer();
