# Yeni Vaka Çalışması (Referans) Ekleme Rehberi

Bu rehber `sazara.com.tr/referanslar/` sayfasına yeni bir gerçek proje
eklemek için adım adım yapılacakları anlatır.

## 0. Bilmen gerekenler

- Tüm vaka içeriği **tek bir PHP dosyasında** yaşar:
  `theme/sazara/inc/cases-data.php`
- WordPress admin'de "Yeni Referans" diye bir buton yok. Her vaka
  PHP array'i olarak kodda. Sebep: içerik git ile versiyonlanır,
  istediğin zaman geri alabilirsin, lokalde test edip prod'a deploy
  edersin.
- Bir vaka eklediğinde `inc/routes.php` otomatik olarak ona bir WP
  child page yaratır — `/referanslar/<slug>/` URL'i hazır olur.

## 1. Görselleri hazırla

Her vaka için tipik olarak şu görselleri istersin:

- **1 hero görseli** — sayfanın üst kısmında büyük gösterilir
  (önerilen boyut: 1920×1080 veya daha geniş, en az 1600px geniş)
- **3-12 gallery görseli** — sayfanın alt kısmında grid + lightbox
  (önerilen boyut: 1600×1200, kare/yatay karışık olabilir)

**Dosya adı konvansiyonu** (önerilen, zorunlu değil):

```
01-perimeter-genel.jpg
02-nvr-rack.jpg
03-kamera-detay-01.jpg
04-kamera-detay-02.jpg
05-saha-ekibi.jpg
```

Sıra numarası ile başlat → admin'de Medya kütüphanesinde gruplu durur.

**Optimizasyon (önemli):**

- JPG için 75-85% kalite, AVIF veya WebP destekliyorsa onları kullan
- Hero için ~300-500 KB, gallery için ~150-300 KB hedefle
- WordPress'te EWWW Image Optimizer eklentisi zaten kurulu, otomatik
  küçültür ama büyük dosya yükleme = yavaş upload demek

## 2. Görselleri yükle — 2 seçenek

### Seçenek A — WordPress Medya Kütüphanesi (kolay, önerilen)

1. WP Admin → Medya → Yeni Ekle
2. Görselleri sürükle bırak
3. Her görselin URL'ini kopyala (Medya panelinde "Dosya URL'i")

Bu yöntemde URL'ler şuna benzer:
```
https://sazara.com.tr/wp-content/uploads/2026/01/01-perimeter-genel.jpg
```

### Seçenek B — Klasör yapısıyla yükle (düzen için ideal)

Hosting'in dosya yöneticisinden veya FTP ile:

```
wp-content/
└── uploads/
    └── cases/                          # önce yarat
        └── <vaka-slug>/                # vaka adıyla klasör
            ├── hero.jpg
            ├── 01-perimeter.jpg
            ├── 02-nvr-rack.jpg
            └── 03-kamera-detay.jpg
```

URL'ler şuna benzer:
```
/wp-content/uploads/cases/atlas-lojistik-depo/hero.jpg
```

Lokalde test etmek için: `sazara-mvp/uploads/cases/<slug>/` altına koy,
Docker stack'i `make up` ile çalıştır, aynı URL ile erişir.

## 3. Vakayı `cases-data.php`'ye ekle

`theme/sazara/inc/cases-data.php` dosyasını aç. En altta `return [`
ile başlayan büyük array var, mevcut 3 örnek vakanın sonuna virgül
koyup yeni satır ekle. Şablon:

