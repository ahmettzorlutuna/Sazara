<?php
/**
 * Hizmetler arşivi (/hizmetler/) — 4 hizmet detaylı kart.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$services = require SAZARA_DIR . '/inc/services-data.php';

$hero_id  = get_theme_mod( 'sazara_services_hero' );
$hero_url = $hero_id
	? wp_get_attachment_image_url( $hero_id, 'sazara-hero' )
	: '/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_url ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php esc_html_e( 'Hizmetler · Dört dikey, tek mühendislik', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--small"><?php
				printf(
					wp_kses_post( __( 'Donanım, ağ, alarm, yazılım — <em>%s</em>', 'sazara' ) ),
					esc_html__( 'aynı sahada konuşan tek bir mühendislik.', 'sazara' )
				);
			?></h1>
			<p class="hero__lead"><?php esc_html_e( '12 yıllık saha tecrübesi ile dört dikeyi tek elden veriyoruz. Her hizmetin detaylarına aşağıdaki kartlardan girebilir, kapsam ve süreç hakkında bilgi alabilirsin.', 'sazara' ); ?></p>
		</div>
	</section>

	<!-- ════════ HİZMET DETAYLARI (4 büyük kart) ════════ -->
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '01 — Dört dikey', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'İhtiyacın hangi disiplin?', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Genelde proje birden fazlasını kapsar. Karar vermenle ilgilenmiyoruz — sen ihtiyacı söyle, biz hangi disiplinlerin devreye girdiğini birlikte konuşalım.', 'sazara' ); ?></p>
			</header>

			<ul class="services" role="list">
				<?php foreach ( $services as $slug => $svc ) : ?>
					<li class="service-card reveal">
						<a href="<?php echo esc_url( home_url( '/hizmetler/' . $slug . '/' ) ); ?>" class="service-card__media">
							<span class="service-card__tag"><?php echo esc_html( $svc['tag'] ); ?></span>
							<?php if ( ! empty( $svc['hero_image'] ) ) : ?>
								<img src="<?php echo esc_url( $svc['hero_image'] ); ?>" alt="" loading="lazy" decoding="async">
							<?php endif; ?>
						</a>
						<div class="service-card__body">
							<span class="service-card__num"><?php echo esc_html( $svc['num'] . ' / ' . wp_strip_all_tags( $svc['tagline'] ) ); ?></span>
							<h3 class="service-card__title"><?php echo esc_html( $svc['title'] ); ?></h3>
							<p class="service-card__desc"><?php echo esc_html( wp_trim_words( $svc['lead'], 28 ) ); ?></p>
							<?php if ( ! empty( $svc['specs'] ) ) : ?>
								<ul class="service-card__specs">
									<?php foreach ( array_slice( $svc['specs'], 0, 4 ) as $spec ) : ?>
										<li><?php echo esc_html( $spec['label'] ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<a href="<?php echo esc_url( home_url( '/hizmetler/' . $slug . '/' ) ); ?>" class="service-card__cta"><?php esc_html_e( 'Detaya gir', 'sazara' ); ?></a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Hangisi sana lazım, beraber konuşalım.', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Tek bir disiplin de olabilir, dördü de — saha keşfinde netleşir.', 'sazara' ); ?></p>
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
