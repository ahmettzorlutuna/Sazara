<?php
/**
 * Performance + head cleanup.
 *
 * Classic theme — WP'nin block-library / global-styles asset'leri zaten
 * minimum, sadece bloklu kullanım var. Burada SADECE temizlik yapılır:
 * emoji, jQuery (front-end gerek yok), gereksiz <head> meta'ları.
 *
 * NOT: 'global-styles' ASLA dequeue edilmez. theme.json kullanmıyoruz
 * (classic theme), o yüzden zaten minimum etkili.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Disable WordPress emoji on the front-end.
 */
add_action(
	'init',
	static function () {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		add_filter(
			'tiny_mce_plugins',
			static fn( $plugins ) => array_diff( (array) $plugins, [ 'wpemoji' ] )
		);
		add_filter( 'emoji_svg_url', '__return_false' );
	}
);

/**
 * Remove unnecessary <head> bloat.
 */
add_action(
	'init',
	static function () {
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );

		add_filter( 'the_generator', '__return_empty_string' );
	}
);

/**
 * Disable XML-RPC entirely.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Block REST /users for unauthenticated calls (username enumeration).
 */
add_filter(
	'rest_authentication_errors',
	static function ( $result ) {
		if ( ! empty( $result ) ) {
			return $result;
		}

		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$uri = sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) );
			if ( false !== strpos( $uri, '/wp-json/wp/v2/users' ) && ! is_user_logged_in() ) {
				return new WP_Error(
					'rest_user_listing_disabled',
					__( 'Yetkisiz.', 'sazara' ),
					[ 'status' => 401 ]
				);
			}
		}

		return $result;
	}
);

/**
 * Limit post revisions and autosave.
 */
add_action(
	'init',
	static function () {
		if ( ! defined( 'WP_POST_REVISIONS' ) ) {
			define( 'WP_POST_REVISIONS', 5 );
		}
		if ( ! defined( 'AUTOSAVE_INTERVAL' ) ) {
			define( 'AUTOSAVE_INTERVAL', 120 );
		}
	}
);
