<?php
/**
 * Custom routing — sayfaları kodda yöneten ince katman.
 *
 * - Auto-create: tema aktive olunca eksik page'leri otomatik yaratır.
 *   Parent destekli — child page'ler için "parent" anahtarı kullanılır.
 *   Sen admin'e girmiyorsun, content boş kalır, sadece URL için.
 * - Case child page'leri: inc/cases-data.php'den dinamik olarak okunur,
 *   'referanslar' parent'ı altına otomatik yerleşir.
 * - template_include filter: slug bazlı template eşleştirme.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Slug → [ title, parent? ] eşlemesi. Auto-create için statik sayfalar.
 *
 * Sıra önemli: parent page'ler child'lardan ÖNCE gelmeli.
 */
const SAZARA_PAGES = [
	'hakkimizda'  => [ 'title' => 'Hakkımızda' ],
	'iletisim'    => [ 'title' => 'İletişim' ],
	'hizmetler'   => [ 'title' => 'Hizmetler' ],
	'referanslar' => [ 'title' => 'Referanslar' ],
	'ajax'        => [ 'title' => 'Ajax Güvenlik' ],

	// Hizmetler altındaki child page'ler
	'kamera-sistemleri'   => [ 'title' => 'Kamera Sistemleri ve Güvenlik', 'parent' => 'hizmetler' ],
	'network-it-altyapi'  => [ 'title' => 'Ağ ve IT Altyapı',              'parent' => 'hizmetler' ],
	'ajax-kablosuz-alarm' => [ 'title' => 'Ajax Kablosuz Alarm',           'parent' => 'hizmetler' ],
	'yazilim-gelistirme'  => [ 'title' => 'Yazılım Geliştirme',            'parent' => 'hizmetler' ],
];

/**
 * Slug → custom template path eşlemesi. Statik sayfalar için.
 * Case slug'ları dinamik olarak templates/case.php'ye yönlendirilir
 * (template_include filter'da).
 */
const SAZARA_TEMPLATE_MAP = [
	'hakkimizda'  => 'templates/about.php',
	'iletisim'    => 'templates/contact.php',
	'hizmetler'   => 'templates/services-archive.php',
	'referanslar' => 'templates/cases-archive.php',
	'ajax'        => 'templates/ajax.php',

	// 4 hizmet aynı template'i kullanır, içerik slug bazlı services-data.php'den gelir
	'kamera-sistemleri'   => 'templates/service.php',
	'network-it-altyapi'  => 'templates/service.php',
	'ajax-kablosuz-alarm' => 'templates/service.php',
	'yazilim-gelistirme'  => 'templates/service.php',
];

/**
 * Cases verisini cache'li olarak yükle. Birden fazla yerden okunur.
 *
 * @return array<string, array<string, mixed>> slug => case data
 */
function sazara_load_cases() {
	static $cache = null;
	if ( null !== $cache ) {
		return $cache;
	}
	$cache = require SAZARA_DIR . '/inc/cases-data.php';
	return is_array( $cache ) ? $cache : [];
}

/**
 * Eksik page'leri yarat (init'te, idempotent).
 *
 * Versiyon hash'i case slug'larını da içerir — yeni case eklendiğinde
 * flag eşleşmez, init tekrar çalışır ve yeni child page oluşur.
 */
add_action(
	'init',
	static function () {
		$cases      = sazara_load_cases();
		$case_slugs = array_keys( $cases );

		$flag_key   = 'sazara_pages_v1';
		$flag_value = '3.1-' . md5( implode( ',', $case_slugs ) );

		if ( get_option( $flag_key ) === $flag_value ) {
			return;
		}

		// ─── Statik sayfalar (SAZARA_PAGES) ───
		foreach ( SAZARA_PAGES as $slug => $config ) {
			if ( get_page_by_path( $slug ) ) {
				continue;
			}

			$parent_id = 0;
			if ( ! empty( $config['parent'] ) ) {
				$parent_page = get_page_by_path( $config['parent'] );
				if ( $parent_page ) {
					$parent_id = $parent_page->ID;
				}
			}

			wp_insert_post(
				[
					'post_title'     => $config['title'],
					'post_name'      => $slug,
					'post_content'   => '',
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'post_parent'    => $parent_id,
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				]
			);
		}

		// ─── Case child sayfaları (parent = 'referanslar') ───
		$referanslar_page = get_page_by_path( 'referanslar' );
		$referanslar_id   = $referanslar_page ? $referanslar_page->ID : 0;

		foreach ( $cases as $slug => $case ) {
			if ( get_page_by_path( $slug ) ) {
				continue;
			}

			wp_insert_post(
				[
					'post_title'     => $case['title'],
					'post_name'      => $slug,
					'post_content'   => '',
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'post_parent'    => $referanslar_id,
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				]
			);
		}

		update_option( $flag_key, $flag_value );
		flush_rewrite_rules( false );
	}
);

/**
 * Slug bazlı template router.
 *
 * 1) Statik map'te varsa onu kullan.
 * 2) Case slug'ı ise templates/case.php'yi kullan.
 * 3) Aksi halde varsayılan template.
 */
add_filter(
	'template_include',
	static function ( $template ) {
		if ( ! is_page() ) {
			return $template;
		}

		$slug = get_post_field( 'post_name', get_post() );
		if ( ! $slug ) {
			return $template;
		}

		// 1) Statik template map
		if ( isset( SAZARA_TEMPLATE_MAP[ $slug ] ) ) {
			$custom = SAZARA_DIR . '/' . SAZARA_TEMPLATE_MAP[ $slug ];
			if ( file_exists( $custom ) ) {
				return $custom;
			}
		}

		// 2) Case slug'ı kontrolü → templates/case.php
		$cases = sazara_load_cases();
		if ( isset( $cases[ $slug ] ) ) {
			$custom = SAZARA_DIR . '/templates/case.php';
			if ( file_exists( $custom ) ) {
				return $custom;
			}
		}

		return $template;
	}
);
