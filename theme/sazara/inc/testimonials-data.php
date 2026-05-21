<?php
/**
 * Müşteri sözleri — referanslar arşivinde testimonial wall'da gösterilir.
 *
 * Her bir testimonial için:
 *   - text          : alıntı metni (uzun olabilir, 2-3 cümle)
 *   - attribution   : "Operasyon Direktörü, Atlas Lojistik" formatında
 *   - sector        : Lojistik / Üretim / Perakende / Kurumsal
 *   - related_case  : (opsiyonel) ilgili case slug — case detay linki için
 *
 * Çapraz sektör örnekleri olsun — visitor "benim sektörümden de var" görsün.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [
	[
		'text'         => 'Sahada başka bir firma teklif sunmadı, sadece donanım listesi attı. Sazara önce gelip dinledi, sonra teklif verdi. Aradaki fark sahada belli oldu.',
		'attribution'  => 'Operasyon Direktörü, Atlas Lojistik',
		'sector'       => 'Lojistik',
		'related_case' => 'ikitelli-lojistik-perimeter',
	],
	[
		'text'         => 'Taşınma sabahı network çalışır halde teslim alındı. Operasyonumuz 1 dakika dahi durmadı. İkinci fabrikamızda da aynı ekiple çalışacağız.',
		'attribution'  => 'Genel Müdür, Mercan Tekstil',
		'sector'       => 'Üretim',
		'related_case' => 'mercan-tekstil-fabrika',
	],
	[
		'text'         => 'Tarihi yapıda hiçbir yere dokunmadan 12 dükkânı 5 günde devreye aldılar. Polis sevki sonrasında çıkan görüntü doğrulama raporu sigortayı da memnun etti.',
		'attribution'  => 'Yönetim Kurulu Başkanı, Kuyumcular Çarşısı',
		'sector'       => 'Perakende',
		'related_case' => 'kuyumcular-carsi-ajax',
	],
	[
		'text'         => 'AVM içinde 6 kat, 3 farklı giriş, 28 kamera. Sazara topolojiyi öyle kurgulamış ki her güvenlik vardiyası tek ekrandan yönetiyor. Eski sistemde 3 ayrı oda vardı.',
		'attribution'  => 'Güvenlik Müdürü, Atapark AVM',
		'sector'       => 'Kurumsal',
	],
	[
		'text'         => 'Soğuk hava deposunda −18°C koşullarda 8 ay önce kurulan kameralar tek bir failure olmadan çalışıyor. Sertifikasyon raporları sigorta yenilemesinde belirleyici oldu.',
		'attribution'  => 'Operasyon Sorumlusu, Halkalı Soğuk Hava',
		'sector'       => 'Lojistik',
	],
	[
		'text'         => 'Üretim hattında geçici personel takibi için kameraları biz istedik, AI olay tespit özelliğini onlar önerdi. Şimdi insan saymıyoruz, sistem sayıyor — IK için müthiş bir veri.',
		'attribution'  => 'Üretim Müdürü, Sema Plastik Kalıp',
		'sector'       => 'Üretim',
	],
];
