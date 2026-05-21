<?php
/**
 * Tek hizmet detay sayfası — slug bazlı içerik.
 *
 * Tek template, 4 hizmeti de render eder. İçerik inc/services-data.php'den.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$slug     = get_post_field( 'post_name', get_post() );
$services = require SAZARA_DIR . '/inc/services-data.php';
$svc      = $services[ $slug ] ?? null;

// Slug bilinmiyorsa arşive yönlendir.
if ( ! $svc ) {
	wp_safe_redirect( home_url( '/hizmetler/' ) );
	exit;
}

// Diğer hizmetler (related — bu hizmet hariç).
$related = array_filter(
	$services,
	static fn( $key ) => $key !== $slug,
	ARRAY_FILTER_USE_KEY
);

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact service-hero">
		<div class="hero__media">
			<?php if ( ! empty( $svc['hero_image'] ) ) : ?>
				<img src="<?php echo esc_url( $svc['hero_image'] ); ?>" alt="" loading="eager" fetchpriority="high">
			<?php endif; ?>
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php
				printf(
					/* translators: 1: num (01), 2: tag (CCTV · 4K) */
					esc_html__( '%1$s · %2$s', 'sazara' ),
					esc_html( $svc['num'] ),
					esc_html( $svc['tag'] )
				);
			?></p>
			<h1 class="hero__title hero__title--small"><?php echo esc_html( $svc['title'] ); ?></h1>
			<p class="hero__lead"><?php echo esc_html( $svc['tagline'] ); ?></p>
		</div>
	</section>

	<!-- ════════ INTRO ════════ -->
	<section class="section">
		<div class="wrap">
			<div class="story reveal">
				<header class="story__head">
					<span class="section__num"><?php esc_html_e( '01 — Yaklaşım', 'sazara' ); ?></span>
					<h2 class="story__title"><?php echo esc_html( $svc['lead'] ); ?></h2>
				</header>

				<div class="story__body">
					<?php foreach ( $svc['intro_paragraphs'] as $p ) : ?>
						<p><?php echo esc_html( $p ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ════════ SPECS ════════ -->
	<?php if ( ! empty( $svc['specs'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Teknik kapsam', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Standart yapımız.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Aşağıdaki kapsam başlangıç noktası. Her proje keşfi sonrası bu liste senin tesisine göre özelleştirilir.', 'sazara' ); ?></p>
			</header>

			<dl class="spec-table reveal">
				<?php foreach ( $svc['specs'] as $spec ) : ?>
					<div class="spec-table__row">
						<dt class="spec-table__label"><?php echo esc_html( $spec['label'] ); ?></dt>
						<dd class="spec-table__value">
							<span class="spec-table__primary"><?php echo esc_html( $spec['value'] ); ?></span>
							<?php if ( ! empty( $spec['hint'] ) ) : ?>
								<span class="spec-table__hint"><?php echo esc_html( $spec['hint'] ); ?></span>
							<?php endif; ?>
						</dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ SÜREÇ ════════ -->
	<?php if ( ! empty( $svc['process'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '03 — Süreç', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Brief\'ten devreye almaya, sonra bakıma.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Her aşamada müşteri ne olduğunu görür. Sürpriz fatura, sessiz değişiklik yok — kapsam değişirse önce konuşulur.', 'sazara' ); ?></p>
			</header>

			<ol class="process-steps reveal" role="list">
				<?php foreach ( $svc['process'] as $step ) : ?>
					<li class="process-step">
						<span class="process-step__num"><?php echo esc_html( $step['num'] ); ?></span>
						<div class="process-step__body">
							<h3 class="process-step__title"><?php echo esc_html( $step['title'] ); ?></h3>
							<p class="process-step__desc"><?php echo esc_html( $step['body'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ KULLANIM ALANLARI ════════ -->
	<?php if ( ! empty( $svc['sectors'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '04 — Kullanım alanları', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Hangi sahada işe yarıyor?', 'sazara' ); ?></h2>
			</header>

			<ul class="sectors-list reveal" role="list">
				<?php foreach ( $svc['sectors'] as $i => $sector ) : ?>
					<li class="sectors-list__item">
						<span class="sectors-list__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="sectors-list__text"><?php echo esc_html( $sector ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ FAQ ════════ -->
	<?php if ( ! empty( $svc['faq'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '05 — Sıkça sorulanlar', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Önce sorulan sorular.', 'sazara' ); ?></h2>
			</header>

			<div class="faq">
				<?php foreach ( $svc['faq'] as $i => $item ) : ?>
					<details<?php echo 0 === $i ? ' open' : ''; ?>>
						<summary><?php echo esc_html( $item['q'] ); ?></summary>
						<p class="faq__a"><?php echo esc_html( $item['a'] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ DİĞER HİZMETLER ════════ -->
	<?php if ( ! empty( $related ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '06 — Diğer disiplinler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Bu hizmet tek başına nadiren işe yarar.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Çoğu projemiz birden fazla disiplinin entegrasyonu. Diğerlerine de göz at.', 'sazara' ); ?></p>
			</header>

			<ul class="services" role="list">
				<?php foreach ( $related as $rel_slug => $rel ) : ?>
					<li class="service-card reveal">
						<a href="<?php echo esc_url( home_url( '/hizmetler/' . $rel_slug . '/' ) ); ?>" class="service-card__media">
							<span class="service-card__tag"><?php echo esc_html( $rel['tag'] ); ?></span>
							<?php if ( ! empty( $rel['hero_image'] ) ) : ?>
								<img src="<?php echo esc_url( $rel['hero_image'] ); ?>" alt="" loading="lazy">
							<?php endif; ?>
						</a>
						<div class="service-card__body">
							<span class="service-card__num"><?php echo esc_html( $rel['num'] . ' / ' . wp_strip_all_tags( $rel['tagline'] ) ); ?></span>
							<h3 class="service-card__title"><?php echo esc_html( $rel['title'] ); ?></h3>
							<a href="<?php echo esc_url( home_url( '/hizmetler/' . $rel_slug . '/' ) ); ?>" class="service-card__cta"><?php esc_html_e( 'İncele', 'sazara' ); ?></a>
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
				<h2 class="cta__title"><?php
					printf(
						/* translators: %s: tagline */
						esc_html__( '%s — birlikte konuşalım.', 'sazara' ),
						esc_html( $svc['tagline'] )
					);
				?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Saha keşfi ile başlıyoruz. İlk görüşme her zaman ücretsiz.', 'sazara' ); ?></p>
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
