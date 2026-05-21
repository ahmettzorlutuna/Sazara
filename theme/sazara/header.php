<?php
/**
 * The header — every page's <head> + opening <body> + sticky nav.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e( 'İçeriğe atla', 'sazara' ); ?></a>

<nav class="nav" id="site-nav" aria-label="<?php esc_attr_e( 'Ana navigasyon', 'sazara' ); ?>">
	<div class="wrap nav__inner">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__brand" aria-label="<?php esc_attr_e( 'Sazara — Anasayfa', 'sazara' ); ?>">
			<span class="nav__brand-mark" aria-hidden="true">
				<?php echo sazara_inline_svg( 'assets/brand/mark.svg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
			<span class="nav__brand-name" aria-hidden="true">
				<?php echo sazara_inline_svg( 'assets/brand/wordmark.svg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
		</a>

		<button type="button" class="nav__toggle" aria-controls="site-nav-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menüyü aç', 'sazara' ); ?>">
			<span class="nav__toggle-bar"></span>
			<span class="nav__toggle-bar"></span>
			<span class="nav__toggle-bar"></span>
		</button>

		<div id="site-nav-menu" class="nav__menu">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					[
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'nav__list',
						'depth'          => 1,
						'fallback_cb'    => false,
					]
				);
			} else {
				// Fallback when no menu has been assigned in admin.
				?>
				<ul class="nav__list">
					<li><a href="<?php echo esc_url( home_url( '/hizmetler/' ) ); ?>"><?php esc_html_e( 'Hizmetler', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/ajax/' ) ); ?>" class="nav__link--ajax"><?php esc_html_e( 'Ajax', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/urunler/' ) ); ?>"><?php esc_html_e( 'Ürünler', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/referanslar/' ) ); ?>"><?php esc_html_e( 'Referanslar', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/hakkimizda/' ) ); ?>"><?php esc_html_e( 'Hakkımızda', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>"><?php esc_html_e( 'İletişim', 'sazara' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>

		<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="nav__cta">
			<span><?php esc_html_e( 'Teklif al', 'sazara' ); ?></span>
			<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
		</a>

	</div>
</nav>
