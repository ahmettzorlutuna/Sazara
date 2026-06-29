<?php
/**
 * Ajax Systems tanıtım sayfası — /ajax/
 *
 * 9 bölüm: Hero → Neden Ajax → Ürün ekosistemi → Teknoloji →
 *          Çözümler → Ajax App → Sertifikalar → Sazara+Ajax → SSS → CTA
 *
 * İçerik: inc/ajax-data.php. Görseller: uploads/ajax/ (ajax.systems
 * resmi render'ları, yetkili bayi tanıtımı kapsamında).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$ajax = require SAZARA_DIR . '/inc/ajax-data.php';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact service-hero">
		<div class="hero__media">
			<img src="<?php echo esc_url( $ajax['hero']['image'] ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php echo esc_html( $ajax['hero']['eyebrow'] ); ?></p>
			<h1 class="hero__title hero__title--small"><?php echo esc_html( $ajax['hero']['title'] ); ?></h1>
			<p class="hero__lead"><?php echo esc_html( $ajax['hero']['lead'] ); ?></p>
			<div class="hero__cta-row">
				<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="btn btn--primary">
					<span><?php esc_html_e( 'Ajax kurulumu için teklif al', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
				<a href="<?php echo esc_url( home_url( '/ajax-alarm/' ) ); ?>" class="btn btn--accent">
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
					<span><?php esc_html_e( 'Ajax Bilgi Merkezi\'ne git', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
		</div>
	</section>

	<!-- ════════ HUB TEASER BAR ════════ -->
	<section class="ajax-hub-teaser">
		<div class="wrap ajax-hub-teaser__inner">
			<div class="ajax-hub-teaser__copy">
				<span class="ajax-hub-teaser__badge"><?php esc_html_e( 'Yeni', 'sazara' ); ?></span>
				<p class="ajax-hub-teaser__text">
					<strong><?php esc_html_e( 'Ajax Bilgi Merkezi açıldı.', 'sazara' ); ?></strong>
					<?php esc_html_e( 'Ürün kılavuzları, kurulum senaryoları, karşılaştırmalar ve sık sorulanlar — saha tecrübemizden notlar.', 'sazara' ); ?>
				</p>
			</div>
			<a href="<?php echo esc_url( home_url( '/ajax-alarm/' ) ); ?>" class="ajax-hub-teaser__link">
				<span><?php esc_html_e( 'Bilgi Merkezi\'ne git', 'sazara' ); ?></span>
				<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
			</a>
		</div>
	</section>

	<!-- ════════ 01 — NEDEN AJAX ════════ -->
	<?php if ( ! empty( $ajax['why'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '01 — Neden Ajax', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Pahalı olduğu için değil, çalıştığı için.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Ajax\'ı sektör lideri yapan, donanımdan çok mühendislik felsefesi: yanlış alarmı bitirmek, sistemi kendine izletmek, donanımı yazılımla yaşatmak.', 'sazara' ); ?></p>
			</header>

			<div class="case-story case-story--6">
				<?php foreach ( $ajax['why'] as $w ) : ?>
					<article class="case-story__block reveal">
						<span class="case-story__label"><?php echo esc_html( $w['title'] ); ?></span>
						<p class="case-story__text"><?php echo esc_html( $w['body'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 02 — ÜRÜN EKOSİSTEMİ ════════ -->
	<?php if ( ! empty( $ajax['products'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Ürün ekosistemi', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Tek tek cihaz değil, konuşan bir sistem.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Hub sistemin beyni; dedektörler, tuş takımı, siren ve kamera aynı dilde konuşur. Hepsi tek uygulamadan yönetilir.', 'sazara' ); ?></p>
			</header>

			<ul class="case-grid case-grid--3col ajax-products" role="list">
				<?php foreach ( $ajax['products'] as $p ) : ?>
					<li class="case-card reveal">
						<div class="case-card__media">
							<span class="case-card__sector"><?php echo esc_html( $p['tag'] ); ?></span>
							<?php if ( ! empty( $p['image'] ) ) : ?>
								<img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>" loading="lazy">
							<?php endif; ?>
						</div>
						<div class="case-card__body">
							<h3 class="case-card__title"><?php echo esc_html( $p['name'] ); ?></h3>
							<p class="case-card__tagline"><?php echo esc_html( $p['desc'] ); ?></p>
							<?php if ( ! empty( $p['specs'] ) ) : ?>
								<ul class="ajax-spec-tags" role="list">
									<?php foreach ( $p['specs'] as $spec ) : ?>
										<li><?php echo esc_html( $spec ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 03 — TEKNOLOJİ ════════ -->
	<?php if ( ! empty( $ajax['technologies'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '03 — Teknoloji', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Görünmeyen kısım, asıl değer.', 'sazara' ); ?></h2>
			</header>

			<ol class="case-timeline reveal" role="list">
				<?php foreach ( $ajax['technologies'] as $i => $tech ) : ?>
					<li class="case-timeline__step">
						<span class="case-timeline__phase"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<div class="case-timeline__body">
							<h3 class="case-timeline__title"><?php echo esc_html( $tech['name'] ); ?></h3>
							<p class="case-timeline__desc"><?php echo esc_html( $tech['body'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 04 — ÇÖZÜMLER ════════ -->
	<?php if ( ! empty( $ajax['solutions'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '04 — Nerede kullanılır', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Daireden fabrika perimeter\'ına.', 'sazara' ); ?></h2>
			</header>

			<ul class="ajax-solutions reveal" role="list">
				<?php foreach ( $ajax['solutions'] as $s ) : ?>
					<li class="ajax-solution">
						<h3 class="ajax-solution__title"><?php echo esc_html( $s['title'] ); ?></h3>
						<p class="ajax-solution__body"><?php echo esc_html( $s['body'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 05 — AJAX APP ════════ -->
	<?php if ( ! empty( $ajax['app'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<div class="ajax-app reveal">
				<div class="ajax-app__media">
					<?php if ( ! empty( $ajax['app']['image'] ) ) : ?>
						<img src="<?php echo esc_url( $ajax['app']['image'] ); ?>" alt="<?php esc_attr_e( 'Ajax Security App arayüzü', 'sazara' ); ?>" loading="lazy">
					<?php endif; ?>
				</div>
				<div class="ajax-app__body">
					<span class="section__num"><?php esc_html_e( '05 — Ajax App', 'sazara' ); ?></span>
					<h2 class="section__title"><?php echo esc_html( $ajax['app']['title'] ); ?></h2>
					<p class="section__lead"><?php echo esc_html( $ajax['app']['lead'] ); ?></p>
					<?php if ( ! empty( $ajax['app']['points'] ) ) : ?>
						<ul class="case-outcomes" role="list">
							<?php foreach ( $ajax['app']['points'] as $pt ) : ?>
								<li class="case-outcome">
									<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
									<span><?php echo esc_html( $pt ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 06 — SERTİFİKALAR ════════ -->
	<?php if ( ! empty( $ajax['certifications'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '06 — Sertifikalar', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Belgeli güvenlik, belgeli kurulum.', 'sazara' ); ?></h2>
			</header>

			<ul class="ajax-certs reveal" role="list">
				<?php foreach ( $ajax['certifications'] as $cert ) : ?>
					<li class="ajax-cert">
						<span class="ajax-cert__label"><?php echo esc_html( $cert['label'] ); ?></span>
						<span class="ajax-cert__note"><?php echo esc_html( $cert['note'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 07 — SAZARA + AJAX ════════ -->
	<?php if ( ! empty( $ajax['sazara'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '07 — Sazara + Ajax', 'sazara' ); ?></span>
				<h2 class="section__title"><?php echo esc_html( $ajax['sazara']['title'] ); ?></h2>
				<p class="section__lead"><?php echo esc_html( $ajax['sazara']['lead'] ); ?></p>
			</header>

			<div class="case-story">
				<?php foreach ( $ajax['sazara']['points'] as $pt ) : ?>
					<article class="case-story__block reveal">
						<span class="case-story__label"><?php echo esc_html( $pt['title'] ); ?></span>
						<p class="case-story__text"><?php echo esc_html( $pt['body'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 08 — SSS ════════ -->
	<?php if ( ! empty( $ajax['faq'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '08 — Sıkça sorulanlar', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Ajax\'a geçmeden önce.', 'sazara' ); ?></h2>
			</header>

			<div class="faq">
				<?php foreach ( $ajax['faq'] as $i => $item ) : ?>
					<details<?php echo 0 === $i ? ' open' : ''; ?>>
						<summary><?php echo esc_html( $item['q'] ); ?></summary>
						<p class="faq__a"><?php echo esc_html( $item['a'] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ 09 — BİLGİ MERKEZİ ════════ -->
	<?php
	$ajax_topics = get_terms(
		[
			'taxonomy'   => 'ajax_topic',
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		]
	);
	if ( ! is_wp_error( $ajax_topics ) && ! empty( $ajax_topics ) ) :
		?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '09 — Bilgi Merkezi', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Ürünün ötesinde: kılavuzlar, senaryolar, kıyaslar.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Saha tecrübemizden çıkardığımız notları konularına göre topluyoruz. Ajax\'ı tanımak, doğru kurmak ve sistemi yaşatmak için referans kaynak.', 'sazara' ); ?></p>
			</header>

			<ul class="ajax-hub-topics reveal" role="list">
				<?php foreach ( $ajax_topics as $topic ) : ?>
					<li class="ajax-hub-topic">
						<a href="<?php echo esc_url( get_term_link( $topic ) ); ?>" class="ajax-hub-topic__link">
							<span class="ajax-hub-topic__name"><?php echo esc_html( $topic->name ); ?></span>
							<?php if ( (int) $topic->count > 0 ) : ?>
								<span class="ajax-hub-topic__count">
									<?php
									printf(
										/* translators: %d: post count */
										esc_html( _n( '%d içerik', '%d içerik', (int) $topic->count, 'sazara' ) ),
										(int) $topic->count
									);
									?>
								</span>
							<?php else : ?>
								<span class="ajax-hub-topic__count ajax-hub-topic__count--soon"><?php esc_html_e( 'yakında', 'sazara' ); ?></span>
							<?php endif; ?>
							<span class="ajax-hub-topic__arrow" aria-hidden="true">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="ajax-hub-cta reveal">
				<a href="<?php echo esc_url( home_url( '/ajax-alarm/' ) ); ?>" class="btn btn--primary">
					<span><?php esc_html_e( 'Bilgi Merkezi\'ne git', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Ajax kurulumunu konuşalım.', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Saha keşfiyle başlıyoruz — mekânı görüp doğru sensör yerleşimini birlikte planlarız. İlk görüşme ücretsiz.', 'sazara' ); ?></p>
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
