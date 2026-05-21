# Sazara — Production Deployment Guide

Local Docker geliştirme ortamından TR shared hosting (LiteSpeed tercihli) production ortamına geçiş için adım adım rehber.

## Önkoşullar

- [ ] Domain alındı: `sazara.com.tr` (Trabis veya Natro üzerinden ~₺250/yıl)
- [ ] Hosting hesabı: Natro / Turhost / Hostinger TR (LiteSpeed plan, min 1GB RAM, ~₺300-500/ay)
- [ ] FTP / SSH erişim bilgileri elde
- [ ] phpMyAdmin veya hosting'in DB import paneline erişim
- [ ] E-posta hosting (Google Workspace `hello@sazara.com.tr` ~$6/ay) veya hosting'in mail panelinde mailbox
- [ ] Cloudflare hesabı (free tier) — DNS + edge cache

## Adım 1 — Local DB Export

```bash
cd ~/Desktop/sazara/sazara-mvp/
make db-export   # db/dump.sql üretir
```

Çıktı: `db/dump.sql` (~150-300KB)

## Adım 2 — Tema + Uploads Paketle

```bash
cd ~/Desktop/sazara/sazara-mvp/
tar czf sazara-deploy.tar.gz \
  theme/sazara/ \
  uploads/ \
  mu-plugins/

ls -lah sazara-deploy.tar.gz
```

`mu-plugins/mailhog-mailer.php` production'da PASIF olmalı (env type kontrolü zaten var, sorun değil — istersen sadece dev'de kalsın diye `mu-plugins/` paketleme).

## Adım 3 — Hosting'de Fresh WP Install

Hosting cPanel/Plesk'inde:

1. **Softaculous** veya manuel WordPress install (6.6+)
2. Site URL: `https://sazara.com.tr`
3. Veritabanı oluştur: `sazara_prod` (ad istenen)
4. Admin user/pass not al

## Adım 4 — Tema + Plugin Yükleme

FTP/SSH ile `wp-content/themes/sazara/` klasörünü yükle. Sonra wp-admin'e gir:

