<?php
/**
 * Yetkili bayilikler & üretici partnerlikleri.
 *
 * Her partner için:
 *   - name        : marka adı
 *   - status      : "Authorized Dealer", "PRO Installer", "Channel Partner" vb.
 *   - since       : ortaklık başlangıç yılı
 *   - scope       : kapsam (1 cümle — ürün kategorisi + bölgesel)
 *   - tagline     : tek satır vurgu
 *   - cert_url    : (opsiyonel) sertifika sayfası dış link
 *   - logo_text   : marka adı (logo yoksa fallback wordmark olarak basılır)
 *   - logo_file   : (öncelikli) wp-content/uploads/ altındaki gerçek logo dosyası
 *                   — örn. 'partner-logos/hikvision.png'. Resmi marka logoları.
 *   - svg_path    : (alternatif) tema kökünden göreli SVG yolu (inline render).
 *                   currentColor kullanır. logo_file yoksa devreye girer.
 *
 * Logo öncelik sırası: logo_file → svg_path → logo_text (wordmark).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [

	[
		'name'      => 'Hikvision',
		'status'    => 'Authorized Dealer',
		'since'     => '2015',
		'scope'     => 'IP kamera serisi, NVR, AI olay tespit, ColorVu, AcuSense — Türkiye distribütör onaylı bayi.',
		'tagline'   => 'AI destekli olay tespit + 4K ColorVu serisinde 9 yıl tecrübe.',
		'logo_text' => 'HIKVISION',
		'logo_file' => 'partner-logos/hikvision.png',
		'svg_path'  => 'assets/logos/partners/hikvision.svg',
	],

	[
		'name'      => 'Ajax Systems',
		'status'    => 'PRO Installer · Grade 2',
		'since'     => '2019',
		'scope'     => 'MotionCam görüntü doğrulamalı sensörler, Hub 2 Plus, kablosuz alarm tam ekosistemi.',
		'tagline'   => 'Görüntü doğrulamalı alarm + Grade 2 sertifikalı kurulum.',
		'logo_text' => 'AJAX',
		'logo_file' => 'partner-logos/ajax.jpg',
		'svg_path'  => 'assets/logos/partners/ajax.svg',
	],

	[
		'name'      => 'Ubiquiti',
		'status'    => 'Enterprise Partner',
		'since'     => '2017',
		'scope'     => 'UniFi WiFi 6/7, Dream Machine Pro, Enterprise switch serisi, UNVR kamera ağı.',
		'tagline'   => 'Kurumsal WiFi mesh + VLAN izolasyon mimarisinde uzman.',
		'logo_text' => 'UBIQUITI',
		'logo_file' => 'partner-logos/ubiquiti.png',
		'svg_path'  => 'assets/logos/partners/ubiquiti.svg',
	],

	[
		'name'      => 'Dahua Technology',
		'status'    => 'Channel Partner',
		'since'     => '2016',
		'scope'     => 'WizMind serisi AI kamera, Smart PSS yönetim platformu, multi-site entegrasyon.',
		'tagline'   => 'WizMind AI + multi-site merkezi yönetim — yetkili kanal partner.',
		'logo_text' => 'DAHUA',
		'logo_file' => 'partner-logos/dahua.png',
		'svg_path'  => 'assets/logos/partners/dahua.svg',
	],

	[
		'name'      => 'Uniview',
		'status'    => 'Authorized Reseller',
		'since'     => '2020',
		'scope'     => 'IP kamera ColorHunter serisi, EZStation ve EZView mobil platform.',
		'tagline'   => 'Mobil-öncelikli kamera erişimi + ColorHunter gece görüş.',
		'logo_text' => 'UNIVIEW',
		'logo_file' => 'partner-logos/uniview.png',
		'svg_path'  => 'assets/logos/partners/uniview.svg',
	],

];