```php
'atlas-lojistik-depo' => [
    // is_example satırını GERÇEK vakalar için KOYMA — sadece placeholder'larda olur
    // 'is_example' => true,

    'title'      => 'Atlas Lojistik — İkitelli Depo Perimeter Güvenliği',
    'client'     => 'Atlas Lojistik A.Ş.',     // gizli tutmak istersen "Lojistik firması" yaz
    'sector'     => 'Lojistik',                 // Lojistik / Üretim / Perakende / Kurumsal / Sağlık / Eğitim
    'location'   => 'İkitelli, İstanbul',
    'duration'   => '6 hafta',
    'scope'      => 'CCTV · Network · Ajax Alarm',
    'year'       => '2026',
    'team_size'  => '5 kişilik saha ekibi',
    'completion' => 'Ocak 2026',
    'hero_image' => '/wp-content/uploads/cases/atlas-lojistik-depo/hero.jpg',
    'tagline'    => 'Tek cümleyle özet — okuyucu "bu vakada ne yaptık" hemen anlasın.',

    'metrics' => [
        [ 'value' => '18.000', 'unit' => 'm²',     'label' => 'Korunan alan' ],
        [ 'value' => '14',     'unit' => 'kamera', 'label' => 'AI + PTZ' ],
        [ 'value' => '%0',     'unit' => '',       'label' => 'Yanlış alarm' ],
        [ 'value' => '14',     'unit' => 'ay',     'label' => 'Geri ödeme' ],
    ],

    'durum_intro'       => 'Durum/problem paragrafı buraya...',
    'durum_pain_points' => [
        'İlk pain point',
        'İkinci pain point',
        'Üçüncü pain point',
    ],

    'yaklasim' => 'Saha keşfini nasıl yaptığımız, neyi nasıl değerlendirdiğimiz — metodoloji.',

    'cozum_paragraphs' => [
        'Birinci çözüm paragrafı — hangi donanım, neden seçildi.',
        'İkinci çözüm paragrafı — kurulum detayı, kalibrasyon.',
        'Üçüncü çözüm paragrafı — entegrasyon, ağ, yedekleme.',
    ],

    'equipment' => [
        [ 'category' => 'Sabit Kamera', 'items' => 'Hikvision XYZ × 12' ],
        [ 'category' => 'PTZ Kamera',   'items' => 'Hikvision ABC × 2' ],
        [ 'category' => 'NVR',          'items' => 'Hikvision DEF × 1' ],
        // ...
    ],

    'timeline' => [
        [ 'phase' => 'Hafta 1',   'title' => 'Keşif',           'desc' => 'Saha keşfi ve tasarım onayı.' ],
        [ 'phase' => 'Hafta 2-3', 'title' => 'Kablolama',       'desc' => 'Cat6 + fiber çekim, kanal montaj.' ],
        [ 'phase' => 'Hafta 4',   'title' => 'Cihaz montajı',   'desc' => 'Kameralar ve sensörler.' ],
        [ 'phase' => 'Hafta 5',   'title' => 'Kalibrasyon',     'desc' => 'AI kuralları ve gece testleri.' ],
        [ 'phase' => 'Hafta 6',   'title' => 'Devreye alma',    'desc' => 'Eğitim ve teslim.' ],
    ],

    'sonuc_intro'    => 'Sonuç paragrafı — devreye almadan sonra ne oldu.',
    'sonuc_outcomes' => [
        'Somut sonuç #1 (rakamla)',
        'Somut sonuç #2',
        'Somut sonuç #3',
    ],

    'quote' => [
        'text'        => 'Müşterinin gerçek sözü.',
        'attribution' => 'Operasyon Direktörü, Atlas Lojistik',
    ],

    'brands' => [ 'Hikvision', 'Ajax Systems', 'Cisco' ],

    'gallery' => [
        [
            'src'     => '/wp-content/uploads/cases/atlas-lojistik-depo/01-perimeter.jpg',
            'alt'     => 'Depo çevresi panoramik kamera açısı',
            'caption' => 'Kuzey cephe perimeter — 4 sabit + 1 PTZ',
        ],
        [
            'src'     => '/wp-content/uploads/cases/atlas-lojistik-depo/02-nvr-rack.jpg',
            'alt'     => 'NVR ve switch rack kurulumu',
            'caption' => 'Sunucu odası — Cisco CBS350 omurga',
        ],
        [
            'src'     => '/wp-content/uploads/cases/atlas-lojistik-depo/03-kamera-detay.jpg',
            'alt'     => 'Kamera direği detay',
            'caption' => '6m direk üzerinde Hikvision ColorVu',
        ],
        // istediğin kadar ekleyebilirsin
    ],
],
```

### Zorunlu alanlar

`title`, `sector`, `location`, `year`, `scope`, `hero_image`, `tagline`

### Opsiyonel alanlar

`client` (gizliyse atla), `duration`, `team_size`, `completion`,
`metrics`, `durum_*`, `yaklasim`, `cozum_paragraphs`, `equipment`,
`timeline`, `sonuc_*`, `quote`, `brands`, `gallery`

Bir alanı boş bırakmak istersen ya alanı silebilir ya da boş array
`[]` veya boş string `''` koyabilirsin — template bunu kontrol eder
ve o bölümü render etmez.

### `is_example` flag'i hakkında

- Mevcut 3 placeholder vakası bu flag ile işaretli — sayfada
  "Örnek vaka" badge'i gözükür
