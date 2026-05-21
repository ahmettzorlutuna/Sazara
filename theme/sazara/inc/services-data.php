<?php
/**
 * 4 hizmet için tüm içerik datası.
 *
 * Tek template (templates/service.php) bu dosyadan slug bazlı içerik çeker.
 * Metin değişikliği için bu dosyayı düzenle.
 *
 * Her hizmet için:
 *   - tag, num, title, tagline, lead
 *   - hero_image (opsiyonel; placeholder URL fallback)
 *   - intro_paragraphs[]
 *   - specs[] (her biri: label, value, [hint])
 *   - process[] (her biri: num, title, body)
 *   - sectors[] (kullanım alanları)
 *   - faq[] (her biri: q, a)
 *   - gallery[] (kullanıcı sonra dolduracak — boşsa placeholder)
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	// ═══════════════════════════════════════════════════════════
	// 01 — KAMERA SİSTEMLERİ (CCTV)
	// ═══════════════════════════════════════════════════════════
	'kamera-sistemleri' => [
		'num'       => '01',
		'tag'       => 'CCTV · 4K · IR · AI',
		'title'     => 'Kamera Sistemleri ve Güvenlik',
		'tagline'   => 'Kameranın değil, kararın peşinde.',
		'lead'      => 'IP kamera kurulumu, NVR ve hibrit kayıt, AI destekli olay tespiti — kameranın yalnızca kayıt değil, karar verdiği sistemler. Aykosan ve İstanbul genelinde 12 yıl saha tecrübesi.',
		'hero_image' => '/wp-content/uploads/photos/photo-1557597774-9d273605dfa9.jpg',

		'intro_paragraphs' => [
			'CCTV bir kayıt cihazı değil; yetkililerin saniyede karar vermesini sağlayan bir sistemdir. Kamera çözünürlüğü, kayıt mimarisi, ağ bant genişliği ve AI olay tespiti — dördü birlikte çalışmazsa sistem bir noktada kör kalır.',
			'12 yıllık saha tecrübemizden ders aldığımız şey: müşteri "şuradan dışarıyı görmek istiyorum" der; biz "şu sahnede ne olabileceğini, hangi olayın aksiyonu tetiklemesi gerektiğini" konuşuruz. Her kurulumumuz bu zihniyetle başlar.',
			'Hikvision, Dahua ve Uniview gibi yetkili bayisi olduğumuz markaların 4K IR, WDR, ColorVu ve AI destekli olay tespit serileri ile çalışıyoruz. Donanım seçimi her projede yeniden yapılır — kopyala-yapıştır kurulum yoktur.',
		],

		'specs' => [
			[ 'label' => 'Çözünürlük',       'value' => '4MP – 4K (8MP)',           'hint' => 'Hassas alanda 4K, perimeter\'da 4MP standart' ],
			[ 'label' => 'Sensör tipi',       'value' => 'IR / Color / Hybrid',      'hint' => 'Gece görüş, ColorVu ve hibrit kombinasyon' ],
			[ 'label' => 'Optik',             'value' => 'Sabit / Varifokal / PTZ',  'hint' => 'PTZ uzun perimeter, varifokal kapalı alanda' ],
			[ 'label' => 'AI olay tespiti',   'value' => 'Çizgi geçiş, perimeter, plaka, yüz, davranış' ],
			[ 'label' => 'Kayıt',             'value' => 'NVR + bulut hibrit',       'hint' => '30 günden 90 güne, RAID + offsite yedek' ],
			[ 'label' => 'Ağ',                'value' => 'PoE+ ile fiber/POE',        'hint' => 'Switch tarafımızdan boyutlandırılır' ],
			[ 'label' => 'Uzaktan erişim',    'value' => 'iOS · Android · Web',      'hint' => 'Markaya bağlı: Hik-Connect, gDMSS, EZView' ],
			[ 'label' => 'Çalışma sıcaklığı', 'value' => '−40°C → +60°C',             'hint' => 'Outdoor, IP67/IK10 modeller' ],
		],

		'process' => [
			[ 'num' => '01', 'title' => 'Saha keşfi', 'body' => 'Lokasyona yerinde gideriz. Risk noktalarını, kör açıları, ağ topolojisini ve kablolama olanaklarını çıkarırız. Tek sayfalık keşif notu paylaşılır.' ],
			[ 'num' => '02', 'title' => 'Kamera + NVR seçimi', 'body' => 'Her noktaya ihtiyaca göre kamera tipi seçilir — sabit/varifokal/PTZ, IR/ColorVu, AI/standart. NVR kapasitesi, depolama mimarisi ve yedek stratejisi bu adımda netleşir.' ],
			[ 'num' => '03', 'title' => 'Ağ ve kablolama', 'body' => 'POE+ switch boyutlandırması, kablolama (Cat6/fiber), VLAN ayrımı (CCTV ağı izole), uplink redundancy. Ağ ekibimiz devreye girer.' ],
			[ 'num' => '04', 'title' => 'Kurulum + AI kalibrasyonu', 'body' => 'Saha kurulumu kendi ekibimiz. Devreye almada AI olay tespit kuralları kalibre edilir — false alarm minimum, doğru tetikleme maksimum.' ],
			[ 'num' => '05', 'title' => 'Eğitim + bakım', 'body' => 'Operatör eğitimi, mobil uygulama setup, periyodik sağlık kontrolü ve olay anında destek. Bakım anlaşmasıyla sistem ömrü boyunca yanındayız.' ],
		],

		'sectors' => [
			'Üretim tesisleri ve fabrika perimeter güvenliği',
			'AVM ve plaza kurumsal güvenlik (çoklu kat, çoklu giriş)',
			'Çok şubeli zincir mağaza (merkezi yönetim)',
			'Tek nokta dükkan, kuyumcu, depo',
			'Lojistik depo ve ardiye (yükleme rampası, stok kontrolü)',
		],

		'faq' => [
			[ 'q' => 'Tesisim için kaç kamera ihtiyacım var?', 'a' => 'Bu soruya saha keşfi yapılmadan kesin cevap verilemez. Genel kural: kritik giriş/çıkışlar her zaman, perimeter (dış çevre) tek tarafta 30-50m kapsama, üretim hattı 10-15m kamera başına. Keşif sonrası net bir liste paylaşırız.' ],
			[ 'q' => 'AI olay tespiti gerçekten çalışıyor mu?', 'a' => 'Doğru kalibrasyonla evet. AI çizgi geçiş ve perimeter ihlali %95+ doğrulukla tetiklenir. Davranış tespiti (örn. yere düşme, koşma) %85-90 civarında. False alarm oranını düşürmek için her kameranın kuralları sahaya göre özel ayarlanır.' ],
			[ 'q' => 'Kayıtlar ne kadar saklanıyor?', 'a' => 'Standart: 30 gün NVR yerel kayıt + 7 gün buluta yedek. Yasal gereksinim, sektör veya müşteri tercihine göre 60/90 gün konfigüre edilebilir. Önemli olaylar manuel olarak da indirilebilir/arşivlenebilir.' ],
			[ 'q' => 'Var olan kamera sistemini güçlendirmek mümkün mü?', 'a' => 'Çoğu zaman evet. Mevcut kamera ve NVR\'ı koruyup AI özellikli ek modüller, daha iyi storage, mobile app entegrasyonu eklenebilir. Sıfırdan değişim ancak donanım çok eski ya da uyumsuzsa önerilir.' ],
			[ 'q' => 'Kurulum ne kadar sürer?', 'a' => 'Tek nokta küçük kurulum 1-3 gün. Orta ölçek (10-30 kamera) 5-10 gün. Büyük perimeter + multi-site projelerde 3-8 hafta. Kapsam tekliftekiyle aynı kalır, takvim sapması olursa önceden bildirilir.' ],
		],

		'gallery' => [],
	],

	// ═══════════════════════════════════════════════════════════
	// 02 — AĞ VE IT ALTYAPI (NETWORK)
	// ═══════════════════════════════════════════════════════════
	'network-it-altyapi' => [
		'num'       => '02',
		'tag'       => '10G · POE+ · VLAN · Wi-Fi 6',
		'title'     => 'Ağ ve IT Altyapı',
		'tagline'   => 'İşin trafiğini taşıyan, kararı destekleyen ağ.',
		'lead'      => 'Switch, access point, kablolama ve sunucudan bulut hibridine — ağı bir tedarik kalemi değil, mühendislik kararı olarak kuruyoruz. MikroTik, Ubiquiti, Cisco yetkili bayisi.',
		'hero_image' => '/wp-content/uploads/photos/photo-1544197150-b99a580bb7a8.jpg',

		'intro_paragraphs' => [
			'Bir CCTV sistemi ya da kablosuz alarm, kurulduğu ağdan iyi olamaz. Yanlış boyutlandırılmış switch, yanlış VLAN ayrımı, redundancy olmayan uplink — bunlar günlük operasyonu yavaşlatır, kritik olayda kör nokta yaratır.',
			'Ağ tarafında en sık karşılaştığımız sorun: müşteri "internet çalışıyor, başka ne lazım ki" diyor. Cevap: bant genişliği, latency, redundancy, segmentation, QoS — ihtiyaca göre boyutlandırılmış altyapı. Birinin eksikliği geri kalanını sınırlar.',
			'MikroTik\'ten enterprise Cisco\'ya kadar geniş yelpazede çalışıyoruz. Marka seçimi ihtiyaç + bütçe + sürdürülebilirlik üçlüsünün kararı — pahalı her zaman daha iyi değildir, ama "ucuz" çoğunlukla 3 yıl içinde geri ödenir.',
		],

		'specs' => [
			[ 'label' => 'Switch',           'value' => 'Layer 2 / Layer 3 yönetilebilir', 'hint' => '8/16/24/48 port + uplink, POE+ varyantları' ],
			[ 'label' => 'Wi-Fi',            'value' => 'Wi-Fi 6 / 6E / 7',                'hint' => 'Roaming, mesh, Wi-Fi calling desteği' ],
			[ 'label' => 'Uplink',           'value' => 'Fiber 10G + redundant',           'hint' => 'Site-to-site VPN, multi-WAN failover' ],
			[ 'label' => 'VLAN',             'value' => 'Operasyon / CCTV / Misafir izolasyonu' ],
			[ 'label' => 'Güvenlik',         'value' => 'Stateful firewall + IDS',          'hint' => 'MikroTik RouterOS, FortiGate, Sophos opsiyonları' ],
			[ 'label' => 'Uzaktan erişim',   'value' => 'WireGuard / OpenVPN / IPsec' ],
			[ 'label' => 'İzleme',           'value' => 'SNMP + Grafana / Zabbix dashboard' ],
			[ 'label' => 'Markalar',         'value' => 'MikroTik · Ubiquiti · Cisco · TP-Link Omada' ],
		],

		'process' => [
			[ 'num' => '01', 'title' => 'Saha keşfi + kapasite analizi', 'body' => 'Mevcut altyapı, cihaz sayısı, eş zamanlı kullanıcı, gelecek planı. Doğru boyutlandırma için temel.' ],
			[ 'num' => '02', 'title' => 'Topoloji + cihaz seçimi', 'body' => 'Star, ring, mesh — kapsama göre topoloji. Switch / AP / router / firewall seçimi marka-bağımsız değerlendirme ile.' ],
			[ 'num' => '03', 'title' => 'Kablolama + kurulum', 'body' => 'Cat6 / Cat6A / fiber (single/multi-mode). Patch panel, rack düzeni, kablo etiketleme. Hepsi standartlara göre.' ],
			[ 'num' => '04', 'title' => 'Konfigürasyon + güvenlik', 'body' => 'VLAN, QoS, firewall kuralları, VPN endpoint\'leri. Operasyon ağı + CCTV ağı + misafir ağı izolasyonu.' ],
			[ 'num' => '05', 'title' => 'Test + izleme + bakım', 'body' => 'Penetration test, throughput test, failover test. Grafana dashboard kurulur, periyodik sağlık takibi başlar.' ],
		],

		'sectors' => [
			'Çok şubeli zincir mağaza (merkezi yönetim, site-to-site VPN)',
			'Üretim tesisi (OT-IT segregation, factory floor Wi-Fi)',
			'Plaza ve AVM (yüksek kullanıcı, misafir Wi-Fi)',
			'Çağrı merkezi ve ofis (QoS for VoIP, redundant uplink)',
			'Lojistik depo (RFID + WMS ağ entegrasyonu)',
		],

		'faq' => [
			[ 'q' => 'MikroTik mi Cisco mu?', 'a' => 'Bütçe ve operasyon hakimiyetine bağlı. MikroTik orta ölçek için inanılmaz fiyat/performans, ama RouterOS öğrenme eğrisi var. Cisco kurumsal standart, ekosistemi güçlü ama lisans + maliyet yüksek. Her projede ihtiyaca göre öneriyoruz.' ],
			[ 'q' => 'Wi-Fi 6 / 6E / 7 — hangisi?', 'a' => 'Wi-Fi 6 (802.11ax) bugün için sweet spot — fiyat dengeli, performans yüksek. Wi-Fi 6E 6 GHz desteği isteyen yoğun ortamlar için. Wi-Fi 7 henüz erken aşamada, kurumsal cihaz portföyü olgunlaşmıyor. Standart önerimiz Wi-Fi 6.' ],
			[ 'q' => 'Redundant uplink şart mı?', 'a' => 'Operasyonu internete bağlı her tesis için ŞART. Tek WAN düştüğünde sistem durur. İki farklı ISP (örn. fiber + 5G yedek) önerimiz. Failover otomatik, kullanıcı fark etmez.' ],
			[ 'q' => 'Var olan switch\'lere yeni AP eklemek mümkün mü?', 'a' => 'Çoğunlukla evet, switch kapasitesi ve POE bütçesi yeterse. Bazı durumlarda switch upgrade gerekir — keşifte netleşir.' ],
			[ 'q' => 'Network kurulumu CCTV\'den ayrı mı yapıyorsunuz?', 'a' => 'Hayır, ikisi tek mühendislikte. CCTV trafiği VLAN\'da izole olur, ağ kapasitesi en başından kameraları kapsayacak şekilde planlanır. İki ayrı tedarikçi olduğunda sorumluluk gri alanı oluşuyor — bizde olmaz.' ],
		],

		'gallery' => [],
	],

	// ═══════════════════════════════════════════════════════════
	// 03 — AJAX KABLOSUZ ALARM
	// ═══════════════════════════════════════════════════════════
	'ajax-kablosuz-alarm' => [
		'num'       => '03',
		'tag'       => 'Kablosuz · Hub 2 · 7 yıl pil',
		'title'     => 'Ajax Kablosuz Alarm',
		'tagline'   => 'Algılayan, uyaran, raporlayan alarm.',
		'lead'      => 'Yetkili Ajax Bayisi olarak; Hub 2 / Hub 2 Plus, sensör ailesi ve mobil uygulama ile tam entegre alarm sistemleri. Kablosuz, 7 yıl pil ömrü, jamming koruması.',
		'hero_image' => '/wp-content/uploads/photos/photo-1558002038-1055907df827.jpg',

		'intro_paragraphs' => [
			'Geleneksel kablolu alarm sistemleri kurulum maliyeti, görsel kirlilik ve genişleme sıkıntıları nedeniyle artık tek opsiyon değil. Ajax\'ın kablosuz mimarisi her noktayı kabloya bağlamadan, ama kabloluya yakın güvenirlikte koruyor.',
			'Yetkili bayi olduğumuz Ajax sistemlerinin merkezi parçası Hub 2 / Hub 2 Plus — sensörlerden gelen sinyalleri toplayıp şifreli kanaldan bulut servisine iletir. Mobil uygulama (iOS / Android) sayesinde alarm anında push notification, rapor, video doğrulama tek ekranda.',
			'7 yıl pil ömrü, jamming koruması, IP55/IP65 outdoor sensörler, yangın/sızıntı/cam kırılma algılayıcıları — Ajax ekosistemi sadece "hırsız tespiti" değil, çok yönlü tehdit izlemesi.',
		],

		'specs' => [
			[ 'label' => 'Merkez',          'value' => 'Hub 2 / Hub 2 Plus / Hub Hybrid',  'hint' => 'GSM + Ethernet + Wi-Fi yedekli iletişim' ],
			[ 'label' => 'Sensörler',       'value' => 'PIR, MotionCam, glass break, door/window' ],
			[ 'label' => 'Çevresel',        'value' => 'Yangın, sel/sızıntı, sıcaklık, CO' ],
			[ 'label' => 'Frekans',         'value' => 'Jeweller (868 MHz)',               'hint' => 'Şifreli, jamming dirençli, tescilli protokol' ],
			[ 'label' => 'Pil ömrü',        'value' => '5–7 yıl (sensör)',                  'hint' => 'Pil bitmeden Hub uyarı verir' ],
			[ 'label' => 'Kapsama menzili', 'value' => '1.700 m açık alan, 30 cihaz/Hub' ],
			[ 'label' => 'Mobil uygulama',  'value' => 'Ajax Security System (iOS · Android · Web)' ],
			[ 'label' => 'Sertifika',       'value' => 'EN 50131 Grade 2 / 3' ],
		],

		'process' => [
			[ 'num' => '01', 'title' => 'Risk + ihtiyaç analizi', 'body' => 'Korunacak alanı, beklenen tehdit profilini (hırsızlık, yangın, sel, vandalizm), bütçeyi netleştiririz.' ],
			[ 'num' => '02', 'title' => 'Hub + sensör seçimi', 'body' => 'Hub 2 ya da Hub 2 Plus (büyük tesisler için), sensör tipleri (iç/dış mekan, PIR/MotionCam), sayı ve konumlandırma planı.' ],
			[ 'num' => '03', 'title' => 'Kurulum', 'body' => 'Yarım gün / tam gün, kablolama olmadığı için müdahale minimum. Cihazlar Hub\'a tek tek pairlenir, sahada test edilir.' ],
			[ 'num' => '04', 'title' => 'Mobil uygulama setup', 'body' => 'Yetkili kullanıcılar tanımlanır, push bildirim ve PRO erişim izinleri yapılandırılır. Sahip + admin + standart kullanıcı seviyeleri.' ],
			[ 'num' => '05', 'title' => 'İzleme + bakım', 'body' => 'Periyodik sensör testi, pil takibi, yazılım güncellemeleri. Bakım anlaşmasıyla yıllık sahaya bizzat geliyoruz.' ],
		],

		'sectors' => [
			'Kuyumcu ve değerli eşya mağazası',
			'Tek nokta dükkan, butik, eczane',
			'Apart, villa, residence',
			'Depo, ardiye, küçük üretim atölyesi',
			'Kreş, anaokulu, klinik (yangın/CO odaklı)',
		],

		'faq' => [
			[ 'q' => 'Kablosuz alarm gerçekten güvenli mi?', 'a' => 'Ajax\'ın Jeweller protokolü AES-128 şifreli, jamming-resistant. Hırsızın frekansı bozması durumunda Hub anında uyarır. Pratikte kablolu sistemlerden daha güvenli — kablo kesilmez, GSM/Ethernet/Wi-Fi yedeği var.' ],
			[ 'q' => 'Pil ne sıklıkta değiştiriliyor?', 'a' => 'Sensörlerin pili 5-7 yıl ortalama. Pil bitmeden 2-3 ay önce Hub mobil uygulamada uyarır. Bakım anlaşmasında pil değişimi dahil — sen takip etmiyorsun.' ],
			[ 'q' => 'İnternet kesilirse alarm çalışıyor mu?', 'a' => 'Evet. Hub 2 Plus 4 iletişim kanalı (Ethernet + Wi-Fi + 2× GSM SIM) destekler. Bir kanal kesilirse otomatik diğerine geçer. Tüm internet kesintisinde GSM çalışır.' ],
			[ 'q' => 'Var olan kameralarla entegre olur mu?', 'a' => 'Ajax\'ın MotionCam serisi (alarm tetiklediğinde foto çeken sensör) doğal entegre. Diğer markalar için Hub Hybrid ile bağlantı veya görsel doğrulama Ajax mobil uygulamasında.' ],
			[ 'q' => 'Aylık abonelik var mı?', 'a' => 'Ajax ekosistemi temel kullanım için ücretsiz — Hub + cihaz + mobil uygulama. İsteğe bağlı PRO Cloud (multi-tesis yönetimi, gelişmiş raporlama) küçük aylık ücret. Çoğu müşteri ihtiyaç duymuyor.' ],
		],

		'gallery' => [],
	],

	// ═══════════════════════════════════════════════════════════
	// 04 — YAZILIM GELİŞTİRME
	// ═══════════════════════════════════════════════════════════
	'yazilim-gelistirme' => [
		'num'       => '04',
		'tag'       => 'Web · iOS · Android · API',
		'title'     => 'Yazılım Geliştirme',
		'tagline'   => 'Sahaya konuşan yazılım.',
		'lead'      => 'Müşteri portalından çoklu lokasyon yönetim panellerine, plaka tanımadan IoT dashboard\'una — donanımla bütünleşen, ihtiyaca özel web ve mobil yazılım. TypeScript, Swift, Kotlin, Python stack.',
		'hero_image' => '/wp-content/uploads/photos/photo-1517694712202-14dd9538aa97.jpg',

		'intro_paragraphs' => [
			'Donanım kurarken fark ettik ki müşterinin ihtiyacı çoğu zaman kutudan çıkanın yetmediği yerden başlıyor. Çoklu lokasyon raporları, kendi ekibine özel dashboard, müşteri portalı, sahadaki cihazlardan toplanan veriyi anlamlı tabloya dönüştüren panel — hepsi yazılım katmanı.',
			'Sıfırdan ürün yazıyoruz, ama "sahaya konuşan" yazılım yapıyoruz. Yani CCTV NVR\'ından AI olay verisi çekmek, ağ izleme metriklerini Grafana\'dan beslemek, plaka tanıma sonuçlarını ERP\'ye işlemek — donanım entegrasyonu işin kalbi.',
			'Modern stack: TypeScript + Next.js / NestJS web, Swift + SwiftUI iOS, Kotlin + Compose Android, Python (FastAPI / scikit-learn) AI ve analitik. Mimari her projede yeniden şekilleniyor — kopyala-yapıştır ürün satmıyoruz.',
		],

		'specs' => [
			[ 'label' => 'Web stack',         'value' => 'TypeScript · Next.js · React · NestJS' ],
			[ 'label' => 'Mobile (iOS)',      'value' => 'Swift · SwiftUI · Combine' ],
			[ 'label' => 'Mobile (Android)',  'value' => 'Kotlin · Compose · Coroutines' ],
			[ 'label' => 'Backend',           'value' => 'Node.js · Python (FastAPI) · PostgreSQL · Redis' ],
			[ 'label' => 'AI / Analitik',     'value' => 'Python · OpenCV · scikit-learn · ONNX' ],
			[ 'label' => 'Entegrasyon',       'value' => 'REST · WebSocket · MQTT · ONVIF · RTSP' ],
			[ 'label' => 'Hosting',           'value' => 'Vercel · DigitalOcean · TR LiteSpeed (Hostinger TR)' ],
			[ 'label' => 'Sürüm yönetimi',    'value' => 'GitHub · CI/CD · staging + production' ],
		],

		'process' => [
			[ 'num' => '01', 'title' => 'Brief + kapsam', 'body' => 'Problem — kullanıcı — başarı kriteri. MVP nedir, faz 2 ne, bütçe nereye kadar — netleşir.' ],
			[ 'num' => '02', 'title' => 'Mimari tasarım', 'body' => 'Stack seçimi, veri modeli, entegrasyon noktaları, hosting kararı. Tek sayfalık teknik döküman paylaşılır.' ],
			[ 'num' => '03', 'title' => 'UX + UI', 'body' => 'Wireframe → tasarım → prototip. Müşteri her adımda görür, yön değiştirme erken aşamada ucuz.' ],
			[ 'num' => '04', 'title' => 'MVP + iterasyon', 'body' => '2-4 haftalık sprint\'ler. Her sprint sonu çalışan demo, müşteri feedback verir, sıradaki sprint planlanır.' ],
			[ 'num' => '05', 'title' => 'Devreye alma + bakım', 'body' => 'Production deploy, kullanıcı eğitimi, monitoring kurulumu. Bakım anlaşmasıyla bug fix, küçük geliştirmeler ve sürüm güncellemeleri.' ],
		],

		'sectors' => [
			'Çok şubeli zincir mağaza yönetim paneli (CCTV + alarm + satış raporu)',
			'Plaka tanıma + araç giriş-çıkış otomasyonu (otopark, fabrika)',
			'Müşteri portalı (servis isteği, fatura görüntüleme, randevu)',
			'IoT dashboard (sensör verisi, alarm logları, AI olay raporu)',
			'Saha mühendisi mobil uygulama (görev listesi, foto raporu, parça talep)',
		],

		'faq' => [
			[ 'q' => 'Hangi stack\'i seçiyorsunuz?', 'a' => 'Projeye göre. Web için Next.js + NestJS sweet spot — TypeScript end-to-end, modern, ekosistem güçlü. Mobile native tercihi (iOS Swift, Android Kotlin) — React Native veya Flutter "tek kod tabanı" sözüne karşın saha entegrasyonunda native her zaman daha güvenilir.' ],
			[ 'q' => 'Ne kadar sürer?', 'a' => 'Basit web portal: 3-6 hafta MVP. Mobil uygulama: 8-12 hafta. Donanım entegrasyonlu kompleks platform: 4-6 ay MVP. Brief detayına göre keşfede netleşir.' ],
			[ 'q' => 'Kodun sahibi kim?', 'a' => 'Sen. Tüm kod GitHub repo\'da müşteriye teslim edilir, dokümantasyon dahil. Bağımlılık yaratmayız — istersen başka geliştiriciyle de devam edebilirsin.' ],
			[ 'q' => 'Bakım nasıl çalışıyor?', 'a' => 'Aylık bakım anlaşması: bug fix dahil, küçük geliştirmeler saatlik. Sürüm güncellemeleri ve bağımlılık güncellemeleri planlı yapılır. Acil durum 24h yanıt.' ],
			[ 'q' => 'Mevcut donanımlarımıza entegre olur mu?', 'a' => 'Çoğunlukla evet. ONVIF, RTSP, REST API destekleyen tüm CCTV/NVR markaları (Hikvision, Dahua, Uniview, Axis...). Ajax alarm Hub PRO API üzerinden, MikroTik / Ubiquiti SNMP veya REST üzerinden. Özel cihaz protokolü varsa adapter yazıyoruz.' ],
		],

		'gallery' => [],
	],
];
