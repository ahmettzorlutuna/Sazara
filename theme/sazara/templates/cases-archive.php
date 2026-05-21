<?php
/**
 * Referanslar arşivi.
 *
 * Sayfa akışı (hikaye sırası):
 *   Hero → KPI Strip → Logo Marquee → Müşteri Sözleri → Case Grid →
 *   Sektörel Rehber → Yetkili Bayilikler → CTA
 *
 * Veri kaynakları:
 *   - inc/clients-data.php       : logo marquee
 *   - inc/testimonials-data.php  : müşteri sözleri wall
 *   - inc/cases-data.php         : case grid
 *   - inc/sectors-data.php       : sektörel bento
 *   - inc/partners-data.php      : yetkili bayilikler
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$clients      = require SAZARA_DIR . '/inc/clients-data.php';
$testimonials = require SAZARA_DIR . '/inc/testimonials-data.php';
$cases        = require SAZARA_DIR . '/inc/cases-data.php';
$sectors      = require SAZARA_DIR . '/inc/sectors-data.php';
$partners     = require SAZARA_DIR . '/inc/partners-data.php';

// Referanslar-spesifik KPI'lar (front-page'den ayrı, edit etmek için burada).
$kpis = [
	[ 'value' => '12',   'unit' => 'yıl',     'label' => 'Saha tecrübesi' ],
	[ 'value' => '120+', 'unit' => 'proje',   'label' => 'Tamamlanan iş' ],
	[ 'value' => '40+',  'unit' => 'firma',   'label' => 'İş ortağı' ],
	[ 'value' => '7',    'unit' => 'sektör',  'label' => 'Aktif çalıştığımız' ],
];

// Sektör kartlarından servis sayfalarına link için servis başlıkları lookup'ı.
$services_lookup = require SAZARA_DIR . '/inc/services-data.php';

/**
 * Hero arka plan görseli.
 *
 * Değiştirmek için: wp-content/uploads/ altına yükle ve URL'i buraya yapıştır,
 * ya da farklı Unsplash ID kullan. Karanlık gradient otomatik bindirilir;
 * üzerine yazılan beyaz metin okunaklı kalır.
 */
