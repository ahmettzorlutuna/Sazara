<?php
/**
 * Tek referans (case) detay sayfası — slug bazlı içerik.
 *
 * Tek template, tüm case'leri render eder. İçerik inc/cases-data.php'den.
 *
 * Bölümler:
 *   01 — Hero
 *   02 — Öne çıkan metrikler (strip)
 *   03 — Proje künyesi (genişletilmiş tablo)
 *   04 — Durum (intro + pain points)
 *   05 — Yaklaşım (metodoloji)
 *   06 — Çözüm (detaylı paragraflar)
 *   07 — Kullanılan ekipman (tablo)
 *   08 — Süreç (timeline)
 *   09 — Sonuç (intro + outcomes)
 *   10 — Müşteri sözü
 *   11 — Kullanılan markalar
 *   12 — Galeri (varsa)
 *   13 — İlgili case'ler
 *   14 — CTA
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$slug  = get_post_field( 'post_name', get_post() );
$cases = require SAZARA_DIR . '/inc/cases-data.php';
$case  = $cases[ $slug ] ?? null;

if ( ! $case ) {
	wp_safe_redirect( home_url( '/referanslar/' ) );
	exit;
}

// İlgili case'ler (bu hariç, en fazla 3).
$related = array_filter(
	$cases,
	static fn( $k ) => $k !== $slug,
	ARRAY_FILTER_USE_KEY
);
$related = array_slice( $related, 0, 3, true );

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact service-hero">
		<div class="hero__media">
			<?php if ( ! empty( $case['hero_image'] ) ) : ?>
				<img src="<?php echo esc_url( $case['hero_image'] ); ?>" alt="" loading="eager" fetchpriority="high">
			<?php endif; ?>
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow">
				<?php echo esc_html( $case['sector'] ); ?>
				<span aria-hidden="true">·</span>
				<?php echo esc_html( $case['location'] ); ?>
				<span aria-hidden="true">·</span>
				<?php echo esc_html( $case['year'] ); ?>
			</p>
			<h1 class="hero__title hero__title--small"><?php echo esc_html( $case['title'] ); ?></h1>
			<p class="hero__lead"><?php echo esc_html( $case['tagline'] ); ?></p>
		</div>
	</section>

	<!-- ════════ METRİK STRIP ════════ -->
	<?php if ( ! empty( $case['metrics'] ) ) : ?>
	<section class="case-metrics-section">
		<div class="wrap">
			<dl class="case-metrics reveal">
				<?php foreach ( $case['metrics'] as $metric ) : ?>
					<div class="case-metric">
						<dt class="case-metric__label"><?php echo esc_html( $metric['label'] ); ?></dt>
						<dd class="case-metric__value">
							<span class="case-metric__num"><?php echo esc_html( $metric['value'] ); ?></span>
							<?php if ( ! empty( $metric['unit'] ) ) : ?>
								<span class="case-metric__unit"><?php echo esc_html( $metric['unit'] ); ?></span>
							<?php endif; ?>
						</dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ PROJE KÜNYESİ ════════ -->
	<section class="section">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '01 — Proje künyesi', 'sazara' ); ?></span>
					<h2 class="story__title"><?php esc_html_e( 'Kim, nerede, nasıl, ne kadar sürede.', 'sazara' ); ?></h2>
				</header>

				<dl class="spec-table">
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Müşteri', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['client'] ); ?></span></dd>
					</div>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Sektör', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['sector'] ); ?></span></dd>
					</div>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Lokasyon', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['location'] ); ?></span></dd>
					</div>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Süre', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['duration'] ); ?></span></dd>
					</div>
					<?php if ( ! empty( $case['team_size'] ) ) : ?>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Ekip', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['team_size'] ); ?></span></dd>
					</div>
					<?php endif; ?>
					<?php if ( ! empty( $case['completion'] ) ) : ?>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Devreye alma', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['completion'] ); ?></span></dd>
					</div>
					<?php endif; ?>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php esc_html_e( 'Kapsam', 'sazara' ); ?></dt>
						<dd class="spec-table__value"><span class="spec-table__primary"><?php echo esc_html( $case['scope'] ); ?></span></dd>
					</div>
				</dl>
			</div>
		</div>
	</section>

	<!-- ════════ DURUM ════════ -->
	<?php if ( ! empty( $case['durum_intro'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '02 — Durum', 'sazara' ); ?></span>
					<h2 class="story__title"><?php esc_html_e( 'Müşteri ne yaşıyordu?', 'sazara' ); ?></h2>
				</header>

				<div class="story__body">
					<p class="case-lead"><?php echo esc_html( $case['durum_intro'] ); ?></p>

					<?php if ( ! empty( $case['durum_pain_points'] ) ) : ?>
						<ul class="case-pain-points" role="list">
							<?php foreach ( $case['durum_pain_points'] as $i => $pp ) : ?>
								<li class="case-pain-point">
									<span class="case-pain-point__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
									<span class="case-pain-point__text"><?php echo esc_html( $pp ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ YAKLAŞIM ════════ -->
	<?php if ( ! empty( $case['yaklasim'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '03 — Yaklaşım', 'sazara' ); ?></span>
					<h2 class="story__title"><?php esc_html_e( 'Önce dinledik, sonra teklif yaptık.', 'sazara' ); ?></h2>
				</header>
				<div class="story__body">
					<p class="case-yaklasim"><?php echo esc_html( $case['yaklasim'] ); ?></p>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ ÇÖZÜM ════════ -->
	<?php if ( ! empty( $case['cozum_paragraphs'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '04 — Çözüm', 'sazara' ); ?></span>
					<h2 class="story__title"><?php esc_html_e( 'Sahada ne yaptık?', 'sazara' ); ?></h2>
				</header>

				<div class="story__body">
					<?php foreach ( $case['cozum_paragraphs'] as $p ) : ?>
						<p><?php echo esc_html( $p ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ EKİPMAN ════════ -->
	<?php if ( ! empty( $case['equipment'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '05 — Kullanılan ekipman', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Marka, model, miktar.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Yetkili bayilik anlaşmalarımız çerçevesinde, üreticiden garanti dahil teslim.', 'sazara' ); ?></p>
			</header>

			<dl class="spec-table spec-table--equipment reveal">
				<?php foreach ( $case['equipment'] as $eq ) : ?>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php echo esc_html( $eq['category'] ); ?></dt>
						<dd class="spec-table__value">
							<span class="spec-table__primary"><?php echo esc_html( $eq['items'] ); ?></span>
						</dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ SÜREÇ TIMELINE ════════ -->
	<?php if ( ! empty( $case['timeline'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '06 — Süreç', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Hafta hafta ne yapıldı.', 'sazara' ); ?></h2>
			</header>

			<ol class="case-timeline reveal" role="list">
				<?php foreach ( $case['timeline'] as $step ) : ?>
					<li class="case-timeline__step">
						<span class="case-timeline__phase"><?php echo esc_html( $step['phase'] ); ?></span>
						<div class="case-timeline__body">
							<h3 class="case-timeline__title"><?php echo esc_html( $step['title'] ); ?></h3>
							<p class="case-timeline__desc"><?php echo esc_html( $step['desc'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ SONUÇ ════════ -->
	<?php if ( ! empty( $case['sonuc_intro'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '07 — Sonuç', 'sazara' ); ?></span>
					<h2 class="story__title"><?php esc_html_e( 'Ne kazandılar?', 'sazara' ); ?></h2>
				</header>

				<div class="story__body">
					<p class="case-lead"><?php echo esc_html( $case['sonuc_intro'] ); ?></p>

					<?php if ( ! empty( $case['sonuc_outcomes'] ) ) : ?>
						<ul class="case-outcomes" role="list">
							<?php foreach ( $case['sonuc_outcomes'] as $o ) : ?>
								<li class="case-outcome">
									<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
									<span><?php echo esc_html( $o ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ MÜŞTERİ SÖZÜ ════════ -->
	<?php if ( ! empty( $case['quote']['text'] ) ) : ?>
	<section class="case-quote-section">
		<div class="wrap">
			<figure class="case-quote reveal">
				<svg class="case-quote__mark" viewBox="0 0 32 32" width="44" height="44" fill="currentColor" aria-hidden="true">
					<path d="M9.3 8c-3 0-5.3 2.3-5.3 5.3 0 3 2.3 5.3 5.3 5.3.5 0 1 0 1.4-.2-.5 1.5-1.8 2.7-3.3 3l1 2.6c4.2-1 7-4.7 7-9.1V13c0-3-2.3-5-5.1-5zm14 0c-3 0-5.3 2.3-5.3 5.3 0 3 2.3 5.3 5.3 5.3.5 0 1 0 1.4-.2-.5 1.5-1.8 2.7-3.3 3l1 2.6c4.2-1 7-4.7 7-9.1V13c0-3-2.3-5-5.1-5z"/>
				</svg>
				<blockquote class="case-quote__text"><?php echo esc_html( $case['quote']['text'] ); ?></blockquote>
				<?php if ( ! empty( $case['quote']['attribution'] ) ) : ?>
					<figcaption class="case-quote__attr"><?php echo esc_html( $case['quote']['attribution'] ); ?></figcaption>
				<?php endif; ?>
			</figure>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ KULLANILAN MARKALAR ════════ -->
	<?php if ( ! empty( $case['brands'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '08 — Bu projede çalıştığımız markalar', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Yetkili bayilik + üretici garantisi.', 'sazara' ); ?></h2>
			</header>
			<ul class="case-brands reveal" role="list">
				<?php foreach ( $case['brands'] as $brand ) : ?>
					<li class="case-brand"><?php echo esc_html( $brand ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ GALERİ ════════ -->
	<?php if ( ! empty( $case['gallery'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '09 — Sahadan', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Fotoğraflar.', 'sazara' ); ?></h2>
			</header>

			<div class="case-gallery reveal" data-lightbox="case-gallery">
				<?php foreach ( $case['gallery'] as $img ) : ?>
					<?php
					$src = $img['src'] ?? '';
					$alt = $img['alt'] ?? '';
					if ( ! $src ) {
						continue;
					}
					?>
					<button type="button" class="case-gallery__item"
					        data-src="<?php echo esc_url( $src ); ?>"
					        data-alt="<?php echo esc_attr( $alt ); ?>"
					        aria-label="<?php esc_attr_e( 'Görseli büyüt', 'sazara' ); ?>">
						<img src="<?php echo esc_url( $src ); ?>"
						     alt="<?php echo esc_attr( $alt ); ?>"
						     loading="lazy">
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ İLGİLİ İŞLER ════════ -->
	<?php if ( ! empty( $related ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '10 — Diğer işler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Benzer projeler.', 'sazara' ); ?></h2>
			</header>

			<ul class="case-grid case-grid--3col" role="list">
				<?php foreach ( $related as $rel_slug => $rel ) : ?>
					<li class="case-card reveal">
						<a href="<?php echo esc_url( home_url( '/referanslar/' . $rel_slug . '/' ) ); ?>"
						   class="case-card__media"
						   aria-label="<?php echo esc_attr( $rel['title'] ); ?>">
							<span class="case-card__sector"><?php echo esc_html( $rel['sector'] ); ?></span>
							<?php if ( ! empty( $rel['hero_image'] ) ) : ?>
								<img src="<?php echo esc_url( $rel['hero_image'] ); ?>" alt="" loading="lazy">
							<?php endif; ?>
						</a>
						<div class="case-card__body">
							<span class="case-card__meta">
								<?php echo esc_html( $rel['location'] ); ?>
								<span aria-hidden="true">·</span>
								<?php echo esc_html( $rel['year'] ); ?>
							</span>
							<h3 class="case-card__title">
								<a href="<?php echo esc_url( home_url( '/referanslar/' . $rel_slug . '/' ) ); ?>"><?php echo esc_html( $rel['title'] ); ?></a>
							</h3>
							<p class="case-card__tagline"><?php echo esc_html( $rel['tagline'] ); ?></p>
						</div>
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
				<h2 class="cta__title"><?php esc_html_e( 'Benzer bir ihtiyacın mı var?', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'İlk adım saha keşfi — ücretsiz ve bağlayıcı değil.', 'sazara' ); ?></p>
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