- **Görünüm > Temalar > Sazara → Aktive et**
- **Eklentiler > Yeni Ekle** ile şunları yükle ve aktive et:
  - WooCommerce
  - Rank Math SEO
  - **Wordfence** (production'da AKTİF)
  - WPS Hide Login (slug: `sazara-giris` — _yeni_ slug seç, eski local slug'ı tahmin edilebilir kalmasın)
  - Fluent Forms
  - EWWW Image Optimizer
  - UpdraftPlus
  - Polylang
  - ACF Free
  - **LiteSpeed Cache** (host LiteSpeed ise) veya Cache Enabler

## Adım 5 — DB Import

1. **phpMyAdmin → sazara_prod database → Import** → `db/dump.sql` upload
2. Eğer fresh WP install'da WP zaten tabloları oluşturduysa, "DROP all" kontrolüyle import (UYARI: fresh kurulum siliniyor)

## Adım 6 — URL Search-Replace

WP-CLI hosting'de yoksa hosting'in WP-CLI desteği olabilir veya plugin "Better Search Replace" kullan:

```bash
# Hosting'de WP-CLI ile (eğer varsa):
wp search-replace 'http://localhost:8080' 'https://sazara.com.tr' --all-tables --skip-columns=guid

# veya GUI: Tools > Better Search Replace eklentisi
```

**Önemli**: `wp_options` tablosunda `siteurl` ve `home` doğru ayarlandığını kontrol et.

## Adım 7 — `.htaccess` + WP Config

1. `theme/sazara/htaccess.production` dosyasını `public_html/.htaccess` olarak kopyala (mevcut WordPress bloğunu koruyarak birleştir)
2. `wp-config.php`'a ekle:
   ```php
   define('WP_ENVIRONMENT_TYPE', 'production');
   define('WP_DEBUG', false);
   define('DISALLOW_FILE_EDIT', true);
   define('FORCE_SSL_ADMIN', true);
   ```

## Adım 8 — Plugin Konfigürasyonu

### Wordfence
- Setup wizard → Free plan
- 2FA aktif
- Brute force koruması açık
- Web Application Firewall: "Optimal" mode

### LiteSpeed Cache (host LiteSpeed ise)
- Cache: ON
- Image Optimization: WebP otomatik
- CSS/JS minify: ON
- Database cleanup: weekly cron

### Polylang
- Languages → Türkçe (default), İngilizce **opsiyonel** (henüz EN içerik yok, sonra ekle)

### Rank Math
- Setup wizard
- Verify Google Search Console
- Schema.org: zaten tema setliyor, Rank Math OG/Twitter tag'leri üretsin

### EWWW
- Bulk optimize: tüm media kütüphanesi
- WebP serving: ON

## Adım 9 — DNS + SSL

### Cloudflare
1. `sazara.com.tr` Cloudflare'e ekle
2. Nameserver'ları Trabis'ten Cloudflare'e değiştir
3. DNS records:
   - `A    sazara.com.tr    [hosting IP]    Proxied (turuncu bulut)`
   - `CNAME www  sazara.com.tr    Proxied`
   - `CNAME mail [hosting mail server] DNS only`
4. SSL/TLS → "Full (strict)"
5. Auto Minify: HTML, CSS, JS — ON
6. Brotli: ON
7. **Page Rules** veya **Cache Rules**:
   - `sazara.com.tr/wp-admin/*` → Cache Bypass
   - `sazara.com.tr/*` → Cache Everything, Edge TTL 1h

### Hosting SSL (Let's Encrypt)
Hosting cPanel'inde "AutoSSL" veya "Let's Encrypt" → tek tık ile SSL etkinleştir.

## Adım 10 — Email DNS

Mail teslim edilebilirliği için (form mail spam'e düşmesin):

```
SPF:    sazara.com.tr  TXT  "v=spf1 +mx +a +ip4:[hosting-ip] ~all"
DKIM:   default._domainkey.sazara.com.tr  TXT  "v=DKIM1; k=rsa; p=[public-key]"
DMARC:  _dmarc.sazara.com.tr  TXT  "v=DMARC1; p=quarantine; rua=mailto:postmaster@sazara.com.tr"
```

Google Workspace kullanıyorsan, GW kendi SPF/DKIM/DMARC gerektirir — admin paneli rehbere uy.

## Adım 11 — Pre-Launch Checklist

- [ ] Tema aktif: `https://sazara.com.tr` → editorial hero görünüyor
- [ ] Tüm route'lar 200: `/`, `/hizmetler/`, `/hizmet-kategorisi/kamera-sistemleri/`, `/urunler/`, `/iletisim/`, `/hakkimizda/`, `/kvkk/`, `/cerez-politikasi/`
- [ ] `/cart/`, `/checkout/`, `/my-account/` → 301 to `/iletisim/`
- [ ] Hiç add-to-cart butonu yok
- [ ] "Fiyat İçin İletişim" tüm ürünlerde
- [ ] Cookie banner görünüyor (ilk ziyarette)
- [ ] HTTPS otomatik redirect (HTTP → HTTPS 301)
- [ ] WPS Hide Login: `/sazara-giris/` çalışıyor; `/wp-login.php` → 404
- [ ] Wordfence aktif (production'da)
- [ ] Cache plugin aktif (LSCache veya Cache Enabler)
- [ ] Email test: form gönder → `hello@sazara.com.tr` mailbox'ına düştü mü? Spam'e düşmedi mi?
- [ ] Lighthouse mobile: Performance ≥85 (CDN cache ile), A11y 100
- [ ] OG share test: `https://www.opengraph.xyz/url/https%3A%2F%2Fsazara.com.tr` — görsel düzgün
- [ ] Schema.org test: `https://search.google.com/test/rich-results?url=https://sazara.com.tr` — LocalBusiness valid

## Adım 12 — TÜRKPATENT Marka Tescili

Site canlı olduktan sonra (paralel): **Sazara** kelime markası için sınıf 9 (yazılım/elektronik) + 42 (yazılım hizmetleri) tescil başvurusu. Maliyet ~₺3-6K, süre 6-12 ay.

## Sonradan Yapılacaklar (Yıl 1+)

- **sazara.com**: BrandBucket'ta $8.565 listed. İlk gelir gelince pazarlık ile $4-5K hedef.
- **EN dil aktivasyonu**: Polylang zaten kurulu; içerik çevirisi sonra eklenir.
- **AI/Otomasyon vertical sayfası**: 4. dikey için CPT term + service entries + nav link.
- **Site OS landing**: Sonsuza kadar gerçek ürün için adanmış sayfa.
- **Blog/Case study**: `case_study` CPT zaten kayıtlı, açılması yeter.
