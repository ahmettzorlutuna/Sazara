<?php
/**
 * Sürekli hizmet abonelikleri — SIM kart + AHM (Alarm Haber Alma Merkezi).
 *
 * Paket fiyatı dışında opsiyonel olarak sunulan yıllık hizmetler. Her paket
 * detay sayfasında "Sürekli Hizmetler" bölümünde standart olarak listelenir.
 *
 * ─── ŞEMA ─────────────────────────────────────────────────────────
 * Her hizmet slug ile array key'lenir. Alanlar:
 *   - title       : hizmet adı
 *   - price_usd   : yıllık ücret (USD, KDV dahil sunum)
 *   - period      : sunuş birimi (örn: 'yıl')
 *   - icon        : assets/icons/<name>.svg dosya adı (uzantısız)
 *   - description : ne olduğunu anlatan 1-2 cümle
 *   - why_needed  : neden gerekli — kısa vurgu
 *   - audience    : hangi kullanıcı segmentine uygun
 *
 * Fiyatlar güncellendikçe bu dosya elle revize edilir.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	'sim' => [
		'title'       => '4G SIM Kart — Yedek İletişim',
		'price_usd'   => 39.90,
		'period'      => 'yıl',
		'icon'        => 'wifi',
		'description' => 'Hub\'a takılan 4G SIM kart. İnternet kesildiğinde alarmların kesintisiz iletilmesini sağlar. Ajax Hub\'ın dört iletişim kanalından biri.',
		'why_needed'  => 'İnternet kesildiğinde tek yedek iletişim katmanınız.',
		'audience'    => 'Konut ve işletme için önerilir',
	],

	'ahm' => [
		'title'       => '7/24 Alarm İzleme Merkezi (AHM)',
		'price_usd'   => 99.90,
		'period'      => 'yıl',
		'icon'        => 'shield-check',
		'description' => 'Alarm çaldığında profesyonel operatör önce sizi arar; gerçek alarmda güvenlik ekibi ve polis müdahalesi devreye girer. Sazara olarak Türkiye\'de lisanslı bir AHM sağlayıcısı ile ortaklık üzerinden entegre ediyoruz.',
		'why_needed'  => 'Ev boşken alarm çalarsa operatör 60 saniyede aksiyon başlatır.',
		'audience'    => 'Yüksek riskli işletmeler için standart, konutta opsiyonel',
	],

];
