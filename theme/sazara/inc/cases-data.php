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
 *   AJAX PROJESİ İŞARETİ (opsiyonel):
 *     - is_ajax_project : true ise vaka /ajax-alarm/ arşivinde "Ajax Vakaları"
 *                         bölümünde de listelenir. Ajax markası ile yapılan
 *                         gerçek projeler için kullan (Hikvision CCTV projelerinde
 *                         set etme). Aynı vaka Referanslar'da da normal şekilde
 *                         görünmeye devam eder — SEO için çift anchor sağlanır.
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
		'hero_image' => '/wp-content/uploads/2026/07/IMG_5787.jpeg',
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
				'src'     => '/wp-content/uploads/2026/07/IMG_5787.jpeg',
				'alt'     => 'İstasyon dış perimeter — kanopi ve giriş genel görünüm',
				'caption' => 'İstasyon dış görünüm — kanopi ve giriş',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5775.jpeg',
				'alt'     => 'Kanopi altı pompa alanı, açılış süslemeleriyle',
				'caption' => 'Kanopi altı — pompa adaları',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5776.jpeg',
				'alt'     => 'Kanopi çelik yapısı — üstten kapsama görünümü',
				'caption' => 'Kanopi yapısı — üstten kapsama',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5777.jpeg',
				'alt'     => 'Dış duvar üstüne monte edilmiş çift güvenlik kamerası ve yangın kabini',
				'caption' => 'Dış duvar — çift kamera montajı',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5779.jpeg',
				'alt'     => 'Taş duvar köşesinde konumlandırılmış kamera',
				'caption' => 'Taş duvar — kamera açısı',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5773.jpeg',
				'alt'     => 'LPG bölgesinde dış mekan kamera konumlandırma',
				'caption' => 'LPG alanı — kamera konumu',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5780.jpeg',
				'alt'     => 'Araç yıkama binası dış görünüm',
				'caption' => 'Araç yıkama — dış görünüm',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5768.jpeg',
				'alt'     => 'Market içi — raflar ve içecek soğutucuları',
				'caption' => 'Market içi — raflar ve soğutucular',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5763.jpeg',
				'alt'     => 'Market içi — soğutucu bölgesi ve raf düzeni',
				'caption' => 'Market içi — soğutucu bölgesi',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5767.jpeg',
				'alt'     => 'Market içi — kasa ve ürün menü panosu',
				'caption' => 'Market — kasa ve menü panosu',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5790.jpeg',
				'alt'     => 'Ofis alanı — duyuru panoları ve giriş kapısı',
				'caption' => 'Ofis / duyuru panosu',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5789.jpeg',
				'alt'     => 'Müdür odasında monte edilmiş TV — market kameralarının canlı yansıması',
				'caption' => 'Müdür odası TV — market akışı canlı',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_5795.jpeg',
				'alt'     => 'Müdür odası TV\'sinde canlı kamera görüntüleri yakın plan',
				'caption' => 'Canlı yayın yakın plan',
			],
		],
	],

	// ═══════════════════════════════════════════════════════════
	// CASE 02 — Sarper Petrol A.Ş, Shell Levent İstanbul
	// ═══════════════════════════════════════════════════════════
	// İkinci gerçek vaka. İstanbul'un en hareketli noktalarından biri.
	// ~60 kamera, server kabin yeniden düzenlendi, market içi
	// müşteri TV'sinde pompa canlı yayını (unique). Ayrıca müdür
	// odası TV feed'i. 13 saha fotoğrafı gallery'de.
	// Fotoğraf klasörü: uploads/cases/shell-levent/
	'shell-levent' => [
		'title'      => 'Sarper Petrol A.Ş — Shell Levent İstasyonu IP Kamera ve Sistem Altyapısı',
		'client'     => 'Sarper Petrol A.Ş — Shell Levent',
		'sector'     => 'Akaryakıt',
		'location'   => 'Levent, İstanbul',
		'duration'   => '3 hafta',
		'scope'      => 'CCTV · Server kabin · Market müşteri TV · Müdür ofis TV',
		'year'       => '2026',
		'team_size'  => 'Sazara saha ekibi',
		'completion' => 'Ocak 2026',
		'hero_image' => '/wp-content/uploads/2026/07/IMG_7780.jpeg',
		'tagline'    => 'İstanbul\'un en hareketli lokasyonlarından birinde ~60 kanallı Hikvision IP CCTV, yeniden düzenlenmiş server kabini ve müşterinin market içinden pompasını canlı izleyebildiği şeffaf hizmet sistemi.',

		'metrics' => [
			[ 'value' => '~60', 'unit' => 'kamera', 'label' => 'Toplam kanal' ],
			[ 'value' => '64',  'unit' => 'kanal',  'label' => 'NVR kapasitesi' ],
			[ 'value' => '16',  'unit' => 'TB',     'label' => 'Depolama' ],
			[ 'value' => '3',   'unit' => 'hafta',  'label' => 'Devreye alma' ],
		],

		'durum_intro' => 'Sarper Petrol A.Ş, Levent gibi İstanbul\'un en yoğun trafiğine sahip lokasyonlarından birinde Shell markası altında bir istasyon işletiyor. Yoğun müşteri sirkülasyonu, bordro dışı 24 saatlik operasyon ve nakit + kart sirkülasyonu — istasyon bir bütün olarak izlenmesi gereken çok sahalı bir tesis. Mevcut altyapı hem kanal sayısı hem kayıt kalitesi hem de bakım kolaylığı açısından yeniden ele alınması gereken bir noktaya gelmişti.',

		'durum_pain_points' => [
			'Kanopi, pompa alanı, dış perimeter ve market içi için tam kapsamalı çözünürlüklü kayıt gerekiyordu.',
			'Mevcut server kabini kablo kalabalığı ve etiketlenmemiş bağlantılar nedeniyle her müdahale saatler alıyordu — teknik bakım maliyetliydi.',
			'Yoğun trafikte müşteriler market içindeyken pompadaki araçlarını göremiyor, güvenlik hissi düşüyordu.',
			'Müdürün istasyonun operasyonel akışını kendi ofisinden takip edememesi karar hızını yavaşlatıyordu.',
		],

		'yaklasim' => 'Saha keşfini iki aşamada yaptık: birinci gün mevcut sistemin envanteri ve server kabin analizi, ikinci gün kanopi + perimeter + market + ofis için görüş açı testleri. Hikvision 4K IP kameralar üzerinde standardize olduk, tüm kameraları tek bir 64 kanal NVR üzerinde topladık. Server kabini tamamen söküldü, kablolar renkli etiketlerle yeniden çekildi, patch panel + kablo yönetimi ile "yıllarca bakım dostu" bir mimari kuruldu. Ayrıca iki farklı canlı görüntü çıkışı planladık: müdür ofisine operasyon takibi, market içine müşteri şeffaflığı.',

		'cozum_paragraphs' => [
			'Kanopi, pompa adaları, dış perimeter ve market dış cephesi için yaklaşık 60 kanal Hikvision IP kamera yerleştirildi. Gece görüş performansı, çözünürlük ve IP66 dış mekan standardı kritik seçim kriterleriydi. Her nokta, keşifte tespit edilen ölü açı analizine göre konumlandırıldı — kanal sayısı fazla değil, tam ihtiyaç kadar.',
			'Sistemin kalbi olan server kabini tamamen yeniden inşa edildi: eski kablolar söküldü, patch panel + kablo yönetim aparatları eklendi, tüm bağlantılar renkli etiketlerle işaretlendi. Böylece ileride bir kamera bakımı veya kablo değişimi gerektiğinde teknisyen kablo takip etmek yerine etikete bakarak dakikalar içinde müdahale edebilir. Bu yapı hem müdahale hızını hem de sistemin uzun ömürlü çalışmasını garanti altına alıyor.',
			'İki ayrı canlı görüntü çıkışı kuruldu. Birincisi müdür ofisi TV\'sine — istasyonun operasyonel akışını (kanopi, pompa, giriş-çıkış) müdür masasından takip ediyor. İkincisi ise market içindeki müşteri TV\'lerine — müşteri yakıt aldıktan sonra market içine geçtiğinde pompadaki aracını ve süreci canlı görebiliyor. Bu ikinci çıkış, güvenlik algısını güçlendirmenin ötesinde şeffaf bir hizmet ortamı sunuyor.',
		],

		'equipment' => [
			[ 'category' => 'IP Kamera',          'items' => 'Hikvision 4K IP × ~60 — kanopi, pompa, perimeter, market dış' ],
			[ 'category' => 'NVR',                'items' => 'Hikvision 64 kanal NVR' ],
			[ 'category' => 'Depolama',           'items' => '16 TB — sürekli kayıt için ayrı disk mimarisi' ],
			[ 'category' => 'Server Kabin',       'items' => 'Yeniden düzenlenmiş rack: patch panel, kablo yönetimi, renkli etiketleme' ],
			[ 'category' => 'Ağ',                 'items' => 'PoE+ switch omurga, ayrı CCTV VLAN' ],
			[ 'category' => 'Müdür Odası TV',     'items' => 'Operasyonel akış için canlı görüntü çıkışı' ],
			[ 'category' => 'Market Müşteri TV',  'items' => 'Pompa alanı canlı yayını — müşteri şeffaflığı' ],
		],

		'timeline' => [
			[ 'phase' => 'Hafta 1', 'title' => 'Keşif + envanter',        'desc' => 'Mevcut sistem envanteri, server kabin analizi, görüş açı testleri, malzeme onayı.' ],
			[ 'phase' => 'Hafta 2', 'title' => 'Kablolama + kabin',       'desc' => 'Yeni kablo çekimi, kanal montajı, server kabinin sökülüp yeniden düzenlenmesi, patch panel + etiketleme.' ],
			[ 'phase' => 'Hafta 3', 'title' => 'Montaj + devreye alma',   'desc' => 'Kamera montajları, NVR kurulumu, müdür + market TV entegrasyonu, kalibrasyon ve teslim.' ],
		],

		'sonuc_intro' => 'Devreye alma sonrası hem operasyonel görünürlük hem müşteri şeffaflığı hem de bakım kolaylığı belirgin biçimde arttı.',

		'sonuc_outcomes' => [
			'İstasyonun her noktası ~60 kanal 4K IP kamera ile tam kapsama alındı — ölü açı yok.',
			'Server kabin bakım kolaylığı için standartlaştı — ileride teknik müdahale dakikalar içinde yapılabiliyor.',
			'Müşteri market içindeyken pompadaki aracını canlı görebiliyor — şeffaf hizmet + güvenlik hissi.',
			'Müdür istasyon operasyonunu kendi ofisinden takip edebiliyor — operasyonel karar hızı arttı.',
		],

		'brands' => [ 'Hikvision' ],

		'gallery' => [
			// 13 saha fotoğrafı — WP Media'ya yükledikten sonra bu URL'leri güncelle.
			// Şu anki placeholder path'ler yer tutucu; asıl URL'ler prod uploads/2026/XX/
			// altında olacak. İlk case (totalenergies) süreciyle aynı: yükle → URL kopyala → src güncelle.
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7780.jpeg',
				'alt'     => 'Shell Levent istasyonu dış görünüm — kanopi ve giriş, yağmurlu gün',
				'caption' => 'İstasyon dış görünüm',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_1172.jpeg',
				'alt'     => 'Kanopi kirişine monte edilmiş güvenlik kamerası yakın plan (Shell 100. yıl teması görünüyor)',
				'caption' => 'Kanopi kiriş montajı — kamera',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7768.jpeg',
				'alt'     => 'Kanopi altı pompa alanı — kurulum çalışması sırasında geniş açı',
				'caption' => 'Kanopi altı — pompa alanı',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7767.jpeg',
				'alt'     => 'V-Power pompa alanı yakın plan',
				'caption' => 'Pompa alanı — yakın plan',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7782.jpeg',
				'alt'     => 'İstasyon dış duvar açısı — kanopi ve giriş aydınlatması',
				'caption' => 'Perimeter — dış duvar açısı',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7769.jpeg',
				'alt'     => 'Shell Select market dış cephe ve giriş',
				'caption' => 'Shell Select — market dış cephe',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_6817.jpeg',
				'alt'     => 'Market içi kurulum ve tadilat çalışması — işçiler saha çalışmasında',
				'caption' => 'Market içi — kurulum aşaması',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_6820.jpeg',
				'alt'     => 'Market içi yenileme çalışması — farklı açıdan',
				'caption' => 'Market içi — yenileme çalışması',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7772.jpeg',
				'alt'     => 'Market içi modern kafeterya ve oturma bölgesi',
				'caption' => 'Market — kafeterya bölgesi',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7775.jpeg',
				'alt'     => 'Shell Select market içi genel görünüm ve ürün rafları',
				'caption' => 'Market — Shell Select iç görünüm',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7774.jpeg',
				'alt'     => 'Market vitrininde müşterilere pompa alanının canlı yayınlarını gösteren çoklu TV monitörler',
				'caption' => 'Market müşteri TV — pompa canlı yayını',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7796.jpeg',
				'alt'     => 'Müdür odasında canlı kamera görüntülerinin TV yansıması — müdür masasında',
				'caption' => 'Müdür odası TV — canlı akış',
			],
			[
				'src'     => '/wp-content/uploads/2026/07/IMG_7786.jpeg',
				'alt'     => 'Server / kontrol odası girişinde dijital erişim kontrol paneli',
				'caption' => 'Server odası — erişim kontrolü',
			],
		],
	],

];
