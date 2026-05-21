# Sazara MVP — Geliştirme Ortamı

WordPress + WooCommerce vitrin sitesi için Docker tabanlı geliştirme ortamı.
Bilgisayara hiçbir şey kurulmaz — tüm bağımlılıklar container'larda.

## Gereksinimler

- Docker Desktop (Mac/Windows) veya Docker Engine + Docker Compose v2 (Linux)
- `make` (macOS Xcode tools'la, Linux'ta `build-essential`'la, Windows'ta WSL2 üzerinden)

## İlk kurulum

```bash
# 1. .env'i hazırla
cp .env.example .env
# (parolaları değiştirebilirsin — local-only)

# 2. Container'ları ayağa kaldır
make up

# 3. WordPress'i kur, tema aktif et, dili Türkçe yap
make bootstrap

# 4. Vitrin plugin'lerini yükle
make plugins
```

Yaklaşık 2-3 dakika sürer (ilk seferinde imajlar indirilir).

## Servisler

| Servis | URL | Amaç |
|---|---|---|
| WordPress | http://localhost:8080 | Site + /wp-admin |
| MailHog | http://localhost:8025 | Form mail testleri (gerçek mail göndermez) |
| phpMyAdmin | http://localhost:8081 | DB inceleme (user: `sazara`, pass: `.env`'deki) |

## Günlük komutlar

```bash
make up               # Servisleri başlat
make down             # Servisleri durdur (data korunur)
make logs             # WordPress loglarını izle
make ps               # Servis durumu
make shell            # WP container'ında bash
make wp -- <komut>    # WP-CLI komutu çalıştır

# Örnek WP-CLI:
make wp -- option get blogname
make wp -- plugin list
make wp -- search-replace 'eski' 'yeni' --dry-run
```

## DB yönetimi

```bash
make db-export        # db/dump.sql'e dump al
make db-import        # db/dump.sql'i geri yükle
```

## Tema geliştirme

`theme/sazara/` host'a bind-mount edilmiş — değiştirdiğin her dosya container'da anında görülür. Tarayıcıyı yenilemek yeterli.

```
theme/sazara/
├── theme.json        # Design system (renk, tipografi, spacing)
├── style.css         # FSE metadata
├── functions.php     # Theme bootstrap
├── inc/              # PHP modülleri (CPT, Woo, perf, vs.)
├── templates/        # FSE templates (HTML)
├── parts/            # FSE template parts
├── patterns/         # Block patterns (PHP)
└── assets/           # CSS, JS, fonts, img, icons
```

## Reset (her şeyi sıfırla)

```bash
make clean            # DB + WP core volumes'lerini siler (onay ister)
make reset            # clean + up + bootstrap + plugins (full re-init)
```

## Production'a göç

1. `make db-export` → `db/dump.sql`
2. `tar czf sazara-theme.tar.gz theme/sazara/`
3. Hosting'de WP fresh kur, tema yükle, DB import et
4. URL search-replace:
   ```bash
   wp search-replace 'http://localhost:8080' 'https://sazara.com.tr' --all-tables
   ```

## Sorun giderme

| Sorun | Çözüm |
|---|---|
| Port 8080/8025/8081 dolu | Çakışan servisi kapat veya `docker-compose.yml`'de port'u değiştir |
| `mariadb` healthcheck takılı | `docker compose down -v && make up` (DB volume sıfırlanır) |
| Tema görünmüyor | `make wp -- theme list` ile bak; aktif değilse `make wp -- theme activate sazara` |
| Form mail gelmiyor | MailHog UI: http://localhost:8025 — yerel ortamda gerçek mail GÖNDERILMEZ |
| `make: env: No such file or directory` | `cp .env.example .env` yapıldı mı? |
| **Sayfa 20+ saniyede açılıyor** | **Wordfence local'de yavaş** — `make wp -- plugin deactivate wordfence` (production'da aktif tutulur) |
| WooCommerce kurulum sihirbazı çıkıyor | Normal, ilk kurulum. İstersen `make wp -- option update woocommerce_onboarding_profile '{"completed":true}' --format=json` ile susturursun |

## Production-only plugin'ler

Yerel geliştirmede pasif tutulan ama production'da aktif edilecekler:
- **Wordfence**: WAF + login lockdown. Local'de cron tarama 20s+ delay yapıyor. Prod'a deploy ederken aktive et.
- **Cache plugin** (LiteSpeed Cache veya Cache Enabler): Yerel'de cache yok (geliştirme rahat olsun). Prod'da host LiteSpeed ise LSCache, değilse Cache Enabler.

## Görsel kaynaklar

`theme/sazara/assets/img/` altındaki atmosferik fotoğraflar **Unsplash** üzerinden CC0 lisansla self-host edilmiştir:

| Dosya | Kaynak | Konu |
|---|---|---|
| `hero-atmosphere.webp` | Unsplash photo-1551434678 | Hero arka plan (atmosfer) |
| `vertical-cctv.webp` | Unsplash photo-1557597774 | Kamera sistemleri kartı |
| `vertical-network.webp` | Unsplash photo-1558494949 | Network kartı |
| `vertical-software.webp` | Unsplash photo-1555066931 | Yazılım kartı |
| `about-atmosphere.webp` | Unsplash photo-1518770660 | Hakkımızda atmosfer |

Unsplash lisansı: ticari + ticari-olmayan kullanım için ücretsiz, attribution zorunlu değil ama önerilir. Production'a geçmeden önce gerçek kurumsal fotoğraflarla değiştirilmesi ideal.

**Duotone treatment**: `service-card.css` tüm görseli grayscale → multiply blend ile Sazara Rust + Ink karışımına çeviriyor → marka tutarlılığı.
