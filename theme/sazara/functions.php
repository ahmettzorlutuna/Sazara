<?php
/**
 * Sazara theme bootstrap (classic).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme version.
 * - Production: style.css'teki Version
 * - Dev (WP_DEBUG): mtime tabanlı timestamp — her edit'te asset URL değişir,
 *   browser cache nuke olur. Cache problemi yaşanmaz.
 */
define(
	'SAZARA_VERSION',
	( defined( 'WP_DEBUG' ) && WP_DEBUG )
		? (string) filemtime( __FILE__ )
		: wp_get_theme()->get( 'Version' )
);

define( 'SAZARA_DIR', get_template_directory() );
define( 'SAZARA_URI', get_template_directory_uri() );

/**
 * Modular includes — her biri kendi hook'unu kaydeder.
 */
$sazara_modules = [
	'inc/setup.php',
	'inc/helpers.php',
	'inc/shop-config.php',
	'inc/enqueue.php',
	'inc/routes.php',
	'inc/contact-form.php',
	'inc/dev-mail.php',
	'inc/perf.php',
	'inc/seo.php',
	'inc/post-types/ajax-content.php',
];

foreach ( $sazara_modules as $module ) {
	$path = SAZARA_DIR . '/' . $module;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

unset( $sazara_modules, $module, $path );
