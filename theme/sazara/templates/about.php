<?php
/**
 * Hakkımızda — Modern Cinematic White.
 *
 * İçerik tamamen bu dosyada. Metin değişikliği için PHP'yi düzenle.
 *
 * Galeri: $gallery_images array'ine medya URL'leri yapıştır.
 * URL almak için: WP admin → Medya → görsele tıkla → "Dosya URL'si" kopyala.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Galeri görselleri — kullanıcı tarafından sonra eklenecek.
 *
 * Boş bırakırsan placeholder grid görünür. Foto yükledikçe URL'i bu array'e
 * ekle. Sıralı görünür. WebP veya JPEG, 1200×900 (4:3) ya da 1600×1000
 * (16:10) önerilir.
 */
$gallery_images = [
];

/**
 * Hero görseli — Customizer'dan veya placeholder.
 */
$hero_id  = get_theme_mod( 'sazara_about_hero' );
$hero_url = $hero_id
	? wp_get_attachment_image_url( $hero_id, 'sazara-hero' )
	: '/wp-content/uploads/photos/photo-1497366811353-6870744d04b2.jpg';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO (compact) ════════ -->
	<section class="hero hero--compact">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_url ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>

		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php esc_html_e( 'Hakkımızda · 12 yıllık saha', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--small"><?php
				/* translators: %s = vurgulu kısım */
				printf(
					wp_kses_post( __( 'Mühendislikten daha fazlası: <em>%s</em>', 'sazara' ) ),
					esc_html__( 'gerçek sahada gerçek sistemler.', 'sazara' )
				);
			?></h1>
			<p class="hero__lead"><?php esc_html_e( 'İstanbul İkitelli/Aykosan\'da, 2014\'ten bu yana donanım, ağ ve yazılımı tek mühendislikte buluşturuyoruz. Her proje, sahada test edilmiş bir karardır.', 'sazara' ); ?></p>
		</div>
	</section>

	<!-- ════════ HİKAYE (geçmiş) ════════ -->
	<section class="section">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '01 — Hikaye', 'sazara' ); ?></span>
					<h2 class="story__title"><?php esc_html_e( 'Aykosan\'dan başlayan saha disiplini.', 'sazara' ); ?></h2>
				</header>

				<div class="story__body">
					<p><?php esc_html_e( '2014\'te küçük bir CCTV kurulum ekibi olarak başladık. İlk yıllarda Aykosan ve çevre sanayi bölgelerindeki üretim tesislerine kamera sistemleri kurarken bir gerçek netleşti: müşterinin asıl ihtiyacı yalnızca kayıt değil, kararı destekleyen bir sistemdi. Her kurulumdan sonra "şu da çalışsa keşke" sorusu, yaptığımız işin tek mühendislik altında genişlemesini hızlandırdı.', 'sazara' ); ?></p>

					<p><?php esc_html_e( 'Yıllar içinde ağ altyapısı, kablosuz alarm ve ihtiyaca özel yazılım da hizmet katalogumuza eklendi. Bugün dört disiplini de aynı projede konuşturan tek bir mühendislik ekibi olarak çalışıyoruz. Saha kurulumundan donanım seçimine, kablolamadan yazılım entegrasyonuna kadar, her adımda aynı sorumluluk.', 'sazara' ); ?></p>

					<p><?php esc_html_e( 'Saha tecrübesi şunu öğretti: Bir CCTV sisteminin değeri kameranın megapikseliyle değil; ağın güvenirliği, saklama stratejisi, AI destekli olay tespiti ve günlük operasyon raporlarıyla ölçülür. Bu yüzden çözümlerimiz her zaman disiplinler arasında hareket eder — biri eksik kalan bir sistem, geri kalanını da zayıflatır.', 'sazara' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ════════ STATS ════════ -->
	<section class="section section--canvas">
		<div class="wrap">
			<dl class="stats reveal">
				<div class="stats__item">
					<dt class="stats__num">12<span>+</span></dt>
					<dd class="stats__label"><?php esc_html_e( 'Yıl saha tecrübesi', 'sazara' ); ?></dd>
				</div>
				<div class="stats__item">
					<dt class="stats__num">40<span>+</span></dt>
					<dd class="stats__label"><?php esc_html_e( 'Aktif tesis &amp; şube', 'sazara' ); ?></dd>
				</div>
				<div class="stats__item">
					<dt class="stats__num">4</dt>
					<dd class="stats__label"><?php esc_html_e( 'Mühendislik dikeyi', 'sazara' ); ?></dd>
				</div>
				<div class="stats__item">
					<dt class="stats__num">2014</dt>
					<dd class="stats__label"><?php esc_html_e( 'Kuruluş, İstanbul', 'sazara' ); ?></dd>
				</div>
			</dl>
		</div>
	</section>

	<!-- ════════ DEĞERLER ════════ -->
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Nasıl çalışıyoruz', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Söz vermekten önce yapacağımızın disiplini.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Pazarlama söylemi değil, her projede gerçekten uyguladığımız çalışma şekli.', 'sazara' ); ?></p>
			</header>

			<ul class="values" role="list">
				<li class="value-card reveal">
					<span class="value-card__num">01</span>
					<h3 class="value-card__title"><?php esc_html_e( 'Tek mühendislik, dört disiplin.', 'sazara' ); ?></h3>
					<p class="value-card__desc"><?php esc_html_e( 'Kamera, ağ, alarm ve yazılım tek tedarikçinin sorumluluğunda. Müşteri, kurulum sonrası "kim ne yapacak?" sorusuyla 4 farklı firma arasında koşturmaz.', 'sazara' ); ?></p>
				</li>

				<li class="value-card reveal">
					<span class="value-card__num">02</span>
					<h3 class="value-card__title"><?php esc_html_e( 'Sahada test edilmiş çözüm.', 'sazara' ); ?></h3>
					<p class="value-card__desc"><?php esc_html_e( 'Sunum slaytında kalan değil, işleyen sistem. Devreye almadan önce bizzat kuruyor, kontrol ediyor; sonra paylaşıyoruz. Müşteriye "deneme aşamasında" sistem sunmuyoruz.', 'sazara' ); ?></p>
				</li>

				<li class="value-card reveal">
					<span class="value-card__num">03</span>
					<h3 class="value-card__title"><?php esc_html_e( 'Şeffaf kapsam ve bütçe.', 'sazara' ); ?></h3>
					<p class="value-card__desc"><?php esc_html_e( 'Her teklif, kapsam — takvim — kalemleri net olan tek sayfalık dokümanla başlar. Süpriz fatura, "ek kalem" çıkarmak yok. Değişiklik gerekirse önce konuşulur.', 'sazara' ); ?></p>
				</li>

				<li class="value-card reveal">
					<span class="value-card__num">04</span>
					<h3 class="value-card__title"><?php esc_html_e( 'Sürdürülebilir destek.', 'sazara' ); ?></h3>
					<p class="value-card__desc"><?php esc_html_e( 'Devreye alma günü işin sonu değil, başlangıcıdır. Bakım anlaşmasıyla periyodik kontrol, yazılım güncelleme, olay anında geri dönüş — sistemin ömrü boyunca yanındayız.', 'sazara' ); ?></p>
				</li>
			</ul>
		</div>
	</section>

	<!-- ════════ MANIFESTO (pull quote) ════════ -->
	<section class="section">
		<div class="wrap">
			<blockquote class="manifesto reveal">
				<p><?php esc_html_e( 'Donanım, ağ ve yazılımı ayrı ayrı tedarikçilerden almak — geçen yüzyılın yaklaşımı. Bugün ihtiyaç, dört disiplini aynı sahada konuşturan tek bir mühendislik.', 'sazara' ); ?></p>
				<cite>— <?php esc_html_e( 'Sazara · Yaklaşım', 'sazara' ); ?></cite>
			</blockquote>
		</div>
	</section>

	<!-- ════════ EKİP VİZYONU (soyut) ════════ -->
	<section class="section section--canvas">
		<div class="wrap">
			<div class="team-vision reveal">
				<header class="team-vision__head">
					<span class="section__num"><?php esc_html_e( '03 — Ekip', 'sazara' ); ?></span>
					<h2 class="team-vision__title"><?php esc_html_e( 'Mühendislik ve saha tecrübesini tek çatıda buluşturan ekip.', 'sazara' ); ?></h2>
				</header>

				<div class="team-vision__body">
					<p><?php esc_html_e( 'CCTV kurulumundan ağ tasarımına, kablosuz alarmdan yazılım geliştirmeye — her projede yıllarca aynı disiplinde çalışmış bir ekip omuz omuza. Saha mühendisleri keşfi yapar, ağ ekibi tasarımı yapar, yazılım ekibi entegre eder, devreye alma birlikte. Tek müşteri için dört dikey, ama dört dikeyin de aynı sorumluluk anlayışıyla.', 'sazara' ); ?></p>
					<p><?php esc_html_e( 'Yıllar içinde 40+ farklı tesise dokunduk: fabrika üretim hattından AVM güvenliğine, çok şubeli zincir mağazadan tek nokta bir dükkana kadar. Her proje kendi mühendislik kararını gerektirdi; kopyala-yapıştır kurulum yapmıyoruz.', 'sazara' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ════════ GALERİ (sen sonradan ekleyeceksin) ════════ -->
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '04 — Saha', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Sahanın içinden, ekibimizle birlikte.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Kurulum, devreye alma, bakım — projelerden anlar.', 'sazara' ); ?></p>
			</header>

			<?php if ( ! empty( $gallery_images ) ) : ?>
				<ul class="gallery" role="list">
					<?php foreach ( $gallery_images as $i => $img ) : ?>
						<li class="gallery__item gallery__item--<?php echo esc_attr( $i % 4 ); ?> reveal">
							<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ?? '' ); ?>" loading="lazy" decoding="async">
							<?php if ( ! empty( $img['caption'] ) ) : ?>
								<figcaption class="gallery__caption"><?php echo esc_html( $img['caption'] ); ?></figcaption>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<div class="gallery-empty reveal">
					<p class="gallery-empty__text"><?php esc_html_e( 'Saha fotoğrafları yakında eklenecek.', 'sazara' ); ?></p>
					<p class="gallery-empty__hint"><?php esc_html_e( 'Editör notu: templates/about.php içindeki $gallery_images dizisine medya URL\'leri yapıştır.', 'sazara' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Bir projeyi konuşalım.', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Aklındaki sorunu yaz, kahve eşliğinde mühendisliğe çevirelim.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="https://wa.me/905555555555" class="btn btn--primary">
						<span>WhatsApp</span>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
					<a href="mailto:hello@sazara.com.tr" class="btn btn--ghost">hello@sazara.com.tr</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
