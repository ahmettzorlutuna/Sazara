<?php
/**
 * Ajax paket içeriği — tek dosyada tüm paketler.
 *
 * Tek template (templates/package.php) bu dosyadan slug bazlı içerik çeker.
 * Routes (inc/routes.php) bu listeden child page'leri otomatik oluşturur
 * (parent: paketler).
 *
 * ─── ŞEMA ─────────────────────────────────────────────────────────
 *
 * Her paket bir slug ile array key'lenir. Alanlar:
 *
 *   META (zorunlu):
 *     - title         : paket adı
 *     - subtitle      : kısa hedef kitle
 *     - tagline       : tek cümlelik özet
 *     - price_usd     : yeni USD fiyat (KDV dahil, integer). Template
 *                       hem $ hem TL karşılığı hem "Kurumsal fatura"
 *                       satırını üretir. Kur: SAZARA_USD_TRY sabiti.
 *     - price         : eski string format (geri uyumluluk). price_usd
 *                       set ise price yok sayılır.
 *     - price_prefix  : fiyat öncesi metin (örn: '\'den başlayan fiyatlarla')
 *     - duration      : kurulum süresi
 *     - target        : hedef kullanıcı tanımı
 *     - hero_image    : detay sayfası hero görseli URL
 *
 *   BAYRAK ALANLARI (opsiyonel):
 *     - is_featured   : true ise "En popüler" badge + accent border
 *     - is_custom     : true ise fiyat/cihaz gizli, "teklif al" odaklı
 *
 *   İÇERİK:
 *     - devices[]      : [ label, note, image? ]  (paket içindeki cihazlar)
 *                        image opsiyonel — set edilirse detay sayfasında büyük
 *                        kart grid'de ürün render'ı gösterilir. Yoksa fallback
 *                        ikon ile kompakt liste görünümüne düşer.
 *                        Görsel yolu: /wp-content/uploads/products/<slug>.png
 *     - included[]     : dahil olanlar (bullet listesi)
 *     - not_included[] : dahil değil olanlar (bullet listesi)
 *     - ideal_for[]    : kime uygun (bullet listesi)
 *     - application_areas[] : [ icon, label, note? ] uygulama alanları grid'i.
 *                             icon: assets/icons/<name>.svg dosya adı
 *                             (uzantısız). Örn: 'home', 'building', 'store'.
 *
 * ─── YENİ PAKET EKLEMEK ────────────────────────────────────────────
 * 1. Aşağıdaki array'e yeni slug ile yeni satır ekle.
 * 2. Routes init otomatik child page yaratır (parent: paketler).
 *
 * ─── FİYATLAR ─────────────────────────────────────────────────────
 * Şu an placeholder — kullanıcı gerçek fiyatlarını belirledikçe
 * `[FİYAT: xxx TL]` satırlarını güncelleyecek.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	// ═══════════════════════════════════════════════════════════
	// PAKET 01 — Başlangıç (daire / ofis)
	// ═══════════════════════════════════════════════════════════
	'baslangic' => [
		'title'        => 'Başlangıç Paketi',
		'subtitle'     => 'Daire / ofis',
		'tagline'      => 'Ajax\'ın resmi StarterKit içeriği ile birebir hazırlanmış giriş paketi. Kablosuz alarm sistemine tam kapsamlı başlangıç — daire, ofis veya mağaza için ideal.',
		'price_usd'    => 499,
		'price_prefix' => "'den başlayan fiyatlarla",
		'duration'     => 'yarım gün',
		'target'       => '2+1 / 3+1 daire, tek katlı ofis, mağaza',
		'is_featured'  => false,
		'is_custom'    => false,
		'hero_image'   => '/wp-content/uploads/2026/07/ajax-starterkit-black.jpg',

		'devices' => [
			[
				'label' => 'Ajax Hub 4G',
				'note'  => 'Sistemin beyni. Ethernet + 4G SIM ile ağa bağlanır; internet kesildiğinde iletişim SIM üzerinden sürer. Tüm sensörleri şifreli kablosuz Jeweller protokolüyle yönetir.',
				'image' => '/wp-content/uploads/2026/07/ajax-hub.png',
			],
			[
				'label' => 'MotionProtect Jeweller',
				'note'  => 'İç mekan kızılötesi hareket dedektörü. 12m menzil, 88° yatay açı; 20 kg\'a kadar evcil hayvan bağışıklığı.',
				'image' => '/wp-content/uploads/2026/07/motionprotect-jeweller.png',
			],
			[
				'label' => 'DoorProtect Jeweller',
				'note'  => 'Manyetik kapı/pencere açılma dedektörü. Kapı veya pencere açıldığında anında bildirim.',
				'image' => '/wp-content/uploads/2026/07/doorprotect-jeweller.png',
			],
			[
				'label' => 'SpaceControl Jeweller',
				'note'  => 'Cepte veya anahtarlıkta taşınan kablosuz kumanda. Sistemi tek tuşla kur/sil, panik butonu dahil.',
				'image' => '/wp-content/uploads/2026/07/spacecontrol-jeweller.png',
			],
		],

		'included' => [
			'Ücretsiz saha keşfi (İstanbul içi)',
			'Kablolama, vida ve montaj aparatları',
			'Kurulum ve devreye alma',
			'Kullanıcı eğitimi (mobil uygulama + sistem kullanımı)',
			'Sertifikalı kurulum belgesi',
			'KDV dahil, İstanbul içi kurulum + eğitim dahil',
		],

		'not_included' => [
			'Dış mekan siren (StreetSiren — isteğe bağlı ek)',
			'KeyPad tuş takımı (isteğe bağlı ek)',
			'MotionCam fotoğraflı doğrulama (isteğe bağlı ek modül)',
			'SIM kart ve AHM yıllık abonelikleri (aşağıda ayrı olarak sunulmaktadır)',
		],

		'ideal_for' => [
			'Küçük daire güvenliği isteyen bireysel kullanıcı',
			'Tek katlı ofis',
			'Sisteme yeni başlayan işletme (ileride büyütme opsiyonu)',
			'Sadeliği ve resmi Ajax setini tercih eden kullanıcı',
		],

		'application_areas' => [
			[ 'icon' => 'home',     'label' => 'Küçük daire',     'note' => '2+1 · 3+1' ],
			[ 'icon' => 'building', 'label' => 'Tek katlı ofis',   'note' => '' ],
			[ 'icon' => 'store',    'label' => 'mağaza',     'note' => '' ],
			[ 'icon' => 'key',      'label' => 'Kiralık konut',    'note' => 'söküp götürülebilir' ],
		],
	],

	// ═══════════════════════════════════════════════════════════
	// PAKET 02 — Standart (villa / orta ölçekli işletme) — EN POPÜLER
	// ═══════════════════════════════════════════════════════════
	// Temel: Ajax StarterKit Plus (Hub Plus + MotionProtect + DoorProtect + SpaceControl)
	// Sazara farkı: HomeSiren + Relay (otomasyon) + ek MotionProtect + ek DoorProtect
	'standart' => [
		'title'        => 'Standart Paketi',
		'subtitle'     => 'Villa / orta ölçekli işletme',
		'tagline'      => 'Ajax StarterKit Plus üzerine kurulmuş, çift SIM yedek iletişim + otomasyon uyumlu kablosuz alarm paketi. Villa, restoran, market veya orta ofis için tam kapsamlı çözüm.',
		'price_usd'    => 999,
		'price_prefix' => "'den başlayan fiyatlarla",
		'duration'     => '1 gün',
		'target'       => '4+1 daire, villa, restoran, market, orta ölçekli ofis',
		'is_featured'  => true,   // En popüler kart
		'is_custom'    => false,
		'hero_image'   => '/wp-content/uploads/packages/standart.jpg',

		'devices' => [
			[
				'label' => 'Ajax Hub Plus',
				'note'  => 'Gelişmiş kontrol paneli. Ethernet + Wi-Fi + 2 SIM (2G/3G) — dört farklı iletişim kanalı ile yedekli haberleşme.',
				'image' => '/wp-content/uploads/products/ajax-hub-plus.png',
			],
			[
				'label' => 'MotionProtect Jeweller × 2',
				'note'  => 'İç mekan hareket dedektörleri (salon + koridor). PIR sensör, evcil hayvan bağışıklığı.',
				'image' => '/wp-content/uploads/products/motionprotect-jeweller.png',
			],
			[
				'label' => 'DoorProtect Jeweller × 2',
				'note'  => 'Ana giriş + arka kapı için manyetik açılma dedektörü.',
				'image' => '/wp-content/uploads/products/doorprotect-jeweller.png',
			],
			[
				'label' => 'SpaceControl Jeweller',
				'note'  => 'Kablosuz anahtarlık kumanda. Sistemi tek tuşla kur/sil, panik butonu dahil.',
				'image' => '/wp-content/uploads/products/spacecontrol-jeweller.png',
			],
			[
				'label' => 'HomeSiren Jeweller',
				'note'  => 'İç mekan siren. Alarm anında yüksek desibel uyarı — hem ev içinden hem çevreden duyulur.',
				'image' => '/wp-content/uploads/products/homesiren-jeweller.png',
			],
			[
				'label' => 'Relay Jeweller',
				'note'  => 'Kablosuz kuru kontak röle — otomasyon senaryoları için. Alarm ışıkları, otomatik kilit ve zamanlı cihaz kontrolü sağlar.',
				'image' => '/wp-content/uploads/products/relay-jeweller.png',
			],
		],

		'included' => [
			'Ücretsiz saha keşfi (İstanbul içi)',
			'Kablolama, montaj ve tüm aparatlar',
			'2 SIM yedek iletişim ayarı (Hub Plus kurulumu)',
			'Otomasyon senaryosu tasarımı (Relay ile)',
			'Kurulum, devreye alma ve sistem testi',
			'Kullanıcı eğitimi (mobil uygulama + senaryolar)',
			'Sertifikalı kurulum belgesi',
			'KDV dahil, İstanbul içi kurulum + eğitim dahil',
		],

		'not_included' => [
			'MotionCam fotoğraflı doğrulama (Premium pakette dahil)',
			'Dış mekan siren (StreetSiren — Premium\'da dahil, ek olarak alınabilir)',
			'Yangın ve su kaçağı dedektörleri (Premium\'da dahil, ek olarak alınabilir)',
			'SIM kart ve AHM yıllık abonelikleri (aşağıda ayrı olarak sunulmaktadır)',
		],

		'ideal_for' => [
			'Villa sahibi (bahçeli müstakil ev)',
			'Restoran ve orta ölçekli mağaza',
			'Orta ofis (5-15 çalışan)',
			'Otomasyon senaryolarını sisteme dahil etmek isteyen kullanıcı',
		],

		'application_areas' => [
			[ 'icon' => 'home',     'label' => 'Villa',             'note' => 'bahçeli müstakil ev' ],
			[ 'icon' => 'utensils', 'label' => 'Restoran',          'note' => 'orta ölçek' ],
			[ 'icon' => 'store',    'label' => 'Market / mağaza',   'note' => 'orta trafik' ],
			[ 'icon' => 'building', 'label' => 'Orta ofis',         'note' => '5-15 çalışan' ],
		],
	],

	// ═══════════════════════════════════════════════════════════
	// PAKET 03 — Premium (büyük villa / yüksek risk işletme)
	// ═══════════════════════════════════════════════════════════
	// Temel: Ajax StarterKit Cam (Hub 2 (2G) + MotionCam + DoorProtect + SpaceControl)
	// Sazara farkı: StreetSiren + FireProtect + LeaksProtect + Relay + ek MotionProtect + 2 ek DoorProtect
	// Yaşam güvenliği (yangın + su) + fotoğraflı doğrulama + dış caydırıcılık dahil.
	'premium' => [
		'title'        => 'Premium Paketi',
		'subtitle'     => 'Büyük villa / yüksek risk işletme',
		'tagline'      => 'Ajax StarterKit Cam üzerine kurulmuş, fotoğraflı doğrulama + yaşam güvenliği (yangın, su) + dış mekan caydırıcılık + otomasyon dahil premium paket. Kuyumcu, döviz büfesi, büyük villa gibi yüksek risk mekanlar için.',
		'price_usd'    => 1449,
		'price_prefix' => "'den başlayan fiyatlarla",
		'duration'     => '1-2 gün',
		'target'       => 'Büyük villa, kuyumcu, döviz büfesi, banka bayii, yüksek değerli mağaza',
		'is_featured'  => false,
		'is_custom'    => false,
		'hero_image'   => '/wp-content/uploads/packages/premium.jpg',

		'devices' => [
			[
				'label' => 'Ajax Hub 2',
				'note'  => 'Fotoğraflı doğrulama destekli kontrol paneli. Ethernet + SIM iletişim; MotionCam görüntülerini uygulamaya iletir.',
				'image' => '/wp-content/uploads/products/ajax-hub-2.png',
			],
			[
				'label' => 'MotionCam Jeweller',
				'note'  => 'Alarm anında fotoğraf çeken hareket dedektörü. "Gerçek alarm mı, yanlış alarm mı?" sorusunu saniyeler içinde cevaplar.',
				'image' => '/wp-content/uploads/products/motioncam-jeweller.png',
			],
			[
				'label' => 'MotionProtect Jeweller',
				'note'  => 'Ek iç mekan hareket dedektörü — MotionCam\'in kapsamadığı ikinci iç zon için.',
				'image' => '/wp-content/uploads/products/motionprotect-jeweller.png',
			],
			[
				'label' => 'DoorProtect Jeweller × 3',
				'note'  => 'Ana giriş + arka kapı + iç kritik kapı için manyetik açılma dedektörleri.',
				'image' => '/wp-content/uploads/products/doorprotect-jeweller.png',
			],
			[
				'label' => 'SpaceControl Jeweller',
				'note'  => 'Kablosuz anahtarlık kumanda. Kur/sil + panik butonu.',
				'image' => '/wp-content/uploads/products/spacecontrol-jeweller.png',
			],
			[
				'label' => 'StreetSiren Jeweller',
				'note'  => 'Dış mekan siren. Yüksek desibel caydırıcılık — evin dışından duyulur, komşu duyar.',
				'image' => '/wp-content/uploads/products/streetsiren-jeweller.png',
			],
			[
				'label' => 'FireProtect Jeweller',
				'note'  => 'Yangın (ısı + duman) dedektörü. Yaşam güvenliği katmanı — özellikle depo, mutfak, kritik alanlar için.',
				'image' => '/wp-content/uploads/products/fireprotect-jeweller.png',
			],
			[
				'label' => 'LeaksProtect Jeweller',
				'note'  => 'Su baskın dedektörü. Sunucu odası, depo, bulaşık makinesi altı için — erken uyarıyla ciddi hasar önlenir.',
				'image' => '/wp-content/uploads/products/leaksprotect-jeweller.png',
			],
			[
				'label' => 'Relay Jeweller',
				'note'  => 'Kablosuz kuru kontak röle. Otomasyon senaryoları: alarm ışıkları, otomatik kilit, akıllı ev entegrasyonu.',
				'image' => '/wp-content/uploads/products/relay-jeweller.png',
			],
		],

		'included' => [
			'Ücretsiz saha keşfi (İstanbul içi)',
			'Kablolama, montaj ve tüm aparatlar',
			'MotionCam ve fotoğraflı doğrulama kalibrasyonu',
			'Yangın + su kaçağı dedektörü kurulumu ve testi',
			'Otomasyon senaryosu tasarımı (Relay ile)',
			'AHM entegrasyon hazırlığı (aboneliği ayrıdır)',
			'Grup modu ve kullanıcı yetkilendirmeleri',
			'Kurulum, devreye alma ve senaryo testleri',
			'Kullanıcı eğitimi (yönetim + günlük kullanım)',
			'Sertifikalı kurulum belgesi',
			'1 yıl uzaktan destek',
			'KDV dahil, İstanbul içi kurulum + eğitim dahil',
		],

		'not_included' => [
			'AHM (izleme merkezi) yıllık hizmet bedeli — aşağıda ayrı olarak sunulmaktadır',
			'SIM kart yıllık aboneliği — aşağıda ayrı olarak sunulmaktadır',
			'KeyPad Plus tuş takımı (isteğe bağlı ek)',
			'Yıllık bakım anlaşması (ayrı fiyatlandırılır)',
		],

		'ideal_for' => [
			'Büyük villa (bahçeli, çoklu kat, yüksek değerli eşya)',
			'Kuyumcu, döviz büfesi, banka bayii',
			'Yüksek değerli mal içeren mağaza veya depo',
			'AHM entegrasyonlu profesyonel izleme isteyen işletme',
			'Yaşam güvenliği (yangın + su) katmanı isteyen kullanıcı',
		],

		'application_areas' => [
			[ 'icon' => 'home',     'label' => 'Büyük villa',     'note' => 'yüksek değerli eşya' ],
			[ 'icon' => 'gem',      'label' => 'Kuyumcu',          'note' => 'yüksek risk' ],
			[ 'icon' => 'banknote', 'label' => 'Döviz büfesi',     'note' => 'nakit odaklı' ],
			[ 'icon' => 'store',    'label' => 'Değerli mağaza',   'note' => 'yüksek trafik' ],
		],
	],

	// ═══════════════════════════════════════════════════════════
	// PAKET 04 — Özel Proje (kurumsal / özel gereksinim)
	// ═══════════════════════════════════════════════════════════
	'ozel-proje' => [
		'title'        => 'Özel Proje',
		'subtitle'     => 'Fabrika, otel, çok lokasyonlu işletme',
		'tagline'      => 'Kurumsal ölçekli tesisler için saha keşfinden sonra donanım listesi + kurulum planı + eğitim çıkarılır. Ölçek ve gereksinime özel.',
		'price'        => 'Teklif bazında',
		'price_prefix' => '',
		'duration'     => 'saha keşfinden sonra planlanır',
		'target'       => 'fabrika, otel, kampüs, çok lokasyonlu işletme, endüstriyel tesis',
		'is_featured'  => false,
		'is_custom'    => true,   // Fiyat/cihaz gizli
		'hero_image'   => '/wp-content/uploads/packages/ozel-proje.jpg',

		// devices/included/not_included boş bırakılıyor — kart custom görünüm alır

		'ideal_for' => [
			'Fabrika ve endüstriyel tesis',
			'Otel ve turizm işletmesi',
			'Kampüs / eğitim kurumu',
			'Çok lokasyonlu zincir işletme',
			'Özel altyapı gereksinimleri olan müşteri',
		],
	],

];