$hero_image = '/wp-content/uploads/photos/photo-1494522855154-9297ac14b55f.jpg';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_image ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php esc_html_e( 'Referanslar · İş listesi', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--small"><?php esc_html_e( '12 yıl, 120+ proje, tek söz.', 'sazara' ); ?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Lojistik depodan kuyumcuya, fabrika perimeter\'ından AVM kurumsal güvenliğine — birlikte çalıştığımız markalar ve teslim ettiğimiz işlerden seçmeler.', 'sazara' ); ?></p>
		</div>
	</section>

	<!-- ════════ A — KPI STRIP ════════ -->
	<section class="kpi-strip-section">
		<div class="wrap">
			<dl class="kpi-strip reveal">
				<?php foreach ( $kpis as $kpi ) : ?>
					<div class="kpi-strip__item">
						<dt class="kpi-strip__label"><?php echo esc_html( $kpi['label'] ); ?></dt>
						<dd class="kpi-strip__value">
							<span class="kpi-strip__num"><?php echo esc_html( $kpi['value'] ); ?></span>
							<span class="kpi-strip__unit"><?php echo esc_html( $kpi['unit'] ); ?></span>
						</dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
	</section>

	<!-- ════════ MARKA MARQUEE ════════ -->
	<?php if ( ! empty( $clients ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head section__head--center reveal">
				<span class="section__num"><?php esc_html_e( '01 — Çalıştığımız markalar', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Sahada güvendiğimiz marka portföyü.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Güvenlik kameradan ağ ekipmanına, alarm sistemlerinden aksesuara — yetkili bayilik veya satıcılık ilişkimiz olan markalar.', 'sazara' ); ?></p>
			</header>
		</div>

		<div class="logo-marquee reveal" role="region" aria-label="<?php esc_attr_e( 'Çalıştığımız markalar', 'sazara' ); ?>">
			<div class="logo-marquee__track">
				<?php for ( $pass = 0; $pass < 2; $pass++ ) : ?>
					<?php foreach ( $clients as $client ) : ?>
						<?php
						// Logo öncelik: logo_file (img) → svg_path (inline) → logo_url → text.
						$brand_img_url = '';
						if ( ! empty( $client['logo_file'] ) ) {
							$logo_path = WP_CONTENT_DIR . '/uploads/' . ltrim( $client['logo_file'], '/' );
							if ( file_exists( $logo_path ) ) {
								$brand_img_url = content_url( 'uploads/' . ltrim( $client['logo_file'], '/' ) );
							}
						}

						$brand_svg = '';
						if ( ! $brand_img_url && ! empty( $client['svg_path'] ) ) {
							$brand_svg = sazara_inline_svg( $client['svg_path'] );
						}
						?>
						<div class="logo-marquee__item"<?php echo 1 === $pass ? ' aria-hidden="true"' : ''; ?>
						     title="<?php echo esc_attr( $client['name'] ); ?>">
							<?php if ( $brand_img_url ) : ?>
								<img src="<?php echo esc_url( $brand_img_url ); ?>"
								     alt="<?php echo esc_attr( $client['name'] ); ?>"
								     loading="lazy">
							<?php elseif ( $brand_svg ) : ?>
								<?php echo $brand_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php elseif ( ! empty( $client['logo_url'] ) ) : ?>
								<img src="<?php echo esc_url( $client['logo_url'] ); ?>"
								     alt="<?php echo esc_attr( $client['name'] ); ?>"
								     loading="lazy">
							<?php else : ?>
								<span class="logo-marquee__text"><?php echo esc_html( $client['name'] ); ?></span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endfor; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ D — MÜŞTERİ SÖZLERİ WALL ════════ -->
	<?php if ( ! empty( $testimonials ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Müşteri sözleri', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Sözle değil, kayıtla.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Aşağıdaki yorumlar gerçek proje sahiplerine ait. İsteğe bağlı, sektör çeşitliliği gözetilerek seçildi.', 'sazara' ); ?></p>
			</header>

			<ul class="testimonials-wall" role="list">
				<?php foreach ( $testimonials as $t ) : ?>
					<li class="testimonial reveal">
						<svg class="testimonial__mark" viewBox="0 0 32 32" width="28" height="28" fill="currentColor" aria-hidden="true">
							<path d="M9.3 8c-3 0-5.3 2.3-5.3 5.3 0 3 2.3 5.3 5.3 5.3.5 0 1 0 1.4-.2-.5 1.5-1.8 2.7-3.3 3l1 2.6c4.2-1 7-4.7 7-9.1V13c0-3-2.3-5-5.1-5zm14 0c-3 0-5.3 2.3-5.3 5.3 0 3 2.3 5.3 5.3 5.3.5 0 1 0 1.4-.2-.5 1.5-1.8 2.7-3.3 3l1 2.6c4.2-1 7-4.7 7-9.1V13c0-3-2.3-5-5.1-5z"/>
						</svg>
						<blockquote class="testimonial__text"><?php echo esc_html( $t['text'] ); ?></blockquote>
						<footer class="testimonial__footer">
							<cite class="testimonial__attr"><?php echo esc_html( $t['attribution'] ); ?></cite>
							<span class="testimonial__sector"><?php echo esc_html( $t['sector'] ); ?></span>
						</footer>
						<?php if ( ! empty( $t['related_case'] ) && isset( $cases[ $t['related_case'] ] ) ) : ?>
							<a class="testimonial__link" href="<?php echo esc_url( home_url( '/referanslar/' . $t['related_case'] . '/' ) ); ?>">
								<?php esc_html_e( 'Bu projeyi incele', 'sazara' ); ?>
								<svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
							</a>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ CASE GRID ════════ -->
	<?php if ( ! empty( $cases ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '03 — Yapılan işler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Sahadan örnekler.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Her proje farklı: lokasyon, ölçek, sektör, risk profili. Aşağıda bazı işlerimizi durum–çözüm–sonuç olarak özetledik.', 'sazara' ); ?></p>
			</header>

			<ul class="case-grid case-grid--3col" role="list">
				<?php foreach ( $cases as $slug => $case ) : ?>
					<li class="case-card reveal">
						<a href="<?php echo esc_url( home_url( '/referanslar/' . $slug . '/' ) ); ?>"
						   class="case-card__media"
						   aria-label="<?php echo esc_attr( $case['title'] ); ?>">
							<span class="case-card__sector"><?php echo esc_html( $case['sector'] ); ?></span>
							<?php if ( ! empty( $case['hero_image'] ) ) : ?>
								<img src="<?php echo esc_url( $case['hero_image'] ); ?>" alt="" loading="lazy">
							<?php endif; ?>
						</a>
						<div class="case-card__body">
							<span class="case-card__meta">
								<?php echo esc_html( $case['location'] ); ?>
								<span aria-hidden="true">·</span>
								<?php echo esc_html( $case['year'] ); ?>
							</span>
							<h3 class="case-card__title">
								<a href="<?php echo esc_url( home_url( '/referanslar/' . $slug . '/' ) ); ?>"><?php echo esc_html( $case['title'] ); ?></a>
							</h3>
							<p class="case-card__tagline"><?php echo esc_html( $case['tagline'] ); ?></p>
							<div class="case-card__footer">
								<span class="case-card__scope"><?php echo esc_html( $case['scope'] ); ?></span>
								<span class="case-card__arrow" aria-hidden="true">
									<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
								</span>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ B — SEKTÖREL REHBER BENTO ════════ -->
	<?php if ( ! empty( $sectors ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '04 — Sektörel yaklaşım', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Hangi sektörde nasıl çalışırız?', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Her sektörün kendine özgü riskleri, mevzuatı ve operasyon ritmi vardır. Sektör bazlı yaklaşımımız aşağıda.', 'sazara' ); ?></p>
			</header>

			<ul class="sectors-bento" role="list">
				<?php foreach ( $sectors as $sector_slug => $sector ) : ?>
					<li class="sector-card reveal">
						<div class="sector-card__head">
							<span class="sector-card__icon"><?php
								echo $sector['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?></span>
							<span class="sector-card__count">
								<?php
								printf(
									/* translators: %d: project count */
									esc_html__( '%d+ proje', 'sazara' ),
									(int) $sector['count']
								);
								?>
							</span>
						</div>
						<h3 class="sector-card__title"><?php echo esc_html( $sector['name'] ); ?></h3>
						<p class="sector-card__problem">
							<span class="sector-card__label"><?php esc_html_e( 'Tipik problem', 'sazara' ); ?></span>
							<?php echo esc_html( $sector['typical_problem'] ); ?>
						</p>
						<p class="sector-card__solution">
							<span class="sector-card__label"><?php esc_html_e( 'Yaklaşımımız', 'sazara' ); ?></span>
							<?php echo esc_html( $sector['typical_solution'] ); ?>
						</p>
						<?php if ( ! empty( $sector['related_services'] ) ) : ?>
							<div class="sector-card__links">
								<?php foreach ( $sector['related_services'] as $svc_slug ) : ?>
									<?php $svc_title = $services_lookup[ $svc_slug ]['title'] ?? $svc_slug; ?>
									<a class="sector-card__link" href="<?php echo esc_url( home_url( '/hizmetler/' . $svc_slug . '/' ) ); ?>">
										<?php echo esc_html( $svc_title ); ?>
										<svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ C — YETKİLİ BAYİLİKLER ════════ -->
	<?php if ( ! empty( $partners ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '05 — Yetkili bayilikler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Üretici garantisi + sertifikalı kurulum.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Çalıştığımız markaların resmî partneriyiz. Donanım üreticiden geliyor, garanti üreticide kalıyor, sertifikalı kurulum bizden.', 'sazara' ); ?></p>
			</header>

			<ul class="partners-grid" role="list">
				<?php foreach ( $partners as $partner ) : ?>
					<?php
					// Logo öncelik: logo_file (img) → svg_path (inline) → logo_text (wordmark)
					$partner_logo_url = '';
					if ( ! empty( $partner['logo_file'] ) ) {
						$logo_path = WP_CONTENT_DIR . '/uploads/' . ltrim( $partner['logo_file'], '/' );
						if ( file_exists( $logo_path ) ) {
							$partner_logo_url = content_url( 'uploads/' . ltrim( $partner['logo_file'], '/' ) );
						}
					}

					$partner_svg = '';
					if ( ! $partner_logo_url && ! empty( $partner['svg_path'] ) ) {
						$partner_svg = sazara_inline_svg( $partner['svg_path'] );
					}
					?>
					<li class="partner-card reveal">
						<div class="partner-card__head">
							<span class="partner-card__logo">
								<?php if ( $partner_logo_url ) : ?>
									<img src="<?php echo esc_url( $partner_logo_url ); ?>"
									     alt="<?php echo esc_attr( $partner['name'] ); ?>"
									     loading="lazy">
								<?php elseif ( $partner_svg ) : ?>
									<?php
									// Tema yazarı tarafından üretilen güvenilir SVG.
									echo $partner_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									?>
								<?php else : ?>
									<span class="partner-card__wordmark"><?php echo esc_html( $partner['logo_text'] ); ?></span>
								<?php endif; ?>
							</span>
							<span class="partner-card__since">
								<?php
								printf(
									/* translators: %s: year */
									esc_html__( 'Sazara ile %s\'den beri', 'sazara' ),
									esc_html( $partner['since'] )
								);
								?>
							</span>
						</div>
						<span class="partner-card__status"><?php echo esc_html( $partner['status'] ); ?></span>
						<p class="partner-card__tagline"><?php echo esc_html( $partner['tagline'] ); ?></p>
						<p class="partner-card__scope"><?php echo esc_html( $partner['scope'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Bir sonraki proje seninkiyse?', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Saha keşfiyle başlıyoruz. İlk görüşme her zaman ücretsiz.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="btn btn--primary">
						<span><?php esc_html_e( 'Teklif al', 'sazara' ); ?></span>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
					<a href="https://wa.me/905555555555" class="btn btn--ghost">WhatsApp</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
