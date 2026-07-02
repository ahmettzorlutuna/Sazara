<?php
/**
 * İletişim — Modern Cinematic White.
 *
 * Hero + form/info 2-col + Google Maps + CTA.
 *
 * GOOGLE MAPS DEĞİŞTİRME:
 * Aşağıdaki $map_query string'ini Google Maps'te kendi adresini arayıp
 * "Paylaş → Haritayı Yerleştir" iframe URL'sinden kopyaladığın src ile
 * değiştir, ya da basitçe arama sorgusunu (Aykosan...) düzenle.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Google Maps embed URL.
 *
 * Default: Aykosan Sanayi Sitesi sorgusu. Kullanıcı kendi spesifik adresinin
 * iframe URL'ini Google Maps'ten alıp buraya yapıştırabilir.
 */
$map_embed_url = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.819915577578!2d28.79716227612518!3d41.072928915441366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa557419270ed%3A0x11164ac1b69c0cce!2sSazara%20Teknoloji!5e0!3m2!1str!2str!4v1783024162362!5m2!1str!2str';

/**
 * İletişim kanalları.
 */
$channels = [
	[
		'label' => __( 'E-posta', 'sazara' ),
		'value' => 'info@sazara.com.tr',
		'href'  => 'mailto:info@sazara.com.tr',
	],
	[
		'label' => __( 'WhatsApp', 'sazara' ),
		'value' => '+90 531 850 37 52',
		'href'  => 'https://wa.me/905555555555',
	],
	[
		'label' => __( 'Telefon', 'sazara' ),
		'value' => '+90 212 671 98 51',
		'href'  => 'tel:+902120000000',
	],
	[
		'label' => __( 'Adres', 'sazara' ),
		'value' => 'Aykosan Sanayi Sitesi, İkitelli · Başakşehir, İstanbul',
		'href'  => 'https://maps.google.com/?q=Aykosan+Sanayi+Sitesi,+Ba%C5%9Fak%C5%9Fehir,+%C4%B0stanbul',
	],
	[
		'label' => __( 'Çalışma saatleri', 'sazara' ),
		'value' => 'Pzt–Cum 08:30–18:00 · Cmt 08:30–13:00',
		'href'  => '',
	],
];

/**
 * Form gönderim durumu (URL parametresinden).
 */
$status = sanitize_text_field( wp_unslash( $_GET['gonderim'] ?? '' ) );

$status_messages = [
	'basarili'  => [ 'type' => 'success', 'text' => __( 'Mesajın bize ulaştı. En geç 24 saat içinde dönüş yapacağız.', 'sazara' ) ],
	'eksik'     => [ 'type' => 'error',   'text' => __( 'Lütfen ad, e-posta ve mesaj alanlarını doldur.', 'sazara' ) ],
	'guvenlik'  => [ 'type' => 'error',   'text' => __( 'Güvenlik doğrulaması başarısız. Sayfayı yenileyip tekrar dene.', 'sazara' ) ],
	'hata'      => [ 'type' => 'error',   'text' => __( 'Mesaj gönderilemedi. Direkt e-posta veya WhatsApp\'tan ulaşabilirsin.', 'sazara' ) ],
];