- **Gerçek vakanı eklerken bu satırı koyma** veya `false` yap
- Hazır olduğunda mevcut placeholder vakaları sil:
  - Veriyi `cases-data.php`'den sil
  - WP admin → Sayfalar → o slug'lı sayfayı bul → çöpe taşı

## 4. Lokal'de test et

```bash
cd sazara-mvp
make up
```

http://localhost:8080/referanslar/ → yeni vakanı kartlar arasında gör

Karta tıklayıp `/referanslar/<senin-slug>/` aç, tüm bölümleri kontrol et:
- Hero, metrik strip, durum, yaklaşım, çözüm, ekipman, timeline, sonuç, müşteri sözü, gallery

**Görselin görünmüyor mu?**

- URL'i tarayıcıda direkt aç: doğru mu yükleniyor?
- Eğer 404 görüyorsan dosya yolu yanlış veya görsel yüklenmemiş demektir
- Lokal'de `uploads/cases/<slug>/` klasörüne baktığından emin ol

## 5. Prod'a deploy et

Normal git workflow'u:

```bash
git checkout -b feat/case-atlas-lojistik
git add theme/sazara/inc/cases-data.php uploads/  # uploads'ı da commitle (lokal test için)
git commit -m "feat(cases): add Atlas Lojistik İkitelli depo case study"
git push -u origin feat/case-atlas-lojistik
```

GitHub'da PR aç → merge et → CI otomatik prod'a iner.

**Prod görselleri için 2 seçenek:**

- **Eğer uploads/ git'te ise** → CI deploy'da otomatik iner
- **Eğer uploads/ git'te değilse (.gitignore'da)** → görselleri prod'a
  ayrıca yükle: WP admin → Medya Kütüphanesi veya FTP

`uploads/`'ın repo'da olup olmadığını kontrol et: `git status` çalıştır,
`uploads/cases/...` listede çıkarsa repo'da. Görmüyorsan `.gitignore`'da.

## 6. Sık sorular

**S: Bir vakayı yayından kaldırmak istersem?**
A: 2 yol var:
- Hızlı yol: `cases-data.php`'den o slug'ın array entry'sini sil
- Yumuşak yol: WP admin → Sayfalar → o sayfayı bul → "Taslak"a çek
  (URL hala var ama public değil)

**S: Bir vakayı düzeltmek istersem?**
A: `cases-data.php`'den ilgili alanı düzelt, git commit at, deploy
beklemeden lokalde gör.

**S: Bir görseli "before/after" göstermek istersem?**
A: Şu an before/after özel UI yok. Aynı gallery'ye 2 resmi sıralı koy,
caption'larda "Önce" / "Sonra" yaz — kullanıcı sırayla görür.
İleride istersen gallery'ye `'pair_with'` alanı eklenebilir.

**S: Bir vakayı diğerlerinden öne çıkarmak istersem?**
A: `cases-data.php`'de sırayı değiştir. PHP array sıralı çalışır,
listede üstte olanlar arşivin sol üstüne düşer.

**S: Her vaka için kaç metrik göstermeli?**
A: 4 metrik en iyisi (4'lü grid'e ideal oturuyor). 3 de olabilir,
5+ kalabalık görünür. Metrikler somut sayı olmalı: süre, alan,
adet, oran, tasarruf rakamları.

## 7. Yeni Benzin İstasyonu Vakası — hızlı şablon

Birden fazla istasyona hizmet verildiğinde her biri için ayrı bir vaka
sayfası tutmak SEO için değerli. Aşağıdaki bloku olduğu gibi kopyala,
`cases-data.php`'ye mevcut vakanın altına yapıştır, `[DOLDUR: ...]`
alanlarını doldur, slug'ı benzersiz yap.

**Slug adlandırma önerileri:**
- `benzin-istasyonu-basaksehir` (lokasyona göre)
- `benzin-istasyonu-opet-aslan` (bayi ismine göre)
- `benzin-istasyonu-e5-catalca` (yol/lokasyon)

Slug URL'e dönüşecek: `sazara.com.tr/referanslar/<slug>/`

