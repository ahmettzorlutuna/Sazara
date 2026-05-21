<?php
/**
 * Çalıştığımız markalar — referanslar sayfasındaki logo marquee'de gösterilir.
 *
 * Her marka için:
 *   - name      (zorunlu) : marka adı (a11y için alt / aria-label)
 *   - logo_file (öncelikli): wp-content/uploads/ altındaki PNG/JPG dosyası
 *                            (örn. 'partner-logos/hikvision.png')
 *   - svg_path  (alternatif): tema kökünden göreli SVG yolu (inline render)
 *   - logo_url  (alternatif): harici URL (önerilmez — bant genişliği + CSP)
 *   - category  (ops.)     : 'kamera' | 'alarm' | 'network' | 'aksesuar' | 'erisim'
 *
 * Logo öncelik sırası: logo_file → svg_path → logo_url → text fallback.
 *
 * Yeni marka eklemek için: PNG'yi `wp-content/uploads/partner-logos/`
 * altına koy, aşağıya yeni satır ekle.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [
	[
		'name'      => 'Hikvision',
		'logo_file' => 'partner-logos/hikvision.png',
		'category'  => 'kamera',
	],
	[
		'name'      => 'HiLook',
		'logo_file' => 'partner-logos/hilook.png',
		'category'  => 'kamera',
	],
	[
		'name'      => 'Ajax Systems',
		'logo_file' => 'partner-logos/ajax.jpg',
		'category'  => 'alarm',
	],
	[
		'name'      => 'Ruijie',
		'logo_file' => 'partner-logos/ruijie.png',
		'category'  => 'network',
	],
	[
		'name'      => 'Wi-Tek',
		'logo_file' => 'partner-logos/witek.png',
		'category'  => 'network',
	],
	[
		'name'      => 'ZKTeco',
		'logo_file' => 'partner-logos/zkteco.png',
		'category'  => 'erisim',
	],
	[
		'name'      => 'TP-Link',
		'logo_file' => 'partner-logos/tplink.png',
		'category'  => 'network',
	],
	[
		'name'      => 'S-Link',
		'logo_file' => 'partner-logos/slink.png',
		'category'  => 'aksesuar',
	],
	[
		'name'      => 'Logitech',
		'logo_file' => 'partner-logos/logitech.png',
		'category'  => 'aksesuar',
	],
	[
		'name'      => 'Philips',
		'logo_file' => 'partner-logos/philips.png',
		'category'  => 'aksesuar',
	],
	[
		'name'      => 'Imou',
		'logo_file' => 'partner-logos/imou.png',
		'category'  => 'kamera',
	],
	[
		'name'      => 'EZVIZ',
		'logo_file' => 'partner-logos/ezviz.png',
		'category'  => 'kamera',
	],
	[
		'name'      => 'Phixi',
		'logo_file' => 'partner-logos/phixi.png',
		'category'  => 'aksesuar',
	],
];
