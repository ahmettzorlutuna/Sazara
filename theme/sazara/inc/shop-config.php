<?php
/**
 * Shop (sazarateknoloji.com) cross-site config — single source of truth.
 *
 * Şu an Bölüm B (e-ticaret sitesi) henüz canlı değil ve sazarateknoloji.com
 * domain'i sazara.com.tr'ye 301 redirect ediyor. Bir kullanıcının shop CTA'sına
 * tıklaması redirect loop UX'ine yol açar. Bu yüzden tüm shop discovery
 * noktaları burada kayıtlı ama enable flag'i false → hiçbir yerde render
 * olmuyor.
 *
 * Bölüm B canlıya alındığında yapılacak tek şey:
 *   define( 'SAZARA_SHOP_ENABLED', true );
 * Header CTA, footer widget, hero teaser vs. hepsi tek anda aktif olur.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Shop enable flag — Bölüm B canlıya alınana kadar false kalır.
 * Constant define edilmemişse false kabul edilir.
 */
if ( ! defined( 'SAZARA_SHOP_ENABLED' ) ) {
	define( 'SAZARA_SHOP_ENABLED', false );
}

/**
 * Shop base URL. Bölüm B'de subdomain seçilirse buraya doğru domain gelir.
 * wp-config.php'den override edilebilir (SAZARA_SHOP_URL define ederek).
 */
if ( ! defined( 'SAZARA_SHOP_URL' ) ) {
	define( 'SAZARA_SHOP_URL', 'https://sazarateknoloji.com' );
}

/**
 * Shop discovery açık mı? Tek soru — tüm render noktaları buna bakar.
 *
 * @return bool
 */
function sazara_shop_enabled(): bool {
	return (bool) SAZARA_SHOP_ENABLED;
}

/**
 * Shop URL'ini normalize et. Kategori/ürün derin linkleri için path append eder.
 *
 * Kullanım:
 *   sazara_shop_url()                        → https://sazarateknoloji.com/
 *   sazara_shop_url( 'kategori/ajax-alarm' ) → https://sazarateknoloji.com/kategori/ajax-alarm/
 *
 * @param string $path Opsiyonel yol.
 * @return string
 */
function sazara_shop_url( string $path = '' ): string {
	$base = untrailingslashit( SAZARA_SHOP_URL );
	$path = ltrim( $path, '/' );
	return $path ? $base . '/' . trailingslashit( $path ) : $base . '/';
}

/**
 * Shop CTA metinlerini tek yerde tut — brand voice tutarlılığı için.
 * Bölüm B'de shop launch mesajını ayarlarken bu diziyi düzenlemek yeterli.
 *
 * @return array<string, string>
 */
function sazara_shop_copy(): array {
	return [
		'nav_cta'        => __( 'Mağaza', 'sazara' ),
		'nav_cta_new'    => __( 'Mağaza · Yeni', 'sazara' ),
		'footer_heading' => __( 'Mağaza', 'sazara' ),
		'footer_lead'    => __( 'Ajax, Hikvision, Dahua ve daha fazlası — online satış sazarateknoloji.com üzerinden.', 'sazara' ),
		'footer_cta'     => __( 'Mağazaya git', 'sazara' ),
		'hero_teaser'    => __( 'Ürünlerimize göz atmak ister misin?', 'sazara' ),
		'hero_teaser_cta' => __( 'Mağazayı ziyaret et', 'sazara' ),
	];
}

/**
 * Discovery noktasını render etmeli mi? Enable + non-empty content kontrolü tek yerde.
 *
 * @param string $key Copy key.
 * @return bool
 */
function sazara_shop_can_render( string $key = 'nav_cta' ): bool {
	if ( ! sazara_shop_enabled() ) {
		return false;
	}
	$copy = sazara_shop_copy();
	return ! empty( $copy[ $key ] );
}
