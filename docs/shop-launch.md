# Shop (sazarateknoloji.com) Cross-Site Discovery — Aktivasyon Rehberi

Bu dosya "Bölüm B" (sazarateknoloji.com e-ticaret sitesi) canlıya
alındığında kurumsal siteden (sazara.com.tr) shop'a giden köprüleri
nasıl açacağını anlatır.

## Kısa özet

A5 sırasında shop discovery altyapısı kuruldu ama **kapalı** olarak
bırakıldı. Sebep: sazarateknoloji.com henüz sazara.com.tr'ye 301
redirect ediyor. Açık olsaydı kullanıcı "Mağaza"ya tıklayınca geldiği
siteye geri dönerdi (redirect loop UX).

Tek bir constant değiştirerek 4 discovery noktası aynı anda aktif olur.

## Aktivasyon — tek satır

Prod'da `wp-config.php`'yi aç ve şu satırı ekle:

```php
define( 'SAZARA_SHOP_ENABLED', true );
```

Yeri: `wp-config.php` dosyasında `That's all, stop editing!` yorumundan
**önce** olmalı. Sonrasına eklersen etkisiz kalır.

Tam örnek yerleşim:

```php
// ... mevcut define'lar ...

/**
 * Cross-site shop discovery — Bölüm B canlıya alındıktan sonra true yap.
 * Aktive olan yerler: header CTA, footer banner + link, homepage teaser.
 */
define( 'SAZARA_SHOP_ENABLED', true );

// Opsiyonel — shop domain'i override et. Varsayılan: https://sazarateknoloji.com
// define( 'SAZARA_SHOP_URL', 'https://shop.sazara.com.tr' );

/* That's all, stop editing! Happy publishing. */
require_once ABSPATH . 'wp-settings.php';
```

Değişiklikten sonra kaydet — WordPress dinamik olarak yeni değeri
okur, restart gerekmez. Bir tarayıcıda hard-refresh (`Cmd+Shift+R`)
yapıp göster.

## Neler açılır?

Tek constant → 4 render noktası aktif:

1. **Header nav — Mağaza butonu**  
   Sağ üstte "Teklif al" pill'inin **soluna** outline stil bir "🛍 Mağaza"
   butonu eklenir. Sayfa üstünde sabit (sticky nav).

2. **Anasayfa hero altı shop teaser bandı**  
   Hero'nun hemen altında nötr ink-tinted bir şerit:
   > "Mağaza · **Ürünlerimize göz atmak ister misin?** Ajax, Hikvision,
   > Dahua ve daha fazlası..."  
   > [Mağazayı ziyaret et →]

3. **Footer üstü koyu banner**  
   Ayrı bir footer üstü şerit, tam genişlik:  
   > **MAĞAZA**  
   > "Ajax, Hikvision, Dahua ve daha fazlası — online satış
   > sazarateknoloji.com üzerinden."  
   > [Mağazaya git →]

4. **Footer "Bilgi" kolonuna satır**  
   Mevcut Bilgi kolonuna 4. satır olarak "Mağaza" eklenir.

## Domain seçimi

Varsayılan URL `https://sazarateknoloji.com`. Bölüm B'de subdomain
tercih edilirse (`shop.sazara.com.tr` gibi), `wp-config.php`'de
`SAZARA_SHOP_URL` define ederek override et:

```php
define( 'SAZARA_SHOP_URL', 'https://shop.sazara.com.tr' );
```

## Copy (metin) düzenleme

Buton metinleri, banner mesajı, teaser copy'si tek yerde:
`theme/sazara/inc/shop-config.php` içindeki `sazara_shop_copy()`
fonksiyonu. Bölüm B kampanyası veya launch mesajı için burayı düzenle:

```php
function sazara_shop_copy(): array {
    return [
        'nav_cta'         => __( 'Mağaza', 'sazara' ),
        'nav_cta_new'     => __( 'Mağaza · Yeni', 'sazara' ),
        'footer_heading'  => __( 'Mağaza', 'sazara' ),
        'footer_lead'     => __( 'Ajax, Hikvision, Dahua ve daha fazlası — online satış sazarateknoloji.com üzerinden.', 'sazara' ),
        'footer_cta'      => __( 'Mağazaya git', 'sazara' ),
        'hero_teaser'     => __( 'Ürünlerimize göz atmak ister misin?', 'sazara' ),
        'hero_teaser_cta' => __( 'Mağazayı ziyaret et', 'sazara' ),
    ];
}
```

Değişiklik → git commit → CI otomatik prod'a iner. `SAZARA_SHOP_ENABLED`
`true` iken metinler canlıda gözükür.

## Neden config-driven?

- **Redirect loop koruması**: shop yokken CTA'lar da yok, kullanıcı
  hiçbir zaman kendi sitesine geri gönderilmez.
- **Launch günü tek satır**: prod'da wp-config.php'de tek satır edit
  yeterli. Tema kod deploy'u beklemez, DB migration gerekmez.
- **Copy iterasyonu**: launch copy'sini launch mesajından ayrı olarak
  düzenleyebilirsin. Marketing mesajını değiştirmek için code deploy
  gerekmez.
- **Rollback**: shop'ta bir sorun çıkarsa `true` → `false` yap, tüm
  CTA'lar anında kaybolur.

## Test — lokal preview

Bölüm B canlı olmadan da lokal'de "shop açıksa nasıl gözükür"
görebilirsin:

1. Lokal `wp-config.php` (Docker `sazara-mvp/db/wp-config.php` veya
   container içinden) düzenle:

   ```php
   define( 'SAZARA_SHOP_ENABLED', true );
   define( 'SAZARA_SHOP_URL', 'https://example.com' );  // dummy
   ```

2. `make up` sonrası http://localhost:8080 → 4 discovery noktasını gör
3. Tıkladığında example.com'a gider (dummy) — logic testi için yeterli

Kalıcı hale gelmemesi için lokal test sonrası flag'i tekrar `false` yap
veya bu değişikliği commit'leme.

## Aktivasyon checklist (Bölüm B launch günü)

- [ ] sazarateknoloji.com (veya seçilen domain) canlı, HTTP 200 dönüyor
- [ ] Ana kategori sayfaları erişilebilir
- [ ] Ödeme sandbox test edildi
- [ ] `sazara_shop_copy()` içindeki metinler launch versiyonu ile güncel
- [ ] Prod `wp-config.php`'de `SAZARA_SHOP_ENABLED = true`
- [ ] sazara.com.tr'de header'da "Mağaza" butonu görünüyor
- [ ] Anasayfa hero altında shop teaser var
- [ ] Footer'da shop banner + Bilgi kolonu link var
- [ ] Tıklamalar shop'a düşüyor (redirect loop yok)
- [ ] Mobile'de banner ve teaser stackleniyor
