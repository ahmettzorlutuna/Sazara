<?php
/**
 * Referans (case study) içeriği — tek dosyada tüm projeler.
 *
 * Tek template (templates/case.php) bu dosyadan slug bazlı içerik çeker.
 * Routes (inc/routes.php) bu listeden child page'leri otomatik oluşturur.
 *
 * ─── ŞEMA ─────────────────────────────────────────────────────────
 *
 * Her case bir slug ile array key'lenir. Alanlar:
 *
 *   META (zorunlu):
 *     - title        : sayfa başlığı
 *     - client       : müşteri etiketi (anonimleştirilebilir)
 *     - sector       : Lojistik / Üretim / Perakende / Kurumsal / Akaryakıt
 *     - location     : "Başakşehir, İstanbul"
 *     - duration     : "3 hafta"
 *     - scope        : "CCTV · Network · Alarm"
 *     - year         : "2026"
 *     - team_size    : "3 kişilik saha ekibi"
 *     - completion   : "Nisan 2026"
 *     - hero_image   : kapak görseli URL
 *     - tagline      : tek cümle özet
 *
 *   METRICS (4 öne çıkan rakam — hero altı strip):
 *     - metrics[] : [ value, unit, label ]
 *
 *   DURUM:
 *     - durum_intro       : paragraf
 *     - durum_pain_points : bullet listesi (3-5 madde)
 *
 *   YAKLAŞIM:
 *     - yaklasim : 1-2 paragraf
 *
 *   ÇÖZÜM:
 *     - cozum_paragraphs[] : 2-3 detaylı paragraf
 *
 *   EKİPMAN:
 *     - equipment[] : [ category, items ]  (kullanılan donanım tablosu)
 *
 *   SÜREÇ:
 *     - timeline[] : [ phase, title, desc ]  (hafta hafta milestone)
 *
 *   SONUÇ:
 *     - sonuc_intro     : paragraf
 *     - sonuc_outcomes  : bullet listesi (somut metriklerle)
 *
 *   MÜŞTERİ SÖZÜ:
 *     - quote : [ text, attribution ]
 *
 *   MARKALAR:
 *     - brands[] : kullanılan marka etiketleri
 *
 *   GALERİ (opsiyonel):
 *     - gallery[] : [ src, alt, caption? ]
 *       src     : görsel URL'i (/wp-content/uploads/cases/<slug>/01.jpg önerilir)
 *       alt     : erişilebilirlik metni — ekran okuyucu için kısa açıklama
 *       caption : opsiyonel — görselin altında gösterilen metin
 *
 *   ÖRNEK İŞARETİ (opsiyonel — placeholder için):
 *     - is_example : true ise hero'da ve arşiv kartında "Örnek" badge'i gösterilir
 *                    Gerçek vakaları eklerken bu satırı KOYMA ya da false yap.
 *
 * ─── YENİ CASE EKLEMEK ────────────────────────────────────────────
 * 1. Aşağıdaki array'e yeni slug ile yeni satır ekle.
 * 2. Tema dosyalarına dokunduğunda routes.php init otomatik child page yaratır.
 * 3. Detaylı rehber için: docs/vaka-ekleme.md
 *
 * ─── AKTİF PROJELER ───────────────────────────────────────────────
 * Şu anda tek gerçek vaka: benzin istasyonu güvenlik projesi.
 * Her yeni istasyon için ayrı bir slug açılır (docs/vaka-ekleme.md
 * içinde "İstasyon Şablonu" bölümü kopyalanır).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	// ═══════════════════════════════════════════════════════════
	// CASE 01 — TotalEnergies TSK Mehmetçik Vakfı, Başakşehir
	// ═══════════════════════════════════════════════════════════
	// İlk gerçek vaka. Kanopi + market + ofis kapsamı; market feed'i
	// müdür ofis TV'sine canlı bağlandı. 13 saha fotoğrafı gallery'de.
	// Fotoğraf klasörü: uploads/cases/totalenergies-basaksehir/
	'totalenergies-basaksehir' => [
		'title'      => 'TotalEnergies TSK Mehmetçik Vakfı — Başakşehir İstasyonu Güvenlik Sistemi',
		'client'     => 'TotalEnergies TSK Mehmetçik Vakfı — Başakşehir Bayii',
		'sector'     => 'Akaryakıt',
		'location'   => 'Başakşehir, İstanbul',
		'duration'   => '2 hafta',
		'scope'      => 'CCTV · Kanopi · Market · Ofis',
		'year'       => '2026',
		'team_size'  => 'Sazara saha ekibi',
		'completion' => 'Nisan 2026',
		'hero_image' => '/wp-content/uploads/cases/totalenergies-basaksehir/hero.jpg',
		'tagline'    => 'Kanopi, çevre, market ve ofis için 50 kanallı CCTV — market akışı müdür odası TV\'sine canlı yansıtıldı.',

		'metrics' => [
			[ 'value' => '~50', 'unit' => 'kamera', 'label' => 'Toplam kanal' ],
			[ 'value' => '8',   'unit' => 'kamera', 'label' => 'Market içi' ],
			[ 'value' => '2',   'unit' => 'hafta',  'label' => 'Devreye alma' ],
			[ 'value' => '24',  'unit' => 'saat',   'label' => 'Kesintisiz kayıt' ],
		],

		'durum_intro' => 'TotalEnergies TSK Mehmetçik Vakfı Başakşehir istasyonu 24 saat açık, market, ofis ve araç yıkama bölümüyle çok sahalı bir tesis. İşletme; kanopi altındaki pompa alanı, market içi, ofis ve dış perimeter için tek başlıktan izlenebilen bir güvenlik sistemi istedi. Öncelik netlik, kapsama alanı ve müdürün merkezi kontrol imkânıydı.',

		'durum_pain_points' => [
			'Kanopi ve pompa alanının çevre güvenliğinin gece dahil eksiksiz sağlanması gerekiyordu.',
			'Market ve ofis içi güvenlik ayrı olarak takip edilmeliydi; müdürün ofisinden market akışını canlı görebilmesi istendi.',
			'Araç yıkama bölümü mevcut sistemde net izlenemiyordu, olay sonrası kayıt kalitesi yetersizdi.',
			'50 kanala yakın toplam kanal sayısı için kablolama, PoE ve NVR planlaması disiplinli yapılmalıydı.',
		],

		'yaklasim' => 'Sahada iki aşamalı keşif yaptık: birinci gün kanopi + perimeter + araç yıkama için gündüz-gece açı testleri, ikinci gün market içi ve ofis için müşteri akışı ve kasa/ödeme noktası analizi. Kanopi altı için IP66 dış mekan kamera, market içi için diskret iç mekan modelleri seçildi. Müdür ofisinde 8 kanallı market akışının canlı TV yansımasını sağlayacak ayrı bir görüntü çıkış planı yaptık — böylece müdür günlük operasyonu ana kontrol panelinden değil kendi masasından takip edebilecek.',

		'cozum_paragraphs' => [
			'Kanopi ve dış perimeter için 4K çözünürlüklü, ColorVu / gece görüş performanslı Hikvision kameralar yerleştirdik. Pompa adaları, giriş-çıkış noktaları, araç yıkama bölümü ve dış perimeter tam kapsama alacak şekilde açılandırıldı. Toplam kanal sayısı yaklaşık 50 — bu yoğunlukta bir istasyon için tesadüfen değil, keşifte belirlenen ölü açı analiziyle bu sayıya ulaşıldı.',
			'Market içi için 8 adet iç mekan kamerası kuruldu: kasa çevresi, raf koridorları, ürün girişi ve müşteri hareket alanları. Bu 8 kanalın canlı görüntüsü, müdür odasındaki TV\'ye ayrı bir monitör çıkışıyla verildi. Böylece müdür günün her saatinde market operasyonunu kendi ofisinden takip ediyor — kasa yoğunluğu, raf hizasında bir dikkat ihtiyacı veya müşteri sorunları anında görülüyor.',
			'Ofis içi kameralar, ana kontrol ve NVR odası kilitli bir alana yerleştirildi. Tüm kanallar sürekli kayıt altında, uzun süreli depolama için ayrı bir disk mimarisi kuruldu. Ağ trafiği CCTV VLAN\'ı üzerinden ayrıldı; istasyonun POS/ödeme trafiğiyle karışmıyor.',
		],

		'equipment' => [
			[ 'category' => 'Dış Mekan Kamera', 'items' => 'Hikvision ColorVu / 4K IR — kanopi, pompa, perimeter, araç yıkama' ],
			[ 'category' => 'Market İçi Kamera', 'items' => 'Hikvision iç mekan × 8 — kasa, raf, giriş' ],
			[ 'category' => 'Ofis Kamera',       'items' => 'Hikvision iç mekan — ofis + kontrol odası' ],
			[ 'category' => 'NVR',               'items' => 'Hikvision 64 kanal NVR + yüksek kapasite HDD' ],
			[ 'category' => 'Ağ',                'items' => 'PoE+ switch omurga, ayrı CCTV VLAN' ],
			[ 'category' => 'Müdür Odası TV',    'items' => 'Market akışı için 8 kanallı canlı görüntü çıkışı' ],
		],

		'timeline' => [
			[ 'phase' => 'Hafta 1', 'title' => 'Keşif + kablolama',       'desc' => 'İki aşamalı saha keşfi (gündüz-gece), kamera açı simülasyonu, kablolama ve kanal montajı.' ],
			[ 'phase' => 'Hafta 2', 'title' => 'Montaj + devreye alma',   'desc' => 'Kamera montajları, NVR ve switch kurulumu, müdür odası TV entegrasyonu, kalibrasyon ve teslim.' ],
		],

		'sonuc_intro' => 'Devreye alma sonrası müşteri geri bildirimi netti: görüntü kalitesi ve alan kapsaması ciddi biçimde arttı, müdür artık market operasyonunu kendi masasından takip edebiliyor.',

		'sonuc_outcomes' => [
			'Görüntüler önceki sistemle kıyaslanmayacak ölçüde net — gece dahil olaylar detaylı izlenebiliyor.',
			'Kanopi + perimeter + market + ofis tek bir sistem çatısı altında toplandı; hiçbir ölü açı bırakılmadı.',
			'Araç yıkama bölümü artık net izleniyor, sonraki olay incelemeleri için kayıt kalitesi yeterli.',
			'Müdür, market akışını ofis TV\'sinden canlı görebiliyor — operasyonel karar hızlanıyor.',
		],

		// Müşteri sözü için: elimize gelirse ekleriz, şu an içerikten çıkarıyoruz
		// (template bu bölümü boşsa gizler).

		'brands' => [ 'Hikvision' ],

		'gallery' => [
			// 13 saha fotoğrafı — dosyaları uploads/cases/totalenergies-basaksehir/ altına
			// 01.jpg ... 13.jpg olarak yükle. Caption'ları senin LinkedIn post'undan / gerçek
			// bağlamdan sonradan zenginleştirebilirsin — şu anki caption'lar genel amaçlı.
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/01.jpg',
				'alt'     => 'Kanopi altı pompa alanı kamera açısı',
				'caption' => 'Kanopi altı — pompa adaları tam kapsama',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/02.jpg',
				'alt'     => 'İstasyon dış perimeter görünümü',
				'caption' => 'Perimeter — giriş çıkış noktası',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/03.jpg',
				'alt'     => 'Araç yıkama bölümü kamera açısı',
				'caption' => 'Araç yıkama — net izlenebilir hale getirildi',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/04.jpg',
				'alt'     => 'Market içi kasa çevresi kamera açısı',
				'caption' => 'Market — kasa bölgesi',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/05.jpg',
				'alt'     => 'Market içi raf koridoru kamera açısı',
				'caption' => 'Market — raf koridoru',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/06.jpg',
				'alt'     => 'Market girişi kamera açısı',
				'caption' => 'Market — giriş',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/07.jpg',
				'alt'     => 'Ofis içi kamera açısı',
				'caption' => 'Ofis içi',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/08.jpg',
				'alt'     => 'Müdür odasında market akışının canlı TV yansıması',
				'caption' => 'Müdür odası — market akışı canlı TV',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/09.jpg',
				'alt'     => 'Kontrol odası ve NVR rack',
				'caption' => 'Kontrol odası — NVR + switch rack',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/10.jpg',
				'alt'     => 'Kanopi kirişine monte edilmiş kamera',
				'caption' => 'Kanopi kiriş montajı — açı ayarı',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/11.jpg',
				'alt'     => 'Dış mekan kamera detay',
				'caption' => 'Dış mekan — IP66 muhafaza',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/12.jpg',
				'alt'     => 'Kablolama ve kanal detay',
				'caption' => 'Kablolama — düzenli kanal işçiliği',
			],
			[
				'src'     => '/wp-content/uploads/cases/totalenergies-basaksehir/13.jpg',
				'alt'     => 'Devreye alma sonrası panoramik görünüm',
				'caption' => 'Devreye alma sonrası — tam sistem çalışırken',
			],
		],
	],

];