$hero_id  = get_theme_mod( 'sazara_contact_hero' );
$hero_url = $hero_id
	? wp_get_attachment_image_url( $hero_id, 'sazara-hero' )
	: '/wp-content/uploads/photos/photo-1519389950473-47ba0277781c.jpg';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO (compact) ════════ -->
	<section class="hero hero--compact">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_url ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>

		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php esc_html_e( 'İletişim · Aykosan, İstanbul', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--small"><?php
				printf(
					wp_kses_post( __( 'Bir projeyi <em>%s</em>', 'sazara' ) ),
					esc_html__( 'konuşalım.', 'sazara' )
				);
			?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Aklındaki sorunu, kapsamı veya sadece soruyu yaz — 24 saat içinde dönüş yapıyoruz. Kahve eşliğinde mühendisliğe çevirelim.', 'sazara' ); ?></p>
		</div>
	</section>

	<!-- ════════ İLETİŞİM (form + kanallar) ════════ -->
	<section class="section" id="form">
		<div class="wrap">

			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '01 — Yaz, biz arayalım', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Aklındaki ne ise — yaz, biz dönelim.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Form ya da WhatsApp — ikisi de doğru kanal. Ne kadar net yazarsan teklif o kadar isabetli olur.', 'sazara' ); ?></p>
			</header>

			<div class="contact-grid reveal">

				<!-- ─── Form ─── -->
				<form class="form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
					<input type="hidden" name="action" value="sazara_contact_send">
					<?php wp_nonce_field( 'sazara_contact', SAZARA_CONTACT_NONCE ); ?>

					<!-- Honeypot (hidden, anti-spam) -->
					<div class="form__honeypot" aria-hidden="true">
						<label for="contact-website">Website (bu alanı boş bırak)</label>
						<input type="text" id="contact-website" name="website" tabindex="-1" autocomplete="off">
					</div>

					<?php if ( $status && isset( $status_messages[ $status ] ) ) : ?>
						<div class="form__alert form__alert--<?php echo esc_attr( $status_messages[ $status ]['type'] ); ?>" role="status">
							<?php echo esc_html( $status_messages[ $status ]['text'] ); ?>
						</div>
					<?php endif; ?>

					<div class="form__row">
						<div class="form__field">
							<label class="form__label" for="contact-name"><?php esc_html_e( 'Adın', 'sazara' ); ?> *</label>
							<input class="form__input" type="text" id="contact-name" name="name" required autocomplete="name">
						</div>
						<div class="form__field">
							<label class="form__label" for="contact-email"><?php esc_html_e( 'E-posta', 'sazara' ); ?> *</label>
							<input class="form__input" type="email" id="contact-email" name="email" required autocomplete="email">
						</div>
					</div>

					<div class="form__row">
						<div class="form__field">
							<label class="form__label" for="contact-phone"><?php esc_html_e( 'Telefon', 'sazara' ); ?></label>
							<input class="form__input" type="tel" id="contact-phone" name="phone" autocomplete="tel">
						</div>
						<div class="form__field">
							<label class="form__label" for="contact-company"><?php esc_html_e( 'Şirket', 'sazara' ); ?></label>
							<input class="form__input" type="text" id="contact-company" name="company" autocomplete="organization">
						</div>
					</div>

					<div class="form__field">
						<label class="form__label" for="contact-service"><?php esc_html_e( 'İlgilendiğin hizmet', 'sazara' ); ?></label>
						<select class="form__input form__select" id="contact-service" name="service">
							<option value=""><?php esc_html_e( 'Seç ya da boş bırak', 'sazara' ); ?></option>
							<option value="cctv"><?php esc_html_e( 'Kamera Sistemleri (CCTV)', 'sazara' ); ?></option>
							<option value="network"><?php esc_html_e( 'Ağ &amp; IT Altyapı', 'sazara' ); ?></option>
							<option value="alarm"><?php esc_html_e( 'Ajax Kablosuz Alarm', 'sazara' ); ?></option>
							<option value="yazilim"><?php esc_html_e( 'Yazılım Geliştirme', 'sazara' ); ?></option>
							<option value="genel"><?php esc_html_e( 'Genel danışma', 'sazara' ); ?></option>
						</select>
					</div>

					<div class="form__field">
						<label class="form__label" for="contact-message"><?php esc_html_e( 'Mesajın', 'sazara' ); ?> *</label>
						<textarea class="form__input form__textarea" id="contact-message" name="message" rows="5" required placeholder="<?php esc_attr_e( 'Kapsam, lokasyon, takvim — aklındakiler.', 'sazara' ); ?>"></textarea>
					</div>

					<div class="form__submit-row">
						<button type="submit" class="btn btn--primary form__submit">
							<span><?php esc_html_e( 'Mesajı gönder', 'sazara' ); ?></span>
							<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
						</button>
						<small class="form__legal"><?php
							/* translators: %s: KVKK link text */
							printf(
								esc_html__( 'Gönderdiğinde %s kapsamında işlenmesini kabul edersin.', 'sazara' ),
								'<a href="' . esc_url( home_url( '/kvkk/' ) ) . '">' . esc_html__( 'KVKK aydınlatma metni', 'sazara' ) . '</a>'
							);
						?></small>
					</div>
				</form>

				<!-- ─── İletişim kanalları ─── -->
				<aside class="contact-info">
					<header class="contact-info__head">
						<span class="contact-info__eyebrow"><?php esc_html_e( 'Direkt kanallar', 'sazara' ); ?></span>
						<p class="contact-info__lead"><?php esc_html_e( 'Acil bir konu varsa WhatsApp en hızlısı. Detaylı brief için form ya da e-posta.', 'sazara' ); ?></p>
					</header>

					<dl class="contact-info__list">
						<?php foreach ( $channels as $ch ) : ?>
							<div class="contact-info__item">
								<dt class="contact-info__label"><?php echo esc_html( $ch['label'] ); ?></dt>
								<dd class="contact-info__value">
									<?php if ( ! empty( $ch['href'] ) ) : ?>
										<a href="<?php echo esc_url( $ch['href'] ); ?>"<?php echo str_starts_with( $ch['href'], 'http' ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $ch['value'] ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $ch['value'] ); ?>
									<?php endif; ?>
								</dd>
							</div>
						<?php endforeach; ?>
					</dl>
				</aside>

			</div>
		</div>
	</section>

	<!-- ════════ HARİTA ════════ -->
	<section class="map">
		<div class="wrap map__head">
			<span class="section__num"><?php esc_html_e( '02 — Konum', 'sazara' ); ?></span>
			<h2 class="section__title"><?php esc_html_e( 'Aykosan Sanayi Sitesi.', 'sazara' ); ?></h2>
			<p class="section__lead"><?php esc_html_e( 'Merkez ofisimiz Başakşehir İkitelli Aykosan\'da. İstanbul ve çevre illerde saha hizmeti.', 'sazara' ); ?></p>
		</div>

		<div class="map__embed reveal">
			<iframe
				src="<?php echo esc_url( $map_embed_url ); ?>"
				width="100%"
				height="100%"
				style="border:0;"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				title="<?php esc_attr_e( 'Sazara — Aykosan Sanayi Sitesi konumu', 'sazara' ); ?>"></iframe>
		</div>

		<div class="wrap map__foot">
			<a href="https://maps.google.com/?q=Aykosan+Sanayi+Sitesi,+Ba%C5%9Fak%C5%9Fehir,+%C4%B0stanbul" class="map__directions" target="_blank" rel="noopener">
				<span><?php esc_html_e( 'Yol tarifi al', 'sazara' ); ?></span>
				<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
			</a>
		</div>
	</section>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Hızlı bir soru mu?', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Form yerine WhatsApp\'tan tek mesaj at, 5 dakika içinde dönüyoruz.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="https://wa.me/905555555555" class="btn btn--primary">
						<span>WhatsApp ile yaz</span>
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
