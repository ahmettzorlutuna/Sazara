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
 *     - sector       : Lojistik / Üretim / Perakende / Kurumsal
 *     - location     : "İkitelli, İstanbul"
 *     - duration     : "6 hafta"
 *     - scope        : "CCTV · Network · Alarm"
 *     - year         : "2024"
 *     - team_size    : "5 kişilik saha ekibi"
 *     - completion   : "Mart 2024"
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
 *     - gallery[] : [ src, alt ]
 *
 * ─── YENİ CASE EKLEMEK ────────────────────────────────────────────
 * 1. Aşağıdaki array'e yeni slug ile yeni satır ekle.
 * 2. Tema dosyalarına dokunduğunda routes.php init otomatik child page yaratır.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	// ═══════════════════════════════════════════════════════════
	// CASE 01 — Lojistik depo perimeter (kapsamlı)
	// ═══════════════════════════════════════════════════════════
	'ikitelli-lojistik-perimeter' => [
		'title'      => 'İkitelli Lojistik Üssü — Perimeter Güvenliği',
		'client'     => 'Atlas Lojistik A.Ş.',
		'sector'     => 'Lojistik',
		'location'   => 'İkitelli, İstanbul',
		'duration'   => '6 hafta',
		'scope'      => 'CCTV · Network · Ajax Alarm',
		'year'       => '2024',
		'team_size'  => '5 kişilik saha ekibi',
		'completion' => 'Mart 2024',
		'hero_image' => '/wp-content/uploads/photos/photo-1586528116311-ad8dd3c8310d.jpg',
		'tagline'    => '18.000 m² depo perimeter\'ı — AI olay tespiti, 3 katmanlı doğrulama, %0 yanlış alarm.',

		'metrics' => [
			[ 'value' => '18.000', 'unit' => 'm²',    'label' => 'Korunan açık alan' ],
			[ 'value' => '14',     'unit' => 'kamera', 'label' => 'AI destekli + PTZ' ],
			[ 'value' => '%0',     'unit' => '',       'label' => 'Yanlış alarm / 90 gün' ],
			[ 'value' => '14',     'unit' => 'ay',     'label' => 'Yatırım amortismanı' ],
		],

		'durum_intro' => 'Atlas Lojistik 2023 sonunda İkitelli\'de yeni bir konsolidasyon merkezi açtı. 18.000 m² açık depolama alanı ve 3.000 m² kapalı yükleme rampası, geceleri sıklıkla perimeter ihlali yaşıyordu. Mevcut analog CCTV olay olduktan sonra kayıt sağlasa da gerçek zamanlı uyarı vermiyordu — hırsızlık tamamlanmadan önce müdahale şansı sıfıra yakındı.',

		'durum_pain_points' => [
			'8 noktaya 7/24 operatör koymak hem maliyetli hem sürdürülemezdi (yıllık ~600.000 TL personel maliyeti).',
			'Mevcut kameraların gece görüntü kalitesi düşüktü — yaşanan 4 ihlalde de yüz/plaka tespiti yapılamadı.',
			'Bordro dışı geçici personel çevre güvenliği için yeterli değildi; sigorta primi her ay artıyordu.',
			'Operasyon direktörü kayıt sistemine telefondan erişmek istiyordu, mevcut DVR mobil uygulamayı desteklemiyordu.',
		],

		'yaklasim' => 'Saha keşfini iki aşamada yaptık: gündüz topoloji ve kablolama olanakları, gece görüş açıları ve mevcut aydınlatma. Çıkan rapor 12 sabit + 2 PTZ kamera, üç katmanlı doğrulama (AI olay tespit + PIR + mikrodalga), izole CCTV VLAN ve hibrit lokal + bulut yedek önerdi. Donanım seçimi tek bir kriterle yapıldı: yanlış alarm oranı %2\'nin altında kalmalı.',

		'cozum_paragraphs' => [
			'12 noktaya Hikvision DS-2CD2T87G2-L (4K + ColorVu) yerleştirildi. Kamera açıları önce AutoCAD üzerinde simüle edildi, sonra sahada doğrulandı. Kritik dönüş noktaları için 2 adet PTZ kamera eklendi — operatör herhangi bir tetiklemede otomatik yakınlaştırma yapıyor.',
			'Ajax MotionProtect Outdoor sensörleri çift teknoloji (PIR + mikrodalga) ile çevre boyunca konuşlandırıldı. AI olay tespit, PIR ve mikrodalganın aynı anda tetiklenmesi alarmı doğruluyor — bu üç katmanlı doğrulama yanlış alarm oranını %0\'a indirdi.',
			'Ağ tarafında CCTV trafiği VLAN ile tamamen izole edildi. Cisco CBS350-24FP-4G PoE+ omurga, fiber uplink üzerinden NVR\'a bağlandı. Bulut yedek için AWS S3 + lifecycle policy kuruldu: 30 gün lokal NVR kayıt, sonrasında 60 gün S3 Glacier soğuk arşiv. Sigorta denetimleri için bu yapı kritik.',
		],

		'equipment' => [
			[ 'category' => 'Sabit Kamera',  'items' => 'Hikvision DS-2CD2T87G2-L × 12 (4K ColorVu, 30m IR)' ],
			[ 'category' => 'PTZ Kamera',    'items' => 'Hikvision DS-2DE5425IW-AE × 2 (25× optik, AutoTracking)' ],
			[ 'category' => 'NVR',           'items' => 'Hikvision DS-7732NI-I4/16P × 1 (32 kanal, 4×HDD)' ],
			[ 'category' => 'Alarm Sensörü', 'items' => 'Ajax MotionProtect Outdoor × 18 (PIR + mikrodalga)' ],
			[ 'category' => 'Hub',           'items' => 'Ajax Hub 2 Plus (Ethernet + 4G yedek)' ],
			[ 'category' => 'Switch',        'items' => 'Cisco CBS350-24FP-4G (PoE+ 24 port + 4×SFP)' ],
			[ 'category' => 'Depolama',      'items' => '4 × 16TB Seagate IronWolf Pro (RAID-5)' ],
			[ 'category' => 'Bulut Yedek',   'items' => 'AWS S3 + S3 Glacier (90 gün toplam arşiv)' ],
		],

		'timeline' => [
			[ 'phase' => 'Hafta 1',   'title' => 'Keşif ve tasarım',        'desc' => 'İki günlük saha keşfi, AutoCAD topoloji çizimi, kamera açı simülasyonu. Müşteri imzasından sonra malzeme siparişi açıldı.' ],
			[ 'phase' => 'Hafta 2-3', 'title' => 'Altyapı ve kablolama',     'desc' => '1.200 m Cat6 + 400 m fiber çekildi. Kablo kanal montajı, switch ve NVR rack kurulumu. Tüm noktalar fiziksel ve sistem üzerinde etiketlendi.' ],
			[ 'phase' => 'Hafta 4',   'title' => 'Cihaz montajı',            'desc' => '12 kamera + 2 PTZ + 18 Ajax sensör fiziksel olarak monte edildi. Tüm dış mekan bağlantıları IP66 muhafaza standardına uygun yapıldı.' ],
			[ 'phase' => 'Hafta 5',   'title' => 'AI kalibrasyon + test',    'desc' => 'Her kamera için çizgi geçiş ve perimeter ihlali kuralları kalibre edildi. Gece testlerinde 3 senaryo (yaya, araç, hayvan) denendi.' ],
			[ 'phase' => 'Hafta 6',   'title' => 'Devreye alma + eğitim',    'desc' => 'Operasyon ekibine 4 saatlik eğitim, mobil uygulama setup\'ı, kayıt politikası dokümantasyonu, ilk hafta günlük takip.' ],
		],

		'sonuc_intro' => 'Devreye almadan sonraki ilk 90 gün boyunca sistem performansı haftalık rapor edildi. Tüm hedefler aşıldı.',

		'sonuc_outcomes' => [
			'90 günde 3 gerçek perimeter ihlali doğru tetiklendi, polis ortalama 4 dakikada sahaya ulaştı.',
			'Sıfır yanlış alarm — üç katmanlı doğrulama (AI + PIR + mikrodalga) sayesinde rüzgar, hayvan, gölge gibi yanlış pozitifler tamamen elendi.',
			'Operatör maliyeti yıllık ~600.000 TL düştü; yatırım 14 ay içinde amorti oldu.',
			'Sigorta primi sözleşme yenilemesinde %18 düşürüldü — sigortacı görüntülü doğrulamayı bonus faktör olarak değerlendirdi.',
			'Operasyon direktörü mobil uygulama üzerinden tüm kanallara erişiyor; olağandışı durumlarda 30 saniye içinde müdahale başlatılabiliyor.',
		],

		'quote' => [
			'text'        => 'Sahada başka bir firma teklif sunmadı, sadece donanım listesi attı. Sazara önce gelip dinledi, sonra teklif verdi. Aradaki fark sahada belli oldu.',
			'attribution' => 'Operasyon Direktörü, Atlas Lojistik',
		],

		'brands' => [ 'Hikvision', 'Ajax Systems', 'Cisco', 'Seagate', 'AWS' ],

		'gallery' => [
			// Yer tutucu — gerçek saha fotoğraflarıyla değiştir.
			// Format: [ 'src' => 'https://.../foto.jpg', 'alt' => 'Açıklama' ]
		],
	],

	// ═══════════════════════════════════════════════════════════
	// CASE 02 — Fabrika içi görüntüleme + network (kapsamlı)
	// ═══════════════════════════════════════════════════════════
	'mercan-tekstil-fabrika' => [
		'title'      => 'Mercan Tekstil — Fabrika İçi Görüntüleme + Network',
		'client'     => 'Mercan Tekstil',
		'sector'     => 'Üretim',
		'location'   => 'İkitelli, İstanbul',
		'duration'   => '4 hafta',
		'scope'      => 'CCTV · Yapısal Kablolama · WiFi 6 · VLAN',
		'year'       => '2024',
		'team_size'  => '4 kişilik karma ekip (network + CCTV)',
		'completion' => 'Şubat 2024',
		'hero_image' => '/wp-content/uploads/photos/photo-1567789884554-0b844b597180.jpg',
		'tagline'    => 'Taşınma sabahı network çalışır halde — 0 dakika operasyon kesintisi.',

		'metrics' => [
			[ 'value' => '3.500', 'unit' => 'm²',    'label' => 'Toplam fabrika alanı' ],
			[ 'value' => '16',    'unit' => 'kamera', 'label' => 'Üretim hattı 4K' ],
			[ 'value' => '%99.9', 'unit' => '',       'label' => 'Network uptime (30g)' ],
			[ 'value' => '0',     'unit' => 'dk',     'label' => 'Operasyon kesintisi' ],
		],

		'durum_intro' => 'Mercan Tekstil 12 yıllık ilk fabrikasından İkitelli\'de 3.500 m²\'lik yeni binasına taşınma kararı verdi. Yeni alanda iki ihtiyaç vardı: üretim hattı kalite kontrolü için görüntüleme ve ofis çalışanları için kurumsal ağ. Müşteri iki ayrı yüklenici takip etmek istemiyordu.',

		'durum_pain_points' => [
			'Yeni binada altyapı tamamen yoktu — kablolama, switch, erişim noktası, NVR; her şey sıfırdan kurulacaktı.',
			'Üretim hattındaki kalite kontrol sürecini görüntü kaydıyla geriye dönük denetlemek gerekiyordu (ihracat müşterileri için).',
			'Ofiste 24 personel, üretimde 60 operatör — iki farklı ağ politikası gerekiyordu.',
			'Taşınma tarihi sabit; gecikme operasyonu durdururdu.',
		],

		'yaklasim' => 'CCTV ve network ekiplerimizi aynı anda sahaya çıkardık. Tek topoloji şeması, tek kablo kanalı planı, tek devreye alma takvimi. Müşteri tek faturayla, tek garanti sözleşmesiyle iki sistemi birden teslim aldı. Taşınma sabahı her şey çalışır haldeydi.',

		'cozum_paragraphs' => [
			'Üretim hattının üzerine 16 adet Hikvision 4K varifokal kamera yerleştirildi. Lens varifokal seçimi kasıtlıydı — hat yeniden organize edildiğinde kamera değişimine gerek kalmadan açı yeniden ayarlanabiliyor.',
			'Ofis tarafına Ubiquiti UniFi WiFi 6 mesh ağ + 24-port PoE+ omurga kuruldu. UniFi Controller fabrika içine konuşlandırıldı (bulut bağımsız), uzaktan yönetim için sadece outbound VPN aktif.',
			'VLAN segmentasyonu: CCTV (VLAN 10) ofis ağından tamamen izole, üretim ağı (VLAN 20) sadece HMI ve makine kontrol için, kurumsal ağ (VLAN 30) ofis çalışanları için, misafir ağı (VLAN 40) tamamen internet-only. Hat değişikliklerinin diğer ağları etkilemeyeceği bir mimari.',
		],

		'equipment' => [
			[ 'category' => 'Kamera',          'items' => 'Hikvision DS-2CD2T87G2P-LSU × 16 (4K varifokal, ses dahil)' ],
			[ 'category' => 'NVR',             'items' => 'Hikvision DS-7716NI-I4/16P × 1 (16 kanal)' ],
			[ 'category' => 'WiFi AP',         'items' => 'Ubiquiti UniFi U6-Pro × 6 (WiFi 6, mesh)' ],
			[ 'category' => 'Switch',          'items' => 'Ubiquiti USW-24-PoE × 2' ],
			[ 'category' => 'Router/Firewall', 'items' => 'Ubiquiti UniFi Dream Machine Pro' ],
			[ 'category' => 'Kablolama',       'items' => '~2.400 m Cat6 + 200 m multi-mode fiber' ],
			[ 'category' => 'Rack + UPS',      'items' => '12U server rack + APC Smart-UPS 1500' ],
		],

		'timeline' => [
			[ 'phase' => 'Hafta 1', 'title' => 'Tasarım + kablo plan',   'desc' => 'Mimari proje üzerinde kablo kanalı, AP yerleşimi ve kamera açıları işaretlendi. Müşterinin taşınma tarihiyle senkron takvim çıkarıldı.' ],
			[ 'phase' => 'Hafta 2', 'title' => 'Yapısal kablolama',      'desc' => 'Cat6 + fiber çekimi, prizler, etiketleme. Test Fluke cihazıyla yapıldı, kategori sertifikası teslim edildi.' ],
			[ 'phase' => 'Hafta 3', 'title' => 'Aktif cihaz montajı',    'desc' => 'Rack, switch, NVR, UPS kurulumu. AP\'ler ve kameralar fiziksel olarak monte edildi.' ],
			[ 'phase' => 'Hafta 4', 'title' => 'Devreye alma + eğitim',  'desc' => 'VLAN konfigürasyonu, WiFi mesh kalibrasyonu, kamera kayıt politikası. IK ve IT ekiplerine 6 saatlik eğitim.' ],
		],

		'sonuc_intro' => 'Müşteri taşınma sabahı sistemi açık halde teslim aldı. İlk üretim haftasında veri akmaya başladı.',

		'sonuc_outcomes' => [
			'Üretim haftası 1\'de IK ekibi kayıtları bant verimi takibinde kullanmaya başladı.',
			'Network downtime ilk 30 günde: 0 dakika — UniFi Controller %99.9 uptime raporladı.',
			'İhracat müşterisi denetim ziyaretinde "üretim sırasında doğrudan görüntülü doğrulama" özelliğini olumlu rapor etti.',
			'İkinci fabrika için aynı sistem siparişi 3 ay sonra geldi — uzun vadeli iş ortaklığı kuruldu.',
		],

		'quote' => [
			'text'        => 'Taşınma sabahı network çalışır halde teslim alındı. Operasyonumuz 1 dakika dahi durmadı. İkinci fabrikamızda da aynı ekiple çalışacağız.',
			'attribution' => 'Genel Müdür, Mercan Tekstil',
		],

		'brands' => [ 'Hikvision', 'Ubiquiti', 'APC' ],

		'gallery' => [],
	],

	// ═══════════════════════════════════════════════════════════
	// CASE 03 — Kuyumcu çarşısı Ajax kablosuz alarm (kapsamlı)
	// ═══════════════════════════════════════════════════════════
	'kuyumcular-carsi-ajax' => [
		'title'      => 'Kuyumcu Çarşısı — Ajax Kablosuz Alarm + Görüntü Doğrulama',
		'client'     => 'Kuyumcular Çarşısı (12 dükkân ortak proje)',
		'sector'     => 'Perakende',
		'location'   => 'Kapalıçarşı, İstanbul',
		'duration'   => '3 hafta',
		'scope'      => 'Ajax · CCTV Entegrasyon · Görüntülü Alarm Doğrulama',
		'year'       => '2024',
		'team_size'  => '3 kişilik kurulum ekibi',
		'completion' => 'Nisan 2024',
		'hero_image' => '/wp-content/uploads/photos/photo-1556909114-f6e7ad7d3136.jpg',
		'tagline'    => '12 dükkân, tarihi yapı, tek metre kablo dahi yok — Ajax kablosuz + görüntülü doğrulama.',

		'metrics' => [
			[ 'value' => '12', 'unit' => 'dükkân', 'label' => 'Eş zamanlı devreye alındı' ],
			[ 'value' => '0',  'unit' => 'metre',  'label' => 'Kablo döşendi' ],
			[ 'value' => '5',  'unit' => 'sn',     'label' => 'Alarm → video doğrulama' ],
			[ 'value' => '%22','unit' => '',       'label' => 'Sigorta primi indirimi' ],
		],

		'durum_intro' => 'Kapalıçarşı içindeki 12 kuyumcu, 2008\'den kalma merkezi alarm sistemini değiştirmek zorundaydı. Parça bulmak imkansız hale gelmişti. Ancak tarihi yapı koruma altındaydı — duvar açma, kablo çekme, tavan yarma izni yoktu.',

		'durum_pain_points' => [
			'Tarihi yapı statüsü nedeniyle kablo kanalı kurulamıyordu; her dükkân ayrı kablo çekemiyordu.',
			'12 dükkân bağımsız işletme ama merkezi olarak aynı anda izlenmeleri gerekiyordu.',
			'Alarm tetiklendiğinde hangi dükkân, hangi sensör, ne tipte ihlal — bu 3 bilgi olmadan polis veya bekçi sahaya boş gidiyordu.',
			'Sigorta şirketi yeni sistemde "görüntülü doğrulama" şartı koymuştu — sadece sensör tetiklemesi yetmiyordu.',
		],

		'yaklasim' => 'Ajax kablosuz sistemi seçildi (Grade 2 sertifikalı, Jeweller protokolü ile 1.700 m radyo menzili). Her dükkân bağımsız sensör seti, ama hepsi tek hub üzerinden merkezi panele bağlı. Tetikleme anında MotionCam fotoğrafı PRO Desktop\'a düşüyor — operatör sahaya bekçi / polis sevki yapmadan önce görüntüden doğruluyor.',

		'cozum_paragraphs' => [
			'Hub 2 Plus merkezi noktaya yerleştirildi. 12 dükkânın her birine MotionCam (görüntülü PIR), DoorProtect (manyetik kapı), GlassProtect (cam kırılma) entegre edildi. Tüm cihazlar Hub\'a Jeweller protokolü üzerinden kablosuz bağlandı, tek metre kablo çekilmedi.',
			'PRO Desktop yazılımı çarşının ortak güvenlik odasına kuruldu. Tetikleme anında operatörün ekranına 5 saniyelik MotionCam video (10 fps) düşüyor. Operatör üç seçenek görüyor: doğrula → polis sevk et, yanlış alarm → susturup arşivle, belirsiz → bekçi sevk et.',
			'Her dükkân kendi telefonunda Ajax Security app ile bağımsız arm / disarm yapabiliyor. Dükkân açılış-kapanış saatlerine göre otomatik mod programlandı. Çarşı genelinde tüm sensörler ortak güvenlik odasından da izleniyor.',
		],

		'equipment' => [
			[ 'category' => 'Hub',              'items' => 'Ajax Hub 2 Plus × 1 (Ethernet + 4G yedek)' ],
			[ 'category' => 'Görüntülü Sensör', 'items' => 'Ajax MotionCam × 12 (PIR + foto, 5 sn @ 10 fps)' ],
			[ 'category' => 'Kapı Sensörü',     'items' => 'Ajax DoorProtect Plus × 24 (titreşim + eğim)' ],
			[ 'category' => 'Cam Sensörü',      'items' => 'Ajax GlassProtect × 18' ],
			[ 'category' => 'Siren',            'items' => 'Ajax HomeSiren × 4 (iç) + StreetSiren × 1 (dış)' ],
			[ 'category' => 'Yönetim',          'items' => 'Ajax PRO Desktop + Ajax Cloud + Security app' ],
		],

		'timeline' => [
			[ 'phase' => 'Hafta 1', 'title' => 'Saha keşfi + onay',     'desc' => 'Her dükkânda bireysel keşif, hub yerleşim noktası tespiti, Jeweller sinyal testi (yapı içi 1.700 m menzilin nasıl performe ettiğini ölçtük). Koruma kurulu için belge hazırlığı.' ],
			[ 'phase' => 'Hafta 2', 'title' => 'Kurulum',               'desc' => '12 dükkân kurulumu 5 iş gününde tamamlandı. Tek vida dahi tarihi yapı dokusuna zarar vermeden mevcut sabit noktalar kullanıldı.' ],
			[ 'phase' => 'Hafta 3', 'title' => 'Devreye alma + eğitim', 'desc' => 'PRO Desktop operatör eğitimi, her dükkân sahibine mobil app + arm / disarm eğitimi, sigorta şirketine sistem sertifikasyon raporu teslim edildi.' ],
		],

		'sonuc_intro' => 'İlk ay 2 gerçek tetikleme yaşandı — ikisi de görüntüden anında doğrulandı, operatör doğru kararı verdi.',

		'sonuc_outcomes' => [
			'Tetikleme 1: dükkâna gece giren kedi — sensör tetiklendi, MotionCam görüntüsü "yanlış alarm" olarak işaretlendi, polis sevki yapılmadı.',
			'Tetikleme 2: gerçek hırsızlık girişimi — cam kırma sensörü + MotionCam görüntüsü polis sevkini doğruladı, polis 6 dakikada sahadaydı, şüpheli yakalandı.',
			'12 dükkân sahibi tek bir merkezi sözleşmeden toplu sigorta primi indirimi aldı (%22 indirim).',
			'Sistem tarihi yapıda hiçbir görsel tahribat bırakmadan kuruldu — koruma kurulu denetiminden onayla geçti.',
			'Çarşı yönetimi başka kuyumcular için "Sazara referansı" olarak adres göstermeye başladı; 2 yeni proje takip ediyor.',
		],

		'quote' => [
			'text'        => 'Tarihi yapıda hiçbir yere dokunmadan 12 dükkânı 5 günde devreye aldılar. Polis sevki sonrasında çıkan görüntü doğrulama raporu sigortayı da memnun etti.',
			'attribution' => 'Yönetim Kurulu Başkanı, Kuyumcular Çarşısı',
		],

		'brands' => [ 'Ajax Systems' ],

		'gallery' => [],
	],

];
