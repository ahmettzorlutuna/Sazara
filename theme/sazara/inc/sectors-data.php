<?php
/**
 * Sektörel rehber — referanslar arşivindeki "Hangi sektörde nasıl çalışırız" bento'su.
 *
 * Her sektör için:
 *   - name             : sektör adı
 *   - count            : tamamlanan proje sayısı (yaklaşık)
 *   - typical_problem  : sektörün tipik güvenlik / network problemi (1 cümle)
 *   - typical_solution : Sazara'nın bu sektörde tipik yaklaşımı (1-2 cümle)
 *   - related_services : ilgili hizmet slug'ları (link için)
 *   - icon             : inline SVG path (currentColor)
 *
 * Yeni sektör eklemek için array'e satır ekle.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	'lojistik' => [
		'name'             => 'Lojistik & Depo',
		'count'            => 38,
		'typical_problem'  => 'Geniş açık alan perimeter güvenliği, gece görüş, yükleme rampası kontrolü.',
		'typical_solution' => 'AI olay tespit + 3 katmanlı doğrulama (AI + PIR + mikrodalga). Yanlış alarmsız çevre koruma.',
		'related_services' => [ 'kamera-sistemleri', 'ajax-kablosuz-alarm' ],
		'icon'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>',
	],

	'uretim' => [
		'name'             => 'Üretim & Fabrika',
		'count'            => 28,
		'typical_problem'  => 'Üretim hattı kalite kontrol kaydı, ofis network + üretim ağı izolasyonu, ekspatriyat denetim.',
		'typical_solution' => 'CCTV + yapısal kablolama + VLAN izolasyon tek pakette. Tek yüklenici, tek garanti.',
		'related_services' => [ 'kamera-sistemleri', 'network-it-altyapi' ],
		'icon'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 20h20"/><path d="M4 20V8l5 4V8l5 4V8l5 4v8"/><circle cx="7" cy="16" r="1"/><circle cx="12" cy="16" r="1"/><circle cx="17" cy="16" r="1"/></svg>',
	],

	'perakende' => [
		'name'             => 'Perakende & Mağaza',
		'count'            => 24,
		'typical_problem'  => 'Çok lokasyonlu mağaza, sigorta uyumlu görüntülü doğrulama, dükkân sahibi bağımsız yönetim.',
		'typical_solution' => 'Ajax kablosuz alarm + MotionCam görüntü doğrulama. Sigorta sertifikalı, mobil yönetim.',
		'related_services' => [ 'ajax-kablosuz-alarm', 'kamera-sistemleri' ],
		'icon'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l1.5-5h15L21 9"/><path d="M3 9v11h18V9"/><path d="M3 9h18"/><path d="M8 13a4 4 0 0 0 8 0"/></svg>',
	],

	'kurumsal' => [
		'name'             => 'AVM & Kurumsal',
		'count'            => 18,
		'typical_problem'  => 'Çok katlı bina, çoklu giriş, merkezi izleme, çok-vardiyalı güvenlik koordinasyonu.',
		'typical_solution' => 'Merkezi NVR + dağıtık kamera mimarisi. Tek panel, tüm katlar, tüm girişler — vardiyalar arası seamless geçiş.',
		'related_services' => [ 'kamera-sistemleri', 'network-it-altyapi' ],
		'icon'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18"/><path d="M5 21V3h14v18"/><path d="M9 7h2M9 11h2M9 15h2M13 7h2M13 11h2M13 15h2"/></svg>',
	],

];
