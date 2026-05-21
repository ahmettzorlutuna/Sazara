<?php
/**
 * Hizmet verdiğimiz / birlikte çalıştığımız firmalar — anasayfa logo marquee.
 *
 * AYRIM:
 *   - inc/clients-data.php  → ÜRÜN MARKALARI (sattığımız: Hikvision, Ajax, TP-Link...)
 *   - inc/customers-data.php → MÜŞTERİLERİMİZ (hizmet verdiğimiz firmalar — bu dosya)
 *
 * Her firma için:
 *   - name      (zorunlu) : firma adı (alt/aria + logo yoksa text fallback)
 *   - logo_file (ops.)    : wp-content/uploads/customer-logos/ altındaki PNG/SVG
 *                            BOŞSA firma adı şık monokrom wordmark olarak gösterilir
 *   - sector    (ops.)    : sektör (ileride filtreleme için)
 *
 * ── LOGO EKLEMEK İÇİN ──────────────────────────────────────────────
 * 1. Firmanın logosunu PNG (tercihen şeffaf zemin) veya SVG olarak
 *    `wp-content/uploads/customer-logos/` klasörüne koy.
 *    Örn: kenan-metal.png, shell.png ...
 * 2. Aşağıda ilgili firmanın 'logo_file' alanına dosya yolunu yaz:
 *    'logo_file' => 'customer-logos/kenan-metal.png'
 * 3. Kaydet — anasayfa otomatik günceller. Logo gelene kadar firma adı
 *    metin olarak görünmeye devam eder (boş kutu olmaz).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

return [
	[ 'name' => 'Kenan Metal A.Ş.',            'logo_file' => 'customer-logos/kenan-metal.png',              'sector' => 'Üretim' ],
	[ 'name' => 'Planer Soğutma Mühendislik', 'logo_file' => 'customer-logos/planer-logo-gri.png',          'sector' => 'Mühendislik' ],
	[ 'name' => 'Sarper Petrol A.Ş.',          'logo_file' => 'customer-logos/sarper-petrol.png',            'sector' => 'Akaryakıt' ],
	[ 'name' => 'Total Benzin İstasyonları',   'logo_file' => 'customer-logos/total-logo.png',               'sector' => 'Akaryakıt' ],
	[ 'name' => 'Shell İstasyonları',          'logo_file' => 'customer-logos/shell-logo.png',               'sector' => 'Akaryakıt' ],
	[ 'name' => 'İstanbul Çiğköfte',           'logo_file' => 'customer-logos/istanbul-cigkofte-logo.png',   'sector' => 'Perakende' ],
	[ 'name' => 'Salkım Metal Kaplama',        'logo_file' => 'customer-logos/salkim-metal-kaplama-logo.png','sector' => 'Üretim' ],
	[ 'name' => 'Motorobit.com',               'logo_file' => 'customer-logos/motorobit-logo.png',           'sector' => 'E-ticaret' ],
	[ 'name' => 'Lider Rezidans',              'logo_file' => 'customer-logos/lider-logo.png',               'sector' => 'Kurumsal' ],
	[ 'name' => 'Keskinler Elektronik',        'logo_file' => 'customer-logos/keskinler-logo.png',           'sector' => 'Perakende' ],
	[ 'name' => 'Depa Ev ve Mutfak Gereçleri', 'logo_file' => 'customer-logos/depa-logo.jpg',				'sector' => 'Perakende' ],
];
