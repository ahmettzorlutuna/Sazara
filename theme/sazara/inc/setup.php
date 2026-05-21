<?php
/**
 * Theme setup — classic theme features + nav menus + image sizes.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function () {
		// Title tag from <head> (WP-managed, plugin-friendly).
		add_theme_support( 'title-tag' );

		// Featured images.
		add_theme_support( 'post-thumbnails' );

		// HTML5 markup.
		add_theme_support(
			'html5',
			[ 'caption', 'comment-form', 'comment-list', 'gallery', 'script', 'search-form', 'style' ]
		);

		// Custom logo.
		add_theme_support(
			'custom-logo',
			[
				'height'      => 60,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
			]
		);

		// Wide and full alignment for post content (legacy editor + classic blocks).
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );

		// WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Custom image sizes — editorial layouts.
		add_image_size( 'sazara-hero', 1920, 1080, true );           // 16:9 anasayfa hero
		add_image_size( 'sazara-portrait', 1200, 1500, true );       // 4:5 ürün/portrait
		add_image_size( 'sazara-card-16-10', 1600, 1000, true );     // 16:10 service card
		add_image_size( 'sazara-card-4-3', 1024, 768, true );        // 4:3 generic card
		add_image_size( 'sazara-thumb-square', 600, 600, true );

		// Nav menus.
		register_nav_menus(
			[
				'primary' => __( 'Ana navigasyon', 'sazara' ),
				'footer'  => __( 'Footer linkleri', 'sazara' ),
				'legal'   => __( 'Hukuki linkler', 'sazara' ),
			]
		);
	}
);

/**
 * Favicon + apple-touch-icon — tema sembolünü `<head>` içine bas.
 *
 * SVG modern tarayıcılarda (Chrome, FF, Edge, Safari 16+) primary,
 * PNG fallback eski Safari + iOS için. Customizer site icon ayarı varsa
 * onu da WP otomatik basacaktır; biz tema sembolünü ek olarak veriyoruz.
 */
add_action(
	'wp_head',
	static function (): void {
		// Customizer'da site_icon belirlenmişse WP zaten kendisi basıyor — burada
		// brand sembolünü ek olarak basmak istemiyoruz. Aksi halde tema sembolü.
		if ( has_site_icon() ) {
			return;
		}

		$svg_url = get_template_directory_uri() . '/assets/brand/mark.svg';
		$png_url = content_url( 'uploads/brand/sazara-mark-512.png' );

		printf( '<link rel="icon" type="image/svg+xml" href="%s">' . "\n", esc_url( $svg_url ) );
		printf( '<link rel="icon" type="image/png" sizes="512x512" href="%s">' . "\n", esc_url( $png_url ) );
		printf( '<link rel="apple-touch-icon" sizes="512x512" href="%s">' . "\n", esc_url( $png_url ) );
	},
	5
);
