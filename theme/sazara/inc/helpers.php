<?php
/**
 * Tema içi yardımcı fonksiyonlar.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * SVG dosyasını inline olarak oku. currentColor + CSS rengi geçişi için
 * <img> yerine inline SVG kullanılır. Sonuç in-memory cache'lenir.
 *
 * Güvenlik notu: Sadece tema klasörü içinden dosya okur — file_get_contents
 * çıktısı tema yazarına aittir (kullanıcı girdisi değil), bu yüzden HTML'e
 * doğrudan basılır.
 *
 * @param string $relative_path Tema kökünden göreli yol (örn. "assets/logos/atlas.svg").
 * @return string SVG markup veya boş string.
 */
function sazara_inline_svg( $relative_path ) {
	static $cache = [];

	if ( ! is_string( $relative_path ) || '' === $relative_path ) {
		return '';
	}

	if ( isset( $cache[ $relative_path ] ) ) {
		return $cache[ $relative_path ];
	}

	$full = SAZARA_DIR . '/' . ltrim( $relative_path, '/' );

	// Path traversal koruması — tema dışına çıkamasın.
	$real = realpath( $full );
	if ( false === $real || 0 !== strpos( $real, realpath( SAZARA_DIR ) ) ) {
		$cache[ $relative_path ] = '';
		return '';
	}

	if ( ! file_exists( $real ) || 'svg' !== strtolower( pathinfo( $real, PATHINFO_EXTENSION ) ) ) {
		$cache[ $relative_path ] = '';
		return '';
	}

	$cache[ $relative_path ] = (string) file_get_contents( $real );
	return $cache[ $relative_path ];
}

/**
 * uploads/ altındaki bir logo yolunu kullanılabilir URL'e çevirir.
 *
 * Toleranslı — şu formatların hepsini kabul eder:
 *   - 'customer-logos/sarper.png'                          (uploads'a göreli — ideal)
 *   - '/wp-content/uploads/customer-logos/sarper.png'      (site köküne göreli)
 *   - '/Users/.../sazara-mvp/uploads/customer-logos/x.png' (tam dosya yolu)
 *   - 'https://.../sarper.png'                              (harici URL)
 *
 * Dosya gerçekten yoksa boş string döner (çağıran taraf text fallback'e düşer).
 *
 * @param string $logo Ham logo değeri (data dosyasından).
 * @return string Kullanılabilir URL veya ''.
 */
function sazara_resolve_upload_logo( $logo ) {
	if ( ! is_string( $logo ) || '' === trim( $logo ) ) {
		return '';
	}

	$logo = trim( $logo );

	// Zaten tam URL ise olduğu gibi kullan.
	if ( preg_match( '#^https?://#i', $logo ) ) {
		return esc_url_raw( $logo );
	}

	// Tam dosya yolu ya da site-köküne göreli yol → "uploads/" sonrasını al.
	if ( false !== strpos( $logo, '/uploads/' ) ) {
		$logo = substr( $logo, strpos( $logo, '/uploads/' ) + strlen( '/uploads/' ) );
	} elseif ( 0 === strpos( $logo, 'uploads/' ) ) {
		$logo = substr( $logo, strlen( 'uploads/' ) );
	}

	$relative  = ltrim( $logo, '/' );
	$full_path = WP_CONTENT_DIR . '/uploads/' . $relative;

	if ( '' === $relative || ! file_exists( $full_path ) ) {
		return '';
	}

	return content_url( 'uploads/' . $relative );
}

/**
 * Hero görseli olan sayfalarda body'e `has-hero-image` class'ı ekle.
 *
 * SAZARA_TRANSPARENT_NAV_ON_HERO = true  → hero üzerinde nav transparent + beyaz text
 *                                           (scroll yapınca solid white'a geçer)
 * SAZARA_TRANSPARENT_NAV_ON_HERO = false → nav her sayfada solid (dolgulu beyaz)
 *
 * Davranışı değiştirmek için aşağıdaki const'ı true ↔ false geç.
 */
const SAZARA_TRANSPARENT_NAV_ON_HERO = false;

add_filter(
	'body_class',
	static function ( array $classes ): array {
		if ( ! SAZARA_TRANSPARENT_NAV_ON_HERO ) {
			return $classes;
		}

		$pages_with_hero = [
			'hakkimizda',
			'iletisim',
			'hizmetler',
			'referanslar',
		];

		if ( is_front_page() ) {
			$classes[] = 'has-hero-image';
			return $classes;
		}

		if ( is_page( $pages_with_hero ) ) {
			$classes[] = 'has-hero-image';
			return $classes;
		}

		// Child page'ler (örn. /hizmetler/kamera-sistemleri/, /referanslar/{slug}/)
		// — parent slug yukarıdaki listede ise hero'lu sayılır.
		$post = get_post();
		if ( $post && $post->post_parent ) {
			$parent_slug = get_post_field( 'post_name', $post->post_parent );
			if ( in_array( $parent_slug, [ 'hizmetler', 'referanslar' ], true ) ) {
				$classes[] = 'has-hero-image';
			}
		}

		return $classes;
	}
);
