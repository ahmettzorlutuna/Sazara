<?php
/**
 * Anasayfa — Modern Cinematic White.
 *
 * Mockup'tan birebir port. Hero (full-bleed photo + büyük tipografi reveal) →
 * brands → 4 service-card 2x2 → teknik diyagram → atmosphere strip →
 * bento sektörler → FAQ → CTA banner.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Hero zemini — Customizer'dan seçilmişse o, yoksa tema içindeki kurumsal toplantı odası fotoğrafı
// (Unsplash, ücretsiz lisans — wEi2LkDF8LY, kırpılmış; 1920x1080 WebP).
$hero_img_id  = get_theme_mod( 'sazara_hero_image' );
$hero_img_src = $hero_img_id
	? wp_get_attachment_image_url( $hero_img_id, 'sazara-hero' )
	: SAZARA_URI . '/assets/images/hero-boardroom.webp';

// Hizmet verdiğimiz firmalar — anasayfa logo marquee (sosyal kanıt).
// Ürün markaları (Hikvision vb.) Referanslar sayfasında; bu ayrı liste.
$homepage_customers = require SAZARA_DIR . '/inc/customers-data.php';
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_img_src ); ?>" alt="" width="1920" height="1080" loading="eager" fetchpriority="high">
		</div>

		<div class="wrap hero__content">
			<p class="hero__eyebrow"><?php esc_html_e( 'Aykosan · İkitelli · İstanbul', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--wide"><?php
				printf(
					/* translators: %s: vurgulu kısım */
					wp_kses_post( __( '%s ve <em>Yapay Zeka ile Geliştirilen Yazılım Ürünleri</em>', 'sazara' ) ),
					esc_html__( 'Kurumsal Bilişim Altyapısı', 'sazara' )
				);
			?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Claude AI ile geliştirdiğimiz kendi SaaS ürünlerimizin yanında, aynı mühendislikle kamera, ağ ve kablosuz alarm altyapılarını kuruyoruz — yazılım ve donanım tek çatı altında.', 'sazara' ); ?></p>

			<a href="#sazara-pdks" class="hero__product">
				<span class="hero__product-badge"><?php esc_html_e( 'Yeni', 'sazara' ); ?></span>
				<span class="hero__product-text"><?php esc_html_e( 'Yeni Ürünümüz Sazara PDKS\'yi İnceleyin', 'sazara' ); ?></span>
				<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
			</a>

			<div class="hero__cta-row">
				<a href="<?php echo esc_url( home_url( '/hizmetler/' ) ); ?>" class="btn btn--primary">
					<span><?php esc_html_e( 'Hizmetlere göz at', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
				<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="btn btn--ghost"><?php esc_html_e( 'Teklif al', 'sazara' ); ?></a>
			</div>

			<dl class="hero__meta">
				<div><dt class="hero__meta-num">12+</dt><dd class="hero__meta-label"><?php esc_html_e( 'Yıl saha tecrübesi', 'sazara' ); ?></dd></div>
				<div><dt class="hero__meta-num">40+</dt><dd class="hero__meta-label"><?php esc_html_e( 'Tesis &amp; şube', 'sazara' ); ?></dd></div>
				<div><dt class="hero__meta-num">7/24</dt><dd class="hero__meta-label"><?php esc_html_e( 'Uzaktan izleme', 'sazara' ); ?></dd></div>
				<div><dt class="hero__meta-num"><?php esc_html_e( 'İkitelli', 'sazara' ); ?></dt><dd class="hero__meta-label"><?php esc_html_e( 'Aykosan · İstanbul', 'sazara' ); ?></dd></div>
			</dl>
		</div>

		<div class="hero__scroll" aria-hidden="true">
			<span><?php esc_html_e( 'Kaydır', 'sazara' ); ?></span>
			<span class="hero__scroll-line"></span>
		</div>
	</section>

	<!-- ════════ FLAGSHIP ÜRÜN: SAZARA PDKS ════════ -->
	<?php
	$pdks_img_rel = 'assets/images/pdks-dashboard.webp';
	$pdks_has_img = file_exists( SAZARA_DIR . '/' . $pdks_img_rel );
	?>
	<section class="pdks" id="sazara-pdks" aria-labelledby="pdks-title">
		<div class="wrap">

			<header class="pdks__head reveal">
				<span class="pdks__eyebrow">
					<?php esc_html_e( 'Flagship ürün · B2B SaaS', 'sazara' ); ?>
					<span class="pdks__badge"><?php esc_html_e( 'Yeni', 'sazara' ); ?></span>
				</span>
				<h2 class="pdks__title" id="pdks-title"><?php esc_html_e( 'Sazara PDKS: Yapay Zeka ve Claude ile Geliştirilen Yeni Nesil Personel ve Hakediş Yönetimi', 'sazara' ); ?></h2>
				<p class="pdks__tagline"><?php esc_html_e( 'Yapay zeka ile tasarlandı, kural tabanlı çalışır: hatasız hakediş hesabı için.', 'sazara' ); ?></p>
				<p class="pdks__lead"><?php esc_html_e( 'Sistemin çekirdek mimarisi, karmaşık mesai ve hakediş algoritmaları ile kural motoru Claude AI kullanılarak tasarlanmış ve geliştirilmiştir. Çalışma zamanında ise açıklanabilir, kural tabanlı bir altyapı kullanır: aynı girdi her zaman aynı sonucu verir, her kalem hangi kurala dayandığını gösterir, tutarsızlıklar bordroya yansımadan işaretlenir.', 'sazara' ); ?></p>
			</header>

			<div class="pdks__stage reveal">
				<div class="pdks__frame">
					<div class="pdks__frame-bar" aria-hidden="true">pdks.sazara.com.tr</div>
					<?php if ( $pdks_has_img ) : ?>
						<img class="pdks__shot"
						     src="<?php echo esc_url( SAZARA_URI . '/' . $pdks_img_rel ); ?>"
						     alt="<?php esc_attr_e( 'Sazara PDKS yönetim paneli — genel bakış, kim nerede ve cihaz durumu', 'sazara' ); ?>"
						     width="1800" height="1014" loading="lazy" decoding="async">
					<?php else : ?>
						<?php // Görsel eklenene kadar placeholder: assets/images/pdks-dashboard.webp ?>
						<div class="pdks__shot pdks__shot--placeholder" role="img" aria-label="<?php esc_attr_e( 'Sazara PDKS yönetim paneli önizlemesi', 'sazara' ); ?>">
							<span><?php esc_html_e( 'Sazara PDKS paneli', 'sazara' ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<ul class="pdks__features" role="list">
				<li class="pdks__card reveal">
					<span class="pdks__card-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M18.4 5.6l-2.1 2.1M7.7 16.3l-2.1 2.1"/><circle cx="12" cy="12" r="3.2"/></svg>
					</span>
					<h3 class="pdks__card-title"><?php esc_html_e( 'AI-Built Engine (Claude)', 'sazara' ); ?></h3>
					<p class="pdks__card-desc"><?php esc_html_e( 'Mesai ve hakediş algoritmaları ile kural motoru Claude AI ile tasarlandı ve geliştirildi. Hesaplama kural tabanlıdır: aynı girdi her zaman aynı, açıklanabilir sonucu verir.', 'sazara' ); ?></p>
				</li>
				<li class="pdks__card reveal">
					<span class="pdks__card-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M7 18a4.5 4.5 0 0 1-.4-8.98A6 6 0 0 1 18 8.5a4 4 0 0 1-.5 7.98"/><path d="M12 12v8M9 17l3 3 3-3"/></svg>
					</span>
					<h3 class="pdks__card-title"><?php esc_html_e( 'B2B SaaS Mimari', 'sazara' ); ?></h3>
					<p class="pdks__card-desc"><?php esc_html_e( 'Çoklu şube ve bulut altyapısı; her firma kendi yetki ve veri sınırında, tek panelden yönetilen şirket yapısı.', 'sazara' ); ?></p>
				</li>
				<li class="pdks__card reveal">
					<span class="pdks__card-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7M9 17h7M9 9h2"/></svg>
					</span>
					<h3 class="pdks__card-title"><?php esc_html_e( 'Gelişmiş Dokümantasyon', 'sazara' ); ?></h3>
					<p class="pdks__card-desc"><?php esc_html_e( 'Otomatik oluşturulan kurumsal kılavuzlar; hesaplama kuralları ve süreçler her zaman güncel, denetime hazır.', 'sazara' ); ?></p>
				</li>
			</ul>

			<aside class="pdks__roadmap reveal" aria-labelledby="pdks-roadmap-title">
				<div class="pdks__roadmap-tag">
					<span class="pdks__roadmap-badge"><?php esc_html_e( 'Yol haritası', 'sazara' ); ?></span>
					<span class="pdks__roadmap-status"><?php esc_html_e( 'Geliştirme aşamasında', 'sazara' ); ?></span>
				</div>
				<div class="pdks__roadmap-body">
					<h3 class="pdks__roadmap-title" id="pdks-roadmap-title"><?php esc_html_e( 'Gelecek vizyonumuz: AI destekli İK asistanı', 'sazara' ); ?></h3>
					<p class="pdks__roadmap-desc"><?php esc_html_e( 'Claude API entegrasyonu ile yöneticilerin karmaşık vardiya kurallarını doğal dille sisteme tanımlayabileceği ve devamlılık verilerini analiz edebileceği bir asistan üzerinde çalışıyoruz.', 'sazara' ); ?></p>
					<p class="pdks__roadmap-note"><?php esc_html_e( 'Bu özellik henüz canlı sistemde yoktur. Bugünkü hakediş hesabı %100 kural tabanlıdır (deterministik).', 'sazara' ); ?></p>
				</div>
			</aside>

			<div class="pdks__cta reveal">
				<a href="<?php echo esc_url( SAZARA_PDKS_URL ); ?>" class="btn btn--accent" target="_blank" rel="noopener">
					<span><?php esc_html_e( 'Platforma Git (pdks.sazara.com.tr)', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M7 17 17 7M8 7h9v9"/></svg>
				</a>
				<span class="pdks__cta-note"><?php esc_html_e( 'Claude AI ile geliştirildi · Çoklu şube · Bulut tabanlı', 'sazara' ); ?></span>
			</div>

		</div>
	</section>

	<!-- ════════ SAZARA PDKS — ÖZELLİK SATIRLARI ════════ -->
	<?php
	// Her satır: görsel dosyası theme/sazara/assets/images/ altına konunca otomatik görünür.
	$pdks_rows = [
		[
			'tag'   => __( 'Cihaz entegrasyonu', 'sazara' ),
			'title' => __( 'Cihaz kaydı kendisi gönderir.', 'sazara' ),
			'desc'  => __( 'Terminaller her okutmayı internet üzerinden Sazara\'ya iletir. Port yönlendirme ya da sabit IP gerekmez; cihazın internete çıkabilmesi yeterli.', 'sazara' ),
			'items' => [
				__( 'Hikvision terminallerle sahada doğrulandı', 'sazara' ),
				__( 'Eşleşmemiş kayıtlar kaybolmaz; numara bağlanınca geçmişe dönük çalışana işlenir', 'sazara' ),
				__( 'Cihazın ne zamandan beri sessiz olduğu panelde görünür', 'sazara' ),
				__( 'Cihaz kurulumu ve yazılım aynı ekipten', 'sazara' ),
			],
			'note'  => '',
			'image' => 'pdks-cihazlar.webp',
			'alt'   => __( 'Sazara PDKS cihazlar sayfası — bağlı terminaller ve durum göstergeleri', 'sazara' ),
			'label' => __( 'Cihazlar', 'sazara' ),
		],
		[
			'tag'   => __( 'Çalışma düzeni', 'sazara' ),
			'title' => __( 'Çalışma saatlerini 1 dakikada kurun.', 'sazara' ),
			'desc'  => __( 'Basit düzenler için sihirbaz, karmaşık düzenler için vardiya, plan ve atama. Her değişiklik bugünden itibaren geçerli olur, geçmiş bozulmaz.', 'sazara' ),
			'items' => [
				__( 'Sihirbazla ilk mesai düzeni dakikalar içinde hazır', 'sazara' ),
				__( 'Ayarlar sürümlüdür: geçmiş günler o günkü düzenle hesaplanır', 'sazara' ),
				__( 'Gece vardiyası, dünden süren kayıtla doğru gösterilir', 'sazara' ),
				__( 'Tatil günleri ve izinler aynı takvimde', 'sazara' ),
			],
			'note'  => '',
			'image' => 'pdks-calisma-duzeni.webp',
			'alt'   => __( 'Sazara PDKS çalışma saatleri sihirbazı', 'sazara' ),
			'label' => __( 'Çalışma saatleri', 'sazara' ),
		],
		[
			'tag'   => __( 'Hakediş', 'sazara' ),
			'title' => __( 'Kapanan aydan kalem kalem hakediş.', 'sazara' ),
			'desc'  => __( 'Dönemi kapatın, taslağı hesaplayın, kişi kişi kontrol edin, kesinleştirin. Kesinleşen hakediş değişmez; yanlışsa gerekçeyle geri alınır.', 'sazara' ),
			'items' => [
				__( 'Normal ücret, fazla çalışma, tatil çalışması, gece zammı ve kesintiler ayrı kalemlerde', 'sazara' ),
				__( 'Tutarlar kuruş hassasiyetiyle, ara adımda yuvarlama olmadan hesaplanır', 'sazara' ),
				__( 'Excel, CSV ve Logo aktarım dosyası çıktısı', 'sazara' ),
			],
			'note'  => __( 'Pro pakette. Brüt hakediş ve puantaj üretir; bordro yerine geçmez.', 'sazara' ),
			'image' => 'pdks-hakedis.webp',
			'alt'   => __( 'Sazara PDKS hakediş ay sayfası — kişi bazında kalem kalem hakediş', 'sazara' ),
			'label' => __( 'Raporlar › Hakediş', 'sazara' ),
		],
		[
			'tag'   => __( 'Denetim', 'sazara' ),
			'title' => __( 'Her kayıt kanıt değeri taşır.', 'sazara' ),
			'desc'  => __( 'Cihazdan gelen kayıt hiçbir koşulda silinmez ya da değiştirilmez. Düzeltmeler ayrı kayıt olarak girer ve izi kalır.', 'sazara' ),
			'items' => [
				__( 'Elle düzeltme ayrı kayıttır; gerekçesi yazılır, geri alınabilir', 'sazara' ),
				__( 'Silmek yerine iptal: kim, ne zaman, neden bilgisi saklanır', 'sazara' ),
				__( 'Kapatılan döneme yazılamaz', 'sazara' ),
				__( 'Panelde yapılan her işlem silinemez işlem geçmişine yazılır', 'sazara' ),
			],
			'note'  => '',
			'image' => 'pdks-islem-gecmisi.webp',
			'alt'   => __( 'Sazara PDKS işlem geçmişi — kim, ne zaman, ne yaptı', 'sazara' ),
			'label' => __( 'Ayarlar › İşlem geçmişi', 'sazara' ),
		],
		[
			'tag'   => __( 'Uyum', 'sazara' ),
			'title' => __( 'Biyometrik veri saklamaz.', 'sazara' ),
			'desc'  => __( 'Sazara PDKS parmak izi ya da yüz şablonu ve görüntü saklamaz. Cihazlarda doğrulama modunun yalnızca kart olması önerilir.', 'sazara' ),
			'items' => [
				__( 'Biyometriyi kabul edecek şekilde ayarlı cihaz, kurulum kutusunda uyarıyla işaretlenir', 'sazara' ),
				__( 'Çalışanlar panele girmez; kayıtları yalnızca firmanın yönetici kullanıcıları yönetir', 'sazara' ),
				__( 'Uyum raporu ile eksik ve riskli kayıtlar görünür', 'sazara' ),
			],
			'note'  => __( 'Bu bir hukuki görüş değildir; kararınızdan önce hukuk müşavirinize danışın.', 'sazara' ),
			'image' => 'pdks-uyum.webp',
			'alt'   => __( 'Sazara PDKS uyum raporu', 'sazara' ),
			'label' => __( 'Raporlar › Uyum raporu', 'sazara' ),
		],
	];
	?>
	<section class="section pdks-rows" id="pdks-ozellikler" aria-label="<?php esc_attr_e( 'Sazara PDKS özellikleri', 'sazara' ); ?>">
		<div class="wrap">
			<?php foreach ( $pdks_rows as $i => $row ) : ?>
				<?php
				$row_img_rel = 'assets/images/' . $row['image'];
				$row_has_img = file_exists( SAZARA_DIR . '/' . $row_img_rel );
				?>
				<article class="pdks-row<?php echo 0 === $i % 2 ? '' : ' pdks-row--flip'; ?> reveal">
					<div class="pdks-row__copy">
						<span class="pdks-row__tag"><?php echo esc_html( sprintf( '%02d — %s', $i + 1, $row['tag'] ) ); ?></span>
						<h3 class="pdks-row__title"><?php echo esc_html( $row['title'] ); ?></h3>
						<p class="pdks-row__desc"><?php echo esc_html( $row['desc'] ); ?></p>
						<ul class="pdks-row__list" role="list">
							<?php foreach ( $row['items'] as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
						<?php if ( '' !== $row['note'] ) : ?>
							<p class="pdks-row__note"><?php echo esc_html( $row['note'] ); ?></p>
						<?php endif; ?>
					</div>
					<div class="pdks-row__media">
						<div class="pdks__frame">
							<div class="pdks__frame-bar" aria-hidden="true"><?php echo esc_html( $row['label'] ); ?></div>
							<?php if ( $row_has_img ) : ?>
								<img class="pdks__shot"
								     src="<?php echo esc_url( SAZARA_URI . '/' . $row_img_rel ); ?>"
								     alt="<?php echo esc_attr( $row['alt'] ); ?>"
								     loading="lazy" decoding="async">
							<?php else : ?>
								<div class="pdks__shot pdks__shot--placeholder pdks__shot--row" role="img" aria-label="<?php echo esc_attr( $row['alt'] ); ?>">
									<span><?php echo esc_html( $row['label'] ); ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ════════ SHOP TEASER (dormant Bölüm B canlıya alınana kadar) ════════ -->
	<?php if ( sazara_shop_can_render( 'hero_teaser' ) ) : ?>
		<?php $shop_copy = sazara_shop_copy(); ?>
		<section class="shop-teaser">
			<div class="wrap shop-teaser__inner">
				<div class="shop-teaser__copy">
					<span class="shop-teaser__badge"><?php echo esc_html( $shop_copy['footer_heading'] ); ?></span>
					<p class="shop-teaser__text">
						<strong><?php echo esc_html( $shop_copy['hero_teaser'] ); ?></strong>
						<?php echo esc_html( $shop_copy['footer_lead'] ); ?>
					</p>
				</div>
				<a href="<?php echo esc_url( sazara_shop_url() ); ?>"
				   class="shop-teaser__link"
				   rel="noopener"
				   target="_blank">
					<span><?php echo esc_html( $shop_copy['hero_teaser_cta'] ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
		</section>
	<?php endif; ?>

	<!-- ════════ HİZMET VERDİĞİMİZ FİRMALAR ════════ -->
	<?php if ( ! empty( $homepage_customers ) ) : ?>
	<section class="customer-strip">
		<div class="wrap">
			<span class="customer-strip__label"><?php esc_html_e( 'Hizmet verdiğimiz firmalar', 'sazara' ); ?></span>
		</div>

		<div class="logo-marquee reveal" role="region" aria-label="<?php esc_attr_e( 'Hizmet verdiğimiz firmalar', 'sazara' ); ?>">
			<div class="logo-marquee__track">
				<?php for ( $pass = 0; $pass < 2; $pass++ ) : ?>
					<?php foreach ( $homepage_customers as $customer ) : ?>
						<?php
						// Logo öncelik: logo_file (img) → firma adı text fallback.
						// Helper toleranslı: tam yol / göreli yol / URL hepsi çalışır.
						$customer_img = sazara_resolve_upload_logo( $customer['logo_file'] ?? '' );
						?>
						<div class="logo-marquee__item"<?php echo 1 === $pass ? ' aria-hidden="true"' : ''; ?>
						     title="<?php echo esc_attr( $customer['name'] ); ?>">
							<?php if ( $customer_img ) : ?>
								<img src="<?php echo esc_url( $customer_img ); ?>"
								     alt="<?php echo esc_attr( $customer['name'] ); ?>"
								     loading="lazy">
							<?php else : ?>
								<span class="logo-marquee__text"><?php echo esc_html( $customer['name'] ); ?></span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endfor; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ HİZMETLER + DİYAGRAM ════════ -->
	<section class="section section--services" id="hizmetler">
		<div class="wrap">

			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '01 — Hizmetlerimiz', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Dört dikey, tek mühendislik.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Donanım, ağ, kablosuz alarm ve yazılım — birbirinden ayrı çalışan dört disiplin değil; aynı projede konuşan tek bir sistem mühendisliği.', 'sazara' ); ?></p>
			</header>

			<ul class="services" role="list">

				<li class="service-card reveal">
					<a href="<?php echo esc_url( home_url( '/hizmetler/kamera-sistemleri/' ) ); ?>" class="service-card__media">
						<span class="service-card__tag">CCTV · 4K · IR</span>
						<img src="<?php echo esc_url( home_url( '/wp-content/uploads/photos/photo-1557597774-9d273605dfa9.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Uniview 4MP turret IP kameralar — kırmızı tuğla cephe montajı', 'sazara' ); ?>" width="1600" height="1000" loading="lazy" decoding="async">
					</a>
					<div class="service-card__body">
						<span class="service-card__num">01 / Kamera</span>
						<h3 class="service-card__title"><?php esc_html_e( 'Kamera Sistemleri ve Güvenlik', 'sazara' ); ?></h3>
						<p class="service-card__desc"><?php esc_html_e( 'IP kamera kurulumu, NVR ve kayıt sistemleri, AI destekli olay tespiti — kameranın yalnızca kayıt değil, karar verdiği sistemler.', 'sazara' ); ?></p>
						<ul class="service-card__specs">
							<li>4K · IR</li><li>WDR</li><li>AI tespit</li><li>Çoklu lokasyon</li>
						</ul>
						<p class="service-card__soft"><span>&lt;/&gt; Yazılım katmanı</span> <?php esc_html_e( 'Merkezi izleme paneli · olay raporlama · mobil bildirim', 'sazara' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/hizmetler/kamera-sistemleri/' ) ); ?>" class="service-card__cta"><?php esc_html_e( 'İncele', 'sazara' ); ?></a>
					</div>
				</li>

				<li class="service-card reveal">
					<a href="<?php echo esc_url( home_url( '/hizmetler/network-it-altyapi/' ) ); ?>" class="service-card__media">
						<span class="service-card__tag">10G · POE+ · VLAN</span>
						<img src="/wp-content/uploads/photos/photo-1544197150-b99a580bb7a8.jpg" alt="<?php esc_attr_e( 'Server rack ve network ekipmanları — POE+ switch ve fiber omurga', 'sazara' ); ?>" width="1600" height="1000" loading="lazy" decoding="async">
					</a>
					<div class="service-card__body">
						<span class="service-card__num">02 / Network</span>
						<h3 class="service-card__title"><?php esc_html_e( 'Ağ ve IT Altyapı', 'sazara' ); ?></h3>
						<p class="service-card__desc"><?php esc_html_e( 'Switch, access point, kablolama ve sunucudan bulut hibridine — işin trafiğini taşıyan, yönetilebilir ve sürdürülebilir ağ.', 'sazara' ); ?></p>
						<ul class="service-card__specs">
							<li>Wi-Fi 6/6E</li><li>POE+</li><li>VPN</li><li>Site-to-site</li>
						</ul>
						<p class="service-card__soft"><span>&lt;/&gt; Yazılım katmanı</span> <?php esc_html_e( 'Ağ izleme dashboard\'u · otomatik alarm ve raporlama', 'sazara' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/hizmetler/network-it-altyapi/' ) ); ?>" class="service-card__cta"><?php esc_html_e( 'İncele', 'sazara' ); ?></a>
					</div>
				</li>

				<li class="service-card reveal">
					<a href="<?php echo esc_url( home_url( '/hizmetler/ajax-kablosuz-alarm/' ) ); ?>" class="service-card__media">
						<span class="service-card__tag">Kablosuz · 7 yıl pil</span>
						<img src="/wp-content/uploads/photos/ajax-iot-market-kart.jpg" alt="<?php esc_attr_e( 'Ajax kablosuz alarm — modern smart kontrol paneli', 'sazara' ); ?>" width="920" height="533" loading="lazy" decoding="async">
					</a>
					<div class="service-card__body">
						<span class="service-card__num">03 / Alarm</span>
						<h3 class="service-card__title"><?php esc_html_e( 'Ajax Kablosuz Alarm', 'sazara' ); ?></h3>
						<p class="service-card__desc"><?php esc_html_e( 'Yetkili Ajax bayisi olarak; sensör, keypad ve hub kurulumu + 7/24 izleme + mobil uygulama ile tam entegre alarm.', 'sazara' ); ?></p>
						<ul class="service-card__specs">
							<li>Hub 2</li><li>iOS · Android</li><li>7/24 izleme</li>
						</ul>
						<p class="service-card__soft"><span>&lt;/&gt; Yazılım katmanı</span> <?php esc_html_e( 'Olay entegrasyonu · özel API ve raporlama katmanı', 'sazara' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/hizmetler/ajax-kablosuz-alarm/' ) ); ?>" class="service-card__cta"><?php esc_html_e( 'İncele', 'sazara' ); ?></a>
					</div>
				</li>

				<li class="service-card reveal">
					<a href="<?php echo esc_url( home_url( '/hizmetler/yazilim-gelistirme/' ) ); ?>" class="service-card__media">
						<span class="service-card__tag">Web · iOS · Android</span>
						<img src="/wp-content/uploads/photos/photo-1555066931-4365d14bab8c.jpg" alt="<?php esc_attr_e( 'Yazılım geliştirme — çoklu monitör üzerinde kod editörü', 'sazara' ); ?>" width="1600" height="1000" loading="lazy" decoding="async">
					</a>
					<div class="service-card__body">
						<span class="service-card__num">04 / Yazılım</span>
						<h3 class="service-card__title"><?php esc_html_e( 'Yazılım Geliştirme', 'sazara' ); ?></h3>
						<p class="service-card__desc"><?php esc_html_e( 'Müşteri portalından çoklu lokasyon yönetim panellerine, plaka tanımadan saha entegrasyonuna — ihtiyaca özel web ve mobil yazılım.', 'sazara' ); ?></p>
						<ul class="service-card__specs">
							<li>Web · mobil</li><li>API</li><li>Analitik</li>
						</ul>
						<a href="<?php echo esc_url( home_url( '/hizmetler/yazilim-gelistirme/' ) ); ?>" class="service-card__cta"><?php esc_html_e( 'İncele', 'sazara' ); ?></a>
					</div>
				</li>
			</ul>

			<!-- Teknik diyagram -->
			<div class="diagram reveal">
				<div class="diagram__head">
					<h3><?php esc_html_e( 'Tek mühendislikte birleşen dört disiplin', 'sazara' ); ?></h3>
					<span class="diagram__pill"><?php esc_html_e( 'Online · 12/12 nodes', 'sazara' ); ?></span>
				</div>
				<svg class="diagram__svg" viewBox="0 0 960 320" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet" focusable="false">
					<defs>
						<marker id="diagram-arrow" viewBox="0 0 8 8" refX="6" refY="4" markerWidth="6" markerHeight="6" orient="auto">
							<path d="M0,0 L8,4 L0,8 z" fill="oklch(52% 0.22 260)"/>
						</marker>
					</defs>
					<g font-family="Geist Mono, monospace" font-size="14" font-weight="500">
						<g><rect x="40" y="60" width="160" height="60" rx="12" fill="oklch(20% 0.005 260)" stroke="oklch(52% 0.22 260 / .5)"/><text x="120" y="92" text-anchor="middle" fill="oklch(99% 0 0)" font-size="14" letter-spacing=".06em">CCTV</text><text x="120" y="108" text-anchor="middle" fill="oklch(99% 0 0 / .5)" font-size="10">[01]</text></g>
						<g><rect x="40" y="200" width="160" height="60" rx="12" fill="oklch(20% 0.005 260)" stroke="oklch(52% 0.22 260 / .5)"/><text x="120" y="232" text-anchor="middle" fill="oklch(99% 0 0)" font-size="14" letter-spacing=".06em">NETWORK</text><text x="120" y="248" text-anchor="middle" fill="oklch(99% 0 0 / .5)" font-size="10">[02]</text></g>
						<g><rect x="760" y="60" width="160" height="60" rx="12" fill="oklch(20% 0.005 260)" stroke="oklch(52% 0.22 260 / .5)"/><text x="840" y="92" text-anchor="middle" fill="oklch(99% 0 0)" font-size="14" letter-spacing=".06em">ALARM</text><text x="840" y="108" text-anchor="middle" fill="oklch(99% 0 0 / .5)" font-size="10">[03]</text></g>
						<g><rect x="760" y="200" width="160" height="60" rx="12" fill="oklch(20% 0.005 260)" stroke="oklch(52% 0.22 260 / .5)"/><text x="840" y="232" text-anchor="middle" fill="oklch(99% 0 0)" font-size="14" letter-spacing=".06em">YAZILIM</text><text x="840" y="248" text-anchor="middle" fill="oklch(99% 0 0 / .5)" font-size="10">[04]</text></g>
					</g>
					<g>
						<circle cx="480" cy="160" r="62" fill="oklch(20% 0.005 260)" stroke="oklch(52% 0.22 260)" stroke-width="1.5"/>
						<circle cx="480" cy="160" r="14" fill="oklch(52% 0.22 260)"/>
						<text x="480" y="225" text-anchor="middle" font-family="Geist, sans-serif" font-size="16" font-weight="500" fill="oklch(99% 0 0)" letter-spacing="-.02em">SAZARA</text>
						<text x="480" y="242" text-anchor="middle" font-family="Geist Mono, monospace" font-size="9" font-weight="500" fill="oklch(99% 0 0 / .55)" letter-spacing=".18em">TEK MÜHENDİSLİK</text>
					</g>
					<path class="line" d="M 200 90 Q 340 90 418 130" marker-end="url(#diagram-arrow)"/>
					<path class="line" d="M 200 230 Q 340 230 418 190" marker-end="url(#diagram-arrow)"/>
					<path class="line" d="M 760 90 Q 620 90 542 130" marker-end="url(#diagram-arrow)"/>
					<path class="line" d="M 760 230 Q 620 230 542 190" marker-end="url(#diagram-arrow)"/>
				</svg>
				<ul class="diagram__caps" role="list" aria-label="<?php esc_attr_e( 'Yazılım yeteneklerimiz', 'sazara' ); ?>">
					<li><?php esc_html_e( 'Web &amp; mobil paneller', 'sazara' ); ?></li>
					<li><?php esc_html_e( 'API &amp; saha entegrasyonu', 'sazara' ); ?></li>
					<li><?php esc_html_e( 'Olay raporlama &amp; analitik', 'sazara' ); ?></li>
					<li><?php esc_html_e( 'B2B SaaS · Sazara PDKS', 'sazara' ); ?></li>
				</ul>
			</div>
		</div>
	</section>

	<!-- ════════ ATMOSPHERE ════════ -->
	<section class="atmosphere">
		<?php
		$atmo_id = get_theme_mod( 'sazara_atmosphere_image' );
		if ( $atmo_id ) {
			$atmo_url = wp_get_attachment_image_url( $atmo_id, 'sazara-hero' );
		} else {
			$atmo_url = '/wp-content/uploads/photos/photo-1497366216548-37526070297c.jpg';
		}
		?>
		<img src="<?php echo esc_url( $atmo_url ); ?>" alt="" loading="lazy">
		<div class="atmosphere__caption">
			<span class="atmosphere__tag"><?php esc_html_e( 'Aykosan · İkitelli', 'sazara' ); ?></span>
			<h2 class="atmosphere__title"><?php esc_html_e( 'Sahanın içinden, ekibimizle birlikte.', 'sazara' ); ?></h2>
			<span class="atmosphere__meta"><?php esc_html_e( '12+ yıl saha tecrübesi · İstanbul ve çevre iller', 'sazara' ); ?></span>
		</div>
	</section>

	<!-- ════════ SEKTÖRLER (BENTO) ════════ -->
	<section class="section section--canvas" id="sektorler">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Sektörlerimize Özel', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Farklı saha, aynı disiplin.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Üretim hattının izlemesinden zincir mağaza yönetimine, AVM güvenliğinden tek nokta dükkan kurulumuna kadar.', 'sazara' ); ?></p>
			</header>

			<ul class="bento" role="list">
				<li class="bento__tile reveal">
					<img src="/wp-content/uploads/photos/photo-1504917595217-d4dc5ebe6122.jpg" alt="<?php esc_attr_e( 'Fabrika üretim hattı ve makine parkı', 'sazara' ); ?>" loading="lazy" decoding="async">
					<div class="bento__caption">
						<span class="bento__tag"><?php esc_html_e( 'Üretim · Fabrika', 'sazara' ); ?></span>
						<h3 class="bento__title"><?php esc_html_e( 'Fabrikalar', 'sazara' ); ?></h3>
						<span class="bento__meta"><?php esc_html_e( 'Üretim hattı izleme · OT-IT entegrasyonu', 'sazara' ); ?></span>
					</div>
				</li>
				<li class="bento__tile reveal">
					<img src="/wp-content/uploads/photos/photo-1481437156560-3205f6a55735.jpg" alt="<?php esc_attr_e( 'Zincir mağaza iç mekan görüntüsü', 'sazara' ); ?>" loading="lazy" decoding="async">
					<div class="bento__caption">
						<span class="bento__tag"><?php esc_html_e( 'Perakende', 'sazara' ); ?></span>
						<h3 class="bento__title"><?php esc_html_e( 'Zincir Mağaza', 'sazara' ); ?></h3>
					</div>
				</li>
				<li class="bento__tile reveal">
					<img src="/wp-content/uploads/photos/photo-1486325212027-8081e485255e.jpg" alt="<?php esc_attr_e( 'AVM ortak alan ve plaza iç mimari', 'sazara' ); ?>" loading="lazy" decoding="async">
					<div class="bento__caption">
						<span class="bento__tag"><?php esc_html_e( 'Kurumsal', 'sazara' ); ?></span>
						<h3 class="bento__title"><?php esc_html_e( 'AVM &amp; Plaza', 'sazara' ); ?></h3>
					</div>
				</li>
				<li class="bento__tile reveal">
					<img src="/wp-content/uploads/photos/photo-1604147495798-57beb5d6af73.jpg" alt="<?php esc_attr_e( 'Tek nokta butik dükkan iç görüntüsü', 'sazara' ); ?>" loading="lazy" decoding="async">
					<div class="bento__caption">
						<span class="bento__tag"><?php esc_html_e( 'Tek Nokta', 'sazara' ); ?></span>
						<h3 class="bento__title"><?php esc_html_e( 'Dükkan', 'sazara' ); ?></h3>
					</div>
				</li>
				<li class="bento__tile reveal">
					<img src="/wp-content/uploads/photos/photo-1530124566582-a618bc2615dc.jpg" alt="<?php esc_attr_e( 'Lojistik depo koridoru ve raf sistemi', 'sazara' ); ?>" loading="lazy" decoding="async">
					<div class="bento__caption">
						<span class="bento__tag"><?php esc_html_e( 'Lojistik', 'sazara' ); ?></span>
						<h3 class="bento__title"><?php esc_html_e( 'Depo &amp; Ardiye', 'sazara' ); ?></h3>
					</div>
				</li>
			</ul>
		</div>
	</section>

	<!-- ════════ FAQ ════════ -->
	<section class="section section--faq" id="sss">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '03 — Sıkça sorulanlar', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Cevabını çoğunlukla burada bulursun.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Kapsam, süre, bakım, lokasyon — proje öncesi en sık sorulan sorular.', 'sazara' ); ?></p>
			</header>

			<div class="faq">
				<details>
					<summary><?php esc_html_e( 'Hangi bölgelere hizmet veriyorsunuz?', 'sazara' ); ?></summary>
					<p class="faq__a"><?php esc_html_e( 'Merkezimiz İkitelli/Aykosan\'da — İstanbul ve çevre illerde saha hizmeti veriyoruz. Yazılım projelerinde lokasyon kısıtı yok.', 'sazara' ); ?></p>
				</details>
				<details>
					<summary><?php esc_html_e( 'Tek nokta mı, çoklu lokasyon mu?', 'sazara' ); ?></summary>
					<p class="faq__a"><?php esc_html_e( 'İkisi de — tek dükkanın hızlı kurulumundan, 40+ tesisi olan zincir mağaza ağına kadar. Çoklu lokasyon projelerinde merkezi yönetim ve standart kurulum prosedürü uygularız.', 'sazara' ); ?></p>
				</details>
				<details>
					<summary><?php esc_html_e( 'Bakım ve destek kapsamı nedir?', 'sazara' ); ?></summary>
					<p class="faq__a"><?php esc_html_e( '7/24 uzaktan izleme, periyodik saha bakımı, yazılım güncellemeleri ve olay yanıtı — bakım anlaşması projeyle birlikte yapılır.', 'sazara' ); ?></p>
				</details>
				<details>
					<summary><?php esc_html_e( 'Yazılım projelerini nasıl yapıyorsunuz?', 'sazara' ); ?></summary>
					<p class="faq__a"><?php esc_html_e( 'Web ve mobil uygulama, saha entegrasyonu, iç yönetim panelleri ve API entegrasyonları — TypeScript, Swift, Kotlin, Python stack ile.', 'sazara' ); ?></p>
				</details>
				<details>
					<summary><?php esc_html_e( 'Teklif süresi ne kadar?', 'sazara' ); ?></summary>
					<p class="faq__a"><?php esc_html_e( 'Standart kurulumlar için 24 saat, saha analizi gerektiren projelerde keşif sonrası 3-5 iş günü.', 'sazara' ); ?></p>
				</details>
			</div>
		</div>
	</section>

	<!-- ════════ CTA ════════ -->
	<section class="cta" id="iletisim">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Bir projeyi konuşalım.', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Aklındaki sorunu yaz, kahve eşliğinde mühendisliğe çevirelim.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="https://wa.me/905318503752" class="btn btn--primary">
						<span>WhatsApp</span>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
					<a href="mailto:info@sazara.com.tr" class="btn btn--ghost">info@sazara.com.tr</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
