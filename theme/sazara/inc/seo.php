<?php
/**
 * Light SEO — Rank Math veya Yoast yoksa fallback olarak çalışır.
 * Plugin varsa onu rahatsız etmez (priority 1, plugin priority 10+).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set viewport + theme-color + basic OG tags if no SEO plugin handles them.
 */
add_action(
	'wp_head',
	static function () {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">' . "\n";
		echo '<meta name="theme-color" content="#0d0d0e">' . "\n";

		// Rank Math veya Yoast varsa OG tags'ı kendileri yönetir.
		if ( class_exists( 'RankMath' ) || defined( 'WPSEO_VERSION' ) ) {
			return;
		}

		// Fallback OG tags.
		$title = wp_get_document_title();
		$desc  = is_singular() ? wp_strip_all_tags( get_the_excerpt() ) : get_bloginfo( 'description' );

		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
		if ( ! empty( $desc ) ) {
			printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		printf( '<meta property="og:type" content="%s">' . "\n", is_singular() ? 'article' : 'website' );
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( home_url( $_SERVER['REQUEST_URI'] ?? '/' ) ) );

		if ( is_singular() && has_post_thumbnail() ) {
			$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sazara-hero' );
			if ( $img ) {
				printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img[0] ) );
			}
		}
	},
	3
);