```php
'benzin-istasyonu-XXXXX' => [
	'title'      => '[Şirket ismi] — [İlçe] Benzin İstasyonu Güvenlik Sistemi',
	'client'     => '[Müşteri firma adı, örn: OPET Bayii Aslan Akaryakıt]',
	'sector'     => 'Akaryakıt',
	'location'   => '[İlçe, İl — örn: Başakşehir, İstanbul]',
	'duration'   => '[örn: 3 hafta]',
	'scope'      => 'CCTV · Network · Alarm',
	'year'       => '2026',
	'team_size'  => '[örn: 3 kişilik saha ekibi]',
	'completion' => '[Ay Yıl — örn: Nisan 2026]',
	'hero_image' => '/wp-content/uploads/cases/benzin-istasyonu-XXXXX/hero.jpg',
	'tagline'    => '[Tek cümle özet]',

	'metrics' => [
		[ 'value' => 'N',   'unit' => 'kamera', 'label' => 'Toplam kamera' ],
		[ 'value' => 'N',   'unit' => 'ay',     'label' => 'Yedekleme süresi' ],
		[ 'value' => '%N',  'unit' => '',       'label' => 'Kritik alan kapsaması' ],
		[ 'value' => '24',  'unit' => 'saat',   'label' => 'Kesintisiz çalışma' ],
	],

	'durum_intro'       => '[Konum, trafik, güvenlik ihtiyacı bağlamı — 2-3 cümle]',
	'durum_pain_points' => [
		'[Sorun 1]',
		'[Sorun 2]',
		'[Sorun 3]',
	],

	'yaklasim' => '[Saha keşfi, risk analizi, çözüm kriterleri — 1-2 paragraf]',

	'cozum_paragraphs' => [
		'[Pompa alanı + tanklar çözümü]',
		'[Kasa/market içi çözümü]',
		'[Ağ, kayıt, uzaktan erişim çözümü]',
	],

	'equipment' => [
		[ 'category' => 'Sabit Kamera', 'items' => '[Model × adet]' ],
		[ 'category' => 'NVR',          'items' => '[Model]' ],
		[ 'category' => 'Depolama',     'items' => '[Kapasite]' ],
		[ 'category' => 'Switch / PoE', 'items' => '[Model]' ],
		[ 'category' => 'UPS',          'items' => '[Model]' ],
	],

	'timeline' => [
		[ 'phase' => 'Hafta 1', 'title' => 'Keşif ve tasarım',    'desc' => '[Detay]' ],
		[ 'phase' => 'Hafta 2', 'title' => 'Kablolama',            'desc' => '[Detay]' ],
		[ 'phase' => 'Hafta 3', 'title' => 'Cihaz montajı + test', 'desc' => '[Detay]' ],
	],

	'sonuc_intro'    => '[Devreye alma sonrası özet — 1-2 cümle]',
	'sonuc_outcomes' => [
		'[Sonuç 1]',
		'[Sonuç 2]',
		'[Sonuç 3]',
	],

	'quote' => [
		'text'        => '[Müşteri sözü]',
		'attribution' => '[İsim, Ünvan]',
	],

	'brands' => [ 'Hikvision' ],

	'gallery' => [
		[
			'src'     => '/wp-content/uploads/cases/benzin-istasyonu-XXXXX/01-pompa-alani.jpg',
			'alt'     => 'Pompa alanı kamera açısı',
			'caption' => 'Pompa alanı — 4 sabit kamera',
		],
		// gerekli kadar ekle
	],
],
```

**Fotoğraf yükleme klasörü:**
Her istasyon için ayrı klasör:
```
uploads/cases/
├── benzin-istasyonu-basaksehir/
│   ├── hero.jpg
│   ├── 01-pompa-alani.jpg
│   ├── 02-kasa.jpg
│   └── ...
├── benzin-istasyonu-catalca/
│   ├── hero.jpg
│   └── ...
```

Slug ile klasör adı **birebir aynı** olmalı ki `hero_image` ve `gallery` src'leri doğru çalışsın.

## 8. İyi bir vaka çalışmasının formülü

Başlık: ne, kim için, nerede → tek cümle  
Tagline: o vakanın "wow factor"u → tek cümle  
Metrikler: 4 rakam, mümkünse en az 2'si finansal/ölçülebilir  
Durum: müşterinin acısı, ne neden vardı  
Yaklaşım: nasıl düşündük, neyi değerlendirdik  
Çözüm: ne kurduk, niye o seçim  
Ekipman: kullanılan donanımlar (güven veriyor)  
Timeline: hafta hafta proje akışı (planlı çalışıyoruz mesajı)  
Sonuç: 3-5 somut çıktı, mümkünse rakamla  
Müşteri sözü: 1 cümle, gerçek isim/unvan ile  
Gallery: 4-10 saha fotoğrafı, caption'lı  

Bir vaka her bölümü içermek **zorunda değil**. Eksik bölümler
template'te otomatik gizlenir. Ama daha çok bölüm = daha güçlü
referans demek.
