<?php
/**
 * Currency helpers — USD as primary display currency, TRY as informational.
 *
 * Ajax donanımı ithal olduğu için Sazara paket fiyatlarını USD tutar. TRY
 * dalgalandığında marj erimez. Kullanıcıya USD yanı sıra günlük TL karşılığı
 * gösterilir; kur sabiti ay başında elle güncellenir.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Güncel USD/TRY kuru — ay başında güncellenmelidir.
 *
 * wp-config.php'de SAZARA_USD_TRY define edilirse onun değeri kullanılır.
 * Aksi halde buradaki varsayılan devreye girer.
 */
if ( ! defined( 'SAZARA_USD_TRY' ) ) {
	define( 'SAZARA_USD_TRY', 42.5 );
}

/**
 * KDV oranı (Türkiye genel: %20).
 */
if ( ! defined( 'SAZARA_KDV_RATE' ) ) {
	define( 'SAZARA_KDV_RATE', 0.20 );
}

/**
 * USD tutarı TL karşılığına çevir.
 */
function sazara_usd_to_try( float $usd ): float {
	return $usd * (float) SAZARA_USD_TRY;
}

/**
 * TL tutarı okunabilir metne çevir (binlik nokta, TL suffix).
 * Örnek: 21000 → "21.000 TL"
 */
function sazara_format_try( float $try ): string {
	return number_format( (float) round( $try ), 0, ',', '.' ) . ' TL';
}

/**
 * USD tutarı okunabilir metne çevir. Örnek: 499 → "$499"
 */
function sazara_format_usd( float $usd ): string {
	return '$' . number_format( (float) round( $usd ), 0, ',', '.' );
}

/**
 * KDV dahil tutar → KDV hariç net tutar.
 * Örnek: 499 KDV dahil, %20 KDV → 415.83 KDV hariç.
 */
function sazara_price_excluding_kdv( float $inclusive ): float {
	return $inclusive / ( 1 + (float) SAZARA_KDV_RATE );
}
