<?php
/**
 * 404 — Sayfa bulunamadı.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="main">
	<section class="section">
		<div class="wrap" style="text-align: center; padding-block: var(--space-xl);">
			<header class="section__head" style="align-items: center; max-width: 60ch; margin-inline: auto;">
				<span class="section__num">404</span>
				<h1 class="section__title" style="max-width: 18ch;"><?php esc_html_e( 'Aradığın sayfa burada değil.', 'sazara' ); ?></h1>
				<p class="section__lead"><?php esc_html_e( 'Belki adres değişti, belki yer değiştirdi. Anasayfadan devam edebilirsin.', 'sazara' ); ?></p>
			</header>
			<div class="hero__cta-row" style="justify-content: center; margin-top: var(--space-md);">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
					<span><?php esc_html_e( 'Anasayfaya dön', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
