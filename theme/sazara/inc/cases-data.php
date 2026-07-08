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
	// CASE 01 — Benzin istasyonu güvenlik (kapsamlı)
	// ═══════════════════════════════════════════════════════════
	// İSKELET İÇERİK — sen bu alanları gerçek proje bilgileriyle
	// dolduracaksın. Her alanın yanında "[DOLDUR: ...]" ipucu var.
	// Fotoğrafları uploads/cases/benzin-istasyonu-guvenlik/ altına
	// yükle, gallery[] içine ekle.
	'benzin-istasyonu-guvenlik' => [
		'title'      => '[DOLDUR: Şirket ismi] — Benzin İstasyonu Güvenlik Sistemi',
		'client'     => '[DOLDUR: Müşteri firma adı, örn: OPET Bayii Aslan Akaryakıt]',
		'sector'     => 'Akaryakıt',
		'location'   => '[DOLDUR: İlçe, İl — örn: Başakşehir, İstanbul]',
		'duration'   => '[DOLDUR: Kaç haftada tamamlandı, örn: 3 hafta]',
		'scope'      => 'CCTV · Network · Alarm',
		'year'       => '2026',
		'team_size'  => '[DOLDUR: örn: 3 kişilik saha ekibi]',
		'completion' => '[DOLDUR: Ay Yıl — örn: Nisan 2026]',
		'hero_image' => '/wp-content/uploads/cases/benzin-istasyonu-guvenlik/hero.jpg',
		'tagline'    => '[DOLDUR: Tek cümlelik özet — örn: 24/7 nakit sirkülasyonu olan istasyona 12 kanal 4K CCTV + akıllı olay tespiti.]',

		'metrics' => [
			[ 'value' => '[DOLDUR]', 'unit' => 'kamera',  'label' => 'Toplam kamera' ],
			[ 'value' => '[DOLDUR]', 'unit' => 'ay',      'label' => 'Yedekleme süresi' ],
			[ 'value' => '[DOLDUR]', 'unit' => '',        'label' => 'Kritik alan kapsaması' ],
			[ 'value' => '[DOLDUR]', 'unit' => 'saat',    'label' => 'Kesintisiz çalışma' ],
		],

		'durum_intro' => '[DOLDUR: 2-3 cümle — istasyonun konumu, günlük müşteri trafiği, güvenlik ihtiyacının neden ortaya çıktığı. Nakit taşıma, gece vardiyası, akaryakıt hırsızlığı riski, sigorta talepleri gibi bağlam.]',

		'durum_pain_points' => [
			'[DOLDUR: 1. sorun — örn: Gece vardiyalarında pompa üzerinde belirsiz olaylar yaşanıyordu ve mevcut kamera kaydı bulanık.]',
			'[DOLDUR: 2. sorun — örn: Nakit kasa çevresinde güvenlik açığı ve kayıt kalitesi düşük.]',
			'[DOLDUR: 3. sorun — örn: Plaka tanıma yoktu, tank sızıntısı veya araç ödemesiz çıkışı takip edilemiyordu.]',
			'[DOLDUR: 4. sorun (opsiyonel) — örn: Sigorta şirketi HD kayıt zorunluluğu getirmişti.]',
		],

		'yaklasim' => '[DOLDUR: 1-2 paragraf — Saha keşfini nasıl yaptığımız (kaç gün, hangi noktalar), risk analizi (pompa alanı, kasa, giriş-çıkış, depo, market içi), kameraların açı simülasyonunu nasıl planladığımız, gece görüş / IR / plaka okuma gereksinimleri hangi kriterlerle belirlendi.]',

		'cozum_paragraphs' => [
			'[DOLDUR: 1. paragraf — Pompa alanı + akaryakıt tankları için hangi kameralar, kaç noktaya, neden. IP66 / patlayıcı ortam standartı, gece görüş performansı. Plaka tanıma varsa nasıl konumlandırıldı.]',
			'[DOLDUR: 2. paragraf — Kasa/market içi kameralar, ATM veya nakit çekmece varsa yakınına özel açılar. Ses kaydı yasal olarak alınıyorsa nerede, alınmıyorsa mikrofon devre dışı bırakma.]',
			'[DOLDUR: 3. paragraf — Ağ altyapısı: NVR yerleşimi (kilitli oda?), yedekleme diski, uzaktan erişim (VPN? bulut?), sigorta denetimi için kaç günlük kayıt saklandığı, mobil uygulama üzerinden istasyon sahibinin erişimi.]',
		],

		'equipment' => [
			[ 'category' => 'Sabit Kamera',   'items' => '[DOLDUR: örn: Hikvision DS-2CD2087G2-L × 8 (4K ColorVu, 30m IR)]' ],
			[ 'category' => 'Plaka Tanıma',   'items' => '[DOLDUR: opsiyonel — plaka kamerası kullanıldıysa]' ],
			[ 'category' => 'NVR',            'items' => '[DOLDUR: örn: Hikvision DS-7716NI-K4 (16 kanal, 4×HDD yuvası)]' ],
			[ 'category' => 'Depolama',       'items' => '[DOLDUR: örn: 4×8TB Seagate SkyHawk (RAID-5)]' ],
			[ 'category' => 'Switch / PoE',   'items' => '[DOLDUR: örn: TP-Link TL-SG1218MPE (16 port PoE+)]' ],
			[ 'category' => 'UPS',            'items' => '[DOLDUR: örn: APC Smart-UPS 1500VA — 45 dk kesintisiz]' ],
			[ 'category' => 'Alarm (varsa)',  'items' => '[DOLDUR: opsiyonel — Ajax veya benzeri kablosuz alarm sistemi eklendiyse]' ],
		],

		'timeline' => [
			[ 'phase' => 'Hafta 1',   'title' => 'Keşif ve tasarım',      'desc' => '[DOLDUR: Saha keşfi, kamera açı simülasyonu, malzeme onayı.]' ],
			[ 'phase' => 'Hafta 2',   'title' => 'Kablolama',              'desc' => '[DOLDUR: Cat6 çekimi, kanal montajı, NVR odası hazırlığı.]' ],
			[ 'phase' => 'Hafta 3',   'title' => 'Cihaz montajı + test',   'desc' => '[DOLDUR: Kamera montajları, kalibrasyon, gece testleri, müşteri eğitimi ve teslim.]' ],
		],

		'sonuc_intro' => '[DOLDUR: 1-2 cümle — Devreye alma sonrası ilk hafta/ay değerlendirmesi. Müşteri nasıl adapte oldu, hangi olaylar erken tespit edildi.]',

		'sonuc_outcomes' => [
			'[DOLDUR: 1. somut sonuç — örn: Gece vardiyasında bir müşteri kartsız ödeme yapmaya çalıştı, kayıt sayesinde 20 dakika içinde tespit edildi.]',
			'[DOLDUR: 2. sonuç — örn: Sigorta şirketi HD kayıt sistemi nedeniyle prim %12 düşürdü.]',
			'[DOLDUR: 3. sonuç — örn: Sahibi telefondan istasyonu izleyebiliyor, ayda 2 gün fiziksel ziyaret azaldı.]',
		],

		'quote' => [
			'text'        => '[DOLDUR: Müşteri sözü — 1-2 cümle, gerçek sözcük tercih edilir. Aşırı süslü değil, samimi olsun.]',
			'attribution' => '[DOLDUR: İsim, Ünvan / Konum — örn: Aslan Bey, İstasyon Sahibi]',
		],

		'brands' => [ 'Hikvision' ],
		// [DOLDUR: kullanılan diğer markaları ekle, örn: 'Ajax Systems', 'TP-Link', 'APC'

		'gallery' => [
			// Yer tutucu — sen bu satırları düzenleyeceksin.
			// Şema:
			//   src     : '/wp-content/uploads/cases/benzin-istasyonu-guvenlik/01.jpg'
			//   alt     : ekran okuyucu için kısa açıklama
			//   caption : opsiyonel — görselin altında gösterilen metin
			//
			// Örnek yapı (comment'li — açmak için baştaki // işaretlerini sil):
			//
			// [
			//     'src'     => '/wp-content/uploads/cases/benzin-istasyonu-guvenlik/01-pompa-alani.jpg',
			//     'alt'     => 'İstasyon pompa alanı gece görüntüsü',
			//     'caption' => 'Pompa alanı — 4 sabit kamera ColorVu ile gece bile renkli görüntü',
			// ],
			// [
			//     'src'     => '/wp-content/uploads/cases/benzin-istasyonu-guvenlik/02-kasa-bolgesi.jpg',
			//     'alt'     => 'Kasa bölgesi kamera açısı',
			//     'caption' => 'Kasa ve nakit çekmece — yakın plan',
			// ],
			// [
			//     'src'     => '/wp-content/uploads/cases/benzin-istasyonu-guvenlik/03-nvr-rack.jpg',
			//     'alt'     => 'NVR ve switch rack kurulumu',
			//     'caption' => 'Sunucu odası — kilitli kabinet içinde NVR + switch + UPS',
			// ],
		],
	],

];
