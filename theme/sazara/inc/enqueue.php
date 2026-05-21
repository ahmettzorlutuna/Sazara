<?php
/**
 * Asset enqueueing.
 *
 * Strategy:
 * - Critical CSS inlined in <head> (~5kb gzipped).
 * - main.css (tüm component CSS'leri) async preload + onload swap.
 * - Variable fonts preloaded.
 * - Vanilla JS deferred.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Inline critical CSS in <head>.
 */
add_action(
	'wp_head',
	static function () {
		$critical_path = SAZARA_DIR . '/assets/css/critical.css';
		if ( ! file_exists( $critical_path ) ) {
			return;
		}

		$css = file_get_contents( $critical_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		if ( false === $css ) {
			return;
		}

		printf(
			'<style id="sazara-critical">%s</style>',
			$css // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	},
	1
);

/**
 * Preload variable fonts (Latin + Latin-Ext zaten dosyada).
 */
add_action(
	'wp_head',
	static function () {
		$fonts = [ 'Geist-Variable.woff2', 'GeistMono-Variable.woff2' ];

		foreach ( $fonts as $file ) {
			$path = SAZARA_DIR . '/assets/fonts/' . $file;
			if ( ! file_exists( $path ) ) {
				continue;
			}
			$url = SAZARA_URI . '/assets/fonts/' . $file;
			printf(
				'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin="anonymous">' . "\n",
				esc_url( $url )
			);
		}
	},
	2
);

/**
 * Enqueue stylesheets and scripts.
 */
add_action(
	'wp_enqueue_scripts',
	static function () {
		// Tokens (custom properties). Inline render-blocking — first paint için.
		wp_enqueue_style(
			'sazara-tokens',
			SAZARA_URI . '/assets/css/tokens.css',
			[],
			SAZARA_VERSION
		);

		// Main stylesheet — tüm component CSS'leri tek dosyada.
		wp_enqueue_style(
			'sazara-main',
			SAZARA_URI . '/assets/css/main.css',
			[ 'sazara-tokens' ],
			SAZARA_VERSION
		);

		// Vanilla JS — reveal observer + nav scroll-state + mobile drawer.
		wp_enqueue_script(
			'sazara-main',
			SAZARA_URI . '/assets/js/main.js',
			[],
			SAZARA_VERSION,
			[ 'in_footer' => true, 'strategy' => 'defer' ]
		);
	}
);

/**
 * Editor stylesheet — block editor görünümü.
 */
add_action(
	'enqueue_block_editor_assets',
	static function () {
		$editor = SAZARA_DIR . '/assets/css/main.css';
		if ( file_exists( $editor ) ) {
			wp_enqueue_style(
				'sazara-editor',
				SAZARA_URI . '/assets/css/main.css',
				[],
				SAZARA_VERSION
			);
		}
	}
);
