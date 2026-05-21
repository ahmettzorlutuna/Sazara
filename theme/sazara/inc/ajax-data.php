<?php
/**
 * Ajax Systems tanıtım sayfası içeriği.
 *
 * templates/ajax.php bu dosyadan içerik çeker. Tek kaynak.
 * Görseller: wp-content/uploads/ajax/ (ajax.systems resmi render'ları,
 * yetkili bayi tanıtımı kapsamında).
 *
 * Bölümler: hero, why[], products[], technologies[], solutions[],
 *           app, certifications[], sazara[], faq[].
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$ajax_base = '/wp-content/uploads/ajax/';

return [

	'hero' => [
		'eyebrow'  => 'Ajax Systems · Yetkili PRO Kurulum Partneri',
		'title'    => 'Ajax. Mekânını yönet.',
		'lead'     => 'Hırsız alarmından yangın güvenliğine, kameradan otomasyona — ödüllü kablosuz güvenlik ekosistemi. Sazara, Ajax Systems Grade 2 sertifikalı PRO kurulum partneri olarak sahada.',
		'image'    => $ajax_base . 'installation.jpg',
	],

	// ─── NEDEN AJAX ───────────────────────────────────────────
	'why' => [
		[
			'title' => 'Yanlış alarm yok',
			'body'  => 'MotionCam görüntülü doğrulama + çift teknoloji sensörler. Operatör sahaya gitmeden önce gerçek tehdidi 9 saniyelik fotoğraf serisinden doğrular. Rüzgar, hayvan, gölge eler.',
		],
		[
			'title' => '7 yıl pil ömrü',
			'body'  => 'Jeweller protokolünün düşük güç tüketimi sayesinde dedektörler pil değişimi olmadan 7 yıla kadar çalışır. Bakım maliyeti minimum, kesinti riski sıfıra yakın.',
		],
		[
			'title' => 'Anti-sabotaj & anti-jamming',
			'body'  => 'Radyo karıştırma (jamming) tespiti, kurcalama sensörü, kasa açılma alarmı. Sistem kendini izler — saldırgan sistemi köreltmeye çalışırsa sen önce haberdar olursun.',
		],
		[
			'title' => 'Red Dot ödüllü tasarım',
			'body'  => 'Duvara asılı bir alarm değil, mekâna ait bir nesne. Red Dot ve iF Design ödüllü endüstriyel tasarım — kurumsal mekânda göze batmadan iş görür.',
		],
		[
			'title' => 'OS Malevich — sürekli güncel',
			'body'  => 'Ajax\'ın işletim sistemi OTA güncellemelerle yeni tehditlere ve özelliklere uyum sağlar. Donanım eskimez, sistem yazılımsal olarak gelişir.',
		],
		[
			'title' => 'Grade 2 sertifikalı',
			'body'  => 'EN 50131 Grade 2 uyumlu. Sigorta şirketlerinin ve kurumsal güvenlik politikalarının aradığı sertifikasyon — kurulum da bu standartta yapılır.',
		],
	],

	// ─── ÜRÜN EKOSİSTEMİ ──────────────────────────────────────
	'products' => [
		[
			'name'    => 'Hub 2',
			'tag'     => 'Kontrol Paneli',
			'desc'    => 'Sistemin beyni. 100+ cihaz, görüntülü doğrulama desteği, Ethernet + çift SIM (4G) yedekli haberleşme. İnternet kesilse bile alarm gider.',
			'image'   => $ajax_base . 'hub2.jpg',
			'specs'   => [ '100+ cihaz', 'Ethernet + 2×SIM', 'Görüntülü doğrulama', 'Bulut + yerel' ],
		],
		[
			'name'    => 'MotionCam',
			'tag'     => 'Görüntülü Hareket Dedektörü',
			'desc'    => 'Hareket algıladığında 9 saniyelik fotoğraf serisi çeker. Operatör "gerçek mi, yanlış mı" kararını saniyede verir. Ajax\'ı rakiplerinden ayıran teknoloji.',
			'image'   => $ajax_base . 'motioncam.jpg',
			'specs'   => [ '12 m menzil', 'HDR fotoğraf', 'IR aydınlatma', 'Pet-immune' ],
		],
		[
			'name'    => 'DoorProtect',
			'tag'     => 'Kapı / Pencere Sensörü',
			'desc'    => 'Manyetik açılma sensörü + opsiyonel titreşim ve eğim algılama. Kapı açıldığında, cama vurulduğunda ya da pencere zorlandığında anında tetiklenir.',
			'image'   => $ajax_base . 'doorprotect.jpg',
			'specs'   => [ 'Manyetik + titreşim', 'Eğim algılama', '7 yıl pil', 'Kablosuz' ],
		],
		[
			'name'    => 'KeyPad',
			'tag'     => 'Dokunmatik Tuş Takımı',
			'desc'    => 'Sistemi koddan kur/kapat. Dokunmatik, arkadan aydınlatmalı, kurcalama korumalı. Çoklu kullanıcı, kısmi kurulum senaryoları desteklenir.',
			'image'   => $ajax_base . 'keypad.jpg',
			'specs'   => [ 'Dokunmatik', 'Çoklu kullanıcı', 'Kısmi kurulum', 'Sessiz panik' ],
		],
		[
			'name'    => 'StreetSiren',
			'tag'     => 'Dış Mekan Siren',
			'desc'    => 'Caydırıcı 113 dB ses + LED flaş. Kasa açılma ve sökülme korumalı. Olay anında çevreyi uyarır, hırsızı sahadan kaçırır.',
			'image'   => $ajax_base . 'streetsiren.jpg',
			'specs'   => [ '113 dB', 'LED flaş', 'Anti-sabotaj', 'IP54 dış mekan' ],
		],
		[
			'name'    => 'TurretCam',
			'tag'     => 'IP Kamera',
			'desc'    => 'Ajax ekosistemine entegre kamera. Alarm anında canlı görüntü + kayıt aynı uygulamada. CCTV ile alarm artık tek panelde buluşur.',
			'image'   => $ajax_base . 'turretcam.jpg',
			'specs'   => [ '4K / gece görüş', 'AI nesne tespiti', 'Ajax app entegre', 'NVR kayıt' ],
		],
	],

	// ─── TEKNOLOJİ ────────────────────────────────────────────
	'technologies' => [
		[
			'name'  => 'Jeweller radyo protokolü',
			'body'  => 'İki yönlü şifreli kablosuz iletişim, 2.000 metreye kadar açık alan menzili. Her cihaz hub ile sürekli "el sıkışır" — bağlantı koparsa anında bilirsin. Düşük güç tüketimi 7 yıl pil ömrü demek.',
		],
		[
			'name'  => 'MotionCam görüntülü doğrulama',
			'body'  => 'Alarm tetiklendiği an dedektör fotoğraf serisi çeker, şifreli kanaldan uygulamaya ve izleme merkezine iletir. "Sahaya boşa gitme" sorununu kökten çözer — kararı görüntü verir.',
		],
		[
			'name'  => 'OS Malevich',
			'body'  => 'Ajax\'ın kendi işletim sistemi. Yılda birkaç kez OTA güncelleme ile yeni siber/fiziksel tehditlere yanıt verir, yeni cihaz ve senaryolar ekler. Donanımı değiştirmeden sistem gelişir.',
		],
		[
			'name'  => 'Anti-jamming & anti-sabotaj',
			'body'  => 'Sistem radyo karıştırma girişimini algılar ve bildirir. Tüm cihazlarda kasa açılma / sökülme sensörü vardır. Saldırgan sistemi köreltemeden sen haberdar olursun.',
		],
	],

	// ─── ÇÖZÜMLER (kullanım alanı) ────────────────────────────
	'solutions' => [
		[ 'title' => 'Ev & Rezidans',     'body' => 'Daire, villa, rezidans. Kablosuz olduğu için tadilat gerektirmez; tarihi / korumalı yapılarda da kuruluyor.' ],
		[ 'title' => 'Ofis & Plaza',       'body' => 'Kısmi kurulum (mesai içi/dışı), çoklu kullanıcı yetkilendirme, izleme merkezi entegrasyonu.' ],
		[ 'title' => 'Mağaza & Zincir',    'body' => 'Çok lokasyonlu yönetim, görüntülü doğrulama ile sigorta uyumu, dükkân bazında bağımsız arm/disarm.' ],
		[ 'title' => 'Depo & Fabrika',     'body' => 'Geniş perimeter, dış mekan dedektörleri, CCTV + alarm tek panelde, 7/24 izleme merkezi.' ],
	],

	// ─── AJAX APP ─────────────────────────────────────────────
	'app' => [
		'title' => 'Tek uygulama, tüm kontrol',
		'lead'  => 'Ajax Security App (iOS · Android) ile sistemi her yerden yönet: kur/kapat, bildirimleri gör, MotionCam fotoğraflarını incele, kullanıcı yetkilendir. Kurulumcular için PRO Desktop ile merkezi yönetim ve izleme.',
		'image' => $ajax_base . 'app.jpg',
		'points' => [
			'Anlık push bildirim + olay geçmişi',
			'MotionCam fotoğraf doğrulama ekranda',
			'Çoklu mekan, çoklu kullanıcı, rol bazlı yetki',
			'PRO Desktop — izleme merkezi & toplu yönetim',
		],
	],

	// ─── SERTİFİKALAR ─────────────────────────────────────────
	'certifications' => [
		[ 'label' => 'EN 50131 Grade 2', 'note' => 'Kurumsal & sigorta uyumlu güvenlik seviyesi' ],
		[ 'label' => 'EN 50131 Grade 3', 'note' => 'Seçili ürünlerde yüksek risk tesisleri için' ],
		[ 'label' => 'Red Dot Design',    'note' => 'Uluslararası endüstriyel tasarım ödülü' ],
		[ 'label' => 'CE / RoHS',          'note' => 'Avrupa uygunluk ve çevre standartları' ],
	],

	// ─── SAZARA + AJAX ────────────────────────────────────────
	'sazara' => [
		'title' => 'Neden Ajax\'ı Sazara\'dan kurdurmalısın?',
		'lead'  => 'Ajax\'ın gücü doğru kurulumla ortaya çıkar. Yanlış sensör yerleşimi en iyi donanımı bile köreltir.',
		'points' => [
			[ 'title' => 'Grade 2 sertifikalı PRO kurulum', 'body' => 'Ajax PRO Installer yetkisiyle, EN 50131 Grade 2 standardında saha kurulumu — sigorta ve denetim için belge dahil.' ],
			[ 'title' => 'Görüntülü doğrulama operasyonu',   'body' => 'MotionCam fotoğrafını yorumlayan, doğru-yanlış kararını veren operasyon kurgusu. Donanımı kurmak değil, çalıştırmak.' ],
			[ 'title' => 'CCTV + alarm tek mühendislik',     'body' => 'Ajax kamera + alarmı, mevcut CCTV ve ağ altyapınla tek panelde birleştiririz — disiplinler ayrı çalışmaz.' ],
			[ 'title' => '7/24 izleme + bakım',              'body' => 'Kurulum bitince bırakmıyoruz: periyodik sağlık kontrolü, OTA takibi, olay anında destek — bakım anlaşmasıyla.' ],
		],
	],

	// ─── SSS ──────────────────────────────────────────────────
	'faq' => [
		[ 'q' => 'Ajax kablosuz — güvenli mi, kablolu kadar sağlam mı?', 'a' => 'Jeweller protokolü iki yönlü şifreli iletişim kullanır ve her cihaz hub ile sürekli haberleşir. Bağlantı koparsa ya da radyo karıştırma denemesi olursa anında bildirim alırsın. Grade 2 sertifikası tam da bu güvenilirliği belgeler. Kablolu sistemin "kablo kesilince kör kalma" zaafı kablosuzda yoktur.' ],
		[ 'q' => 'Mevcut kamera/alarm sistemim var, Ajax entegre olur mu?', 'a' => 'Çoğu durumda evet. Ajax kameraları ve sensörleri mevcut CCTV/ağ altyapınla aynı panelde birleştirebiliriz. Tamamen değişim yerine kademeli geçiş de mümkün — keşifte mevcut sistemi değerlendirip yol haritası çıkarırız.' ],
		[ 'q' => 'Tadilat / kablo çekmek gerekiyor mu?', 'a' => 'Hayır. Ajax tamamen kablosuz — tek kablo çekilmeden kurulur. Tarihi yapı, kiralık ofis, korumalı bina gibi delik açılamayan yerlerde Ajax\'ın en büyük avantajı budur.' ],
		[ 'q' => 'Yanlış alarm derdi olur mu?', 'a' => 'Ajax\'ın MotionCam görüntülü doğrulaması + çift teknoloji sensörleri bu sorunu kökten çözer. Sensör tetiklendiğinde fotoğraf serisi gelir; rüzgar, evcil hayvan, gölge gibi yanlış pozitifler görüntüden anında elenir, boşa polis/bekçi sevki yapılmaz.' ],
		[ 'q' => 'Pil sık sık değişir mi?', 'a' => 'Hayır. Jeweller\'in düşük güç tüketimi sayesinde dedektörler 7 yıla kadar pille çalışır. Pil seviyesi uygulamadan sürekli izlenir; bitmeden çok önce bildirim gelir, sürpriz olmaz.' ],
	],
];
