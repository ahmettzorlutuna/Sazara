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
	// PAKET 01 — Başlangıç (daire / küçük ofis)
	// ═══════════════════════════════════════════════════════════
	'baslangic' => [
		'title'        => 'Başlangıç Paketi',
		'subtitle'     => 'Daire / küçük ofis',
		'tagline'      => 'Ajax\'ın resmi StarterKit içeriği ile birebir hazırlanmış giriş paketi. Kablosuz alarm sistemine tam kapsamlı başlangıç — daire, küçük ofis veya küçük mağaza için ideal.',
		'price_usd'    => 499,
		'price_prefix' => "'den başlayan fiyatlarla",
		'duration'     => 'yarım gün',
		'target'       => '2+1 / 3+1 daire, tek katlı ofis, küçük mağaza',
		'is_featured'  => false,
		'is_custom'    => false,
		'hero_image'   => '/wp-content/uploads/packages/baslangic.jpg',

		'devices' => [
			[
				'label' => 'Ajax Hub',
				'note'  => 'Sistemin beyni. Ethernet ve Wi-Fi ile ağa bağlanır, tüm sensörleri şifreli kablosuz iletişimle yönetir.',
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
			[ 'icon' => 'store',    'label' => 'Küçük mağaza',     'note' => '' ],
			[ 'icon' => 'key',      'label' => 'Kiralık konut',    'note' => 'söküp götürülebilir' ],
		],
	],

	// ═══════════════════════════════════════════════════════════
	// PAKET 02 — Standart (villa / orta ölçekli işletme) — EN POPÜLER
	// ═══════════════════════════════════════════════════════════
	'standart' => [
		'title'        => 'Standart Paketi',
		'subtitle'     => 'Villa / orta ölçekli işletme',
		'tagline'      => 'Villa, restoran, market veya orta ofis için tam kapsamlı Ajax çözümü. 4G yedek iletişim ve dış mekan siren dahil.',
		'price'        => '[FİYAT: 40.000 TL]',
		'price_prefix' => "'den başlayan fiyatlarla",
		'duration'     => '1 gün',
		'target'       => '4+1 daire, villa, restoran, market, orta ölçekli ofis',
		'is_featured'  => true,   // En popüler kart
		'is_custom'    => false,
		'hero_image'   => '/wp-content/uploads/packages/standart.jpg',

		'devices' => [
			[ 'label' => 'Ajax Hub 2 Plus',         'note' => 'Ethernet + Wi-Fi + 2 SIM 4G yedek' ],
			[ 'label' => 'MotionProtect × 3',       'note' => 'İç mekan hareket dedektörleri' ],
			[ 'label' => 'DoorProtect × 4',         'note' => 'Kapı ve pencere sensörleri' ],
			[ 'label' => 'GlassProtect × 1',        'note' => 'Vitrin / büyük pencere için cam kırılma dedektörü' ],
			[ 'label' => 'KeyPad Plus × 1',         'note' => 'Kart destekli tuş takımı' ],
			[ 'label' => 'StreetSiren × 1',         'note' => 'Dış mekan siren (caydırıcı)' ],
			[ 'label' => 'HomeSiren × 1',           'note' => 'İç mekan siren' ],
		],

		'included' => [
			'Ücretsiz saha keşfi (İstanbul içi)',
			'Kablolama, montaj ve tüm aparatlar',
			'4G SIM kart kurulumu ve yedek iletişim ayarı',
			'Kurulum, devreye alma ve sistem testi',
			'Kullanıcı eğitimi',
			'Sertifikalı kurulum belgesi',
			'İlk 3 ay uzaktan destek',
		],

		'not_included' => [
			'MotionCam fotoğraflı doğrulama (isteğe bağlı ek modül)',
			'İzleme merkezi hizmeti (3. taraf, aylık ücretli)',
			'Yıllık bakım anlaşması (ayrı fiyatlandırılır)',
		],

		'ideal_for' => [
			'Villa sahibi (bahçeli müstakil ev)',
			'Restoran ve orta ölçekli mağaza',
			'Orta ofis (5-15 çalışan)',
			'Yüksek trafikli işletme',
		],
	],

	// ═══════════════════════════════════════════════════════════
	// PAKET 03 — Premium (büyük villa / yüksek risk işletme)
	// ═══════════════════════════════════════════════════════════
	'premium' => [
		'title'        => 'Premium Paketi',
		'subtitle'     => 'Büyük villa / yüksek risk işletme',
		'tagline'      => 'Kuyumcu, döviz büfesi, büyük villa ve yüksek risk mekanlar için MotionCam fotoğraflı doğrulama ve izleme merkezi entegrasyonu ile.',
		'price'        => '[FİYAT: 85.000 TL]',
		'price_prefix' => "'den başlayan fiyatlarla",
		'duration'     => '1-2 gün',
		'target'       => '200+ m² villa, kuyumcu, döviz büfesi, banka bayii, büyük mağaza',
		'is_featured'  => false,
		'is_custom'    => false,
		'hero_image'   => '/wp-content/uploads/packages/premium.jpg',

		'devices' => [
			[ 'label' => 'Ajax Hub 2 Plus',            'note' => 'Ethernet + Wi-Fi + 2 SIM 4G yedek' ],
			[ 'label' => 'MotionCam × 2',              'note' => 'Fotoğraflı doğrulama dedektörü' ],
			[ 'label' => 'MotionProtect × 4',          'note' => 'İç mekan hareket dedektörleri' ],
			[ 'label' => 'DoorProtect × 6',            'note' => 'Kapı ve pencere sensörleri' ],
			[ 'label' => 'GlassProtect × 2',           'note' => 'Cam kırılma dedektörleri' ],
			[ 'label' => 'MotionProtect Outdoor × 1',  'note' => 'Dış mekan hareket dedektörü' ],
			[ 'label' => 'KeyPad Plus × 2',            'note' => 'Kart destekli tuş takımları' ],
			[ 'label' => 'StreetSiren × 2',            'note' => 'Dış mekan sirenler' ],
			[ 'label' => 'Panik butonu × 2',           'note' => 'Yatak başucu / kasa altı' ],
		],

		'included' => [
			'Ücretsiz saha keşfi (İstanbul içi)',
			'Kablolama, montaj ve tüm aparatlar',
			'4G SIM kart kurulumu ve yedek iletişim ayarı',
			'İzleme merkezi entegrasyonu hazırlığı',
			'Grup modu ve kullanıcı yetkilendirmeleri',
			'Kurulum, devreye alma, senaryo testleri',
			'Kullanıcı eğitimi (yönetim + günlük kullanım)',
			'Sertifikalı kurulum belgesi',
			'1 yıl uzaktan destek',
		],

		'not_included' => [
			'İzleme merkezi aylık hizmet bedeli (3. taraf güvenlik firmasıyla anlaşma)',
			'Yıllık bakım anlaşması (ayrı fiyatlandırılır)',
		],

		'ideal_for' => [
			'Büyük villa (200+ m², bahçeli, çoklu kat)',
			'Kuyumcu, döviz büfesi, banka bayii',
			'Yüksek değerli mal içeren mağaza veya depo',
			'İzleme merkezi bağlantısı isteyen işletme',
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
