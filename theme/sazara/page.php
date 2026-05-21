<?php
/**
 * Default page template.
 * Faz 2'de hakkimizda, iletisim, kvkk gibi sayfalar için özel template'ler ekleyeceğiz.
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
					<h1 class="section__title"><?php the_title(); ?></h1>
				</header>

				<article class="page-content" style="max-width: 62ch;">
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>

		</div>
	</section>
</main>

<?php
get_footer();
