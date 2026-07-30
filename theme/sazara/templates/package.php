<?php
/**
 * Tek paket detay sayfası (/paketler/<slug>/) — slug bazlı içerik.
 *
 * Tek template, tüm paketleri render eder. İçerik inc/packages-data.php'den.
 *
 * Bölümler:
 *   01 — Hero (paket adı + fiyat + tagline)
 *   02 — İçindeki cihazlar
 *   03 — Ne dahil / Ne dahil değil
 *   04 — Kimin için ideal
 *   05 — CTA (teklif al)
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$slug     = get_post_field( 'post_name', get_post() );
$packages = function_exists( 'sazara_load_packages' ) ? sazara_load_packages() : [];
$package  = $packages[ $slug ] ?? null;

if ( ! $package ) {
	wp_safe_redirect( home_url( '/paketler/' ) );
	exit;
}

$hero_image = ! empty( $package['hero_image'] ) ? $package['hero_image'] : '/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact package-hero">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_image ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow">
				<a href="<?php echo esc_url( home_url( '/paketler/' ) ); ?>" class="package-hero__crumb"><?php esc_html_e( 'Paketler', 'sazara' ); ?></a>
				<?php if ( ! empty( $package['subtitle'] ) ) : ?>
					<span aria-hidden="true"> · </span>
					<span><?php echo esc_html( $package['subtitle'] ); ?></span>
				<?php endif; ?>
			</p>
			<h1 class="hero__title hero__title--small"><?php echo esc_html( $package['title'] ); ?></h1>
			<?php if ( ! empty( $package['tagline'] ) ) : ?>
				<p class="hero__lead"><?php echo esc_html( $package['tagline'] ); ?></p>
			<?php endif; ?>

			<div class="package-hero__price">
				<?php if ( ! empty( $package['is_custom'] ) ) : ?>
					<span class="package-hero__price-value package-hero__price-value--custom">
						<?php echo esc_html( $package['price'] ?? 'Teklif bazında' ); ?>
					</span>
				<?php elseif ( isset( $package['price_usd'] ) && function_exists( 'sazara_format_usd' ) ) : ?>
					<?php
					$usd_incl        = (float) $package['price_usd'];
					$try_incl        = sazara_usd_to_try( $usd_incl );
					$usd_excl        = sazara_price_excluding_kdv( $usd_incl );
					?>
					<span class="package-hero__price-value"><?php echo esc_html( sazara_format_usd( $usd_incl ) ); ?></span>
					<span class="package-hero__price-suffix"><?php esc_html_e( 'KDV dahil · İstanbul içi kurulum, eğitim, sertifika dahil', 'sazara' ); ?></span>
					<span class="package-hero__price-try">
						<?php
						printf(
							/* translators: %s: TL karşılığı */
							esc_html__( '≈ %s (bugünkü kur)', 'sazara' ),
							esc_html( sazara_format_try( $try_incl ) )
						);
						?>
					</span>
					<span class="package-hero__price-corporate">
						<?php
						printf(
							/* translators: %s: KDV hariç fiyat */
							esc_html__( 'Kurumsal fatura: %s + KDV', 'sazara' ),
							esc_html( sazara_format_usd( $usd_excl ) )
						);
						?>
					</span>
				<?php else : ?>
					<span class="package-hero__price-value"><?php echo esc_html( $package['price'] ?? '' ); ?></span>
					<?php if ( ! empty( $package['price_prefix'] ) ) : ?>
						<span class="package-hero__price-suffix"><?php echo esc_html( $package['price_prefix'] ); ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<div class="hero__cta-row">
				<a href="<?php echo esc_url( home_url( '/iletisim/?paket=' . $slug ) ); ?>" class="btn btn--primary">
					<span><?php esc_html_e( 'Bu paket için teklif al', 'sazara' ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
		</div>
	</section>

	<!-- ════════ META STRIP ════════ -->
	<?php if ( ! empty( $package['duration'] ) || ! empty( $package['target'] ) ) : ?>
	<section class="case-metrics-section">
		<div class="wrap">
			<dl class="case-metrics reveal">
				<?php if ( ! empty( $package['duration'] ) ) : ?>
					<div class="case-metric">
						<dt class="case-metric__label"><?php esc_html_e( 'Kurulum süresi', 'sazara' ); ?></dt>
						<dd class="case-metric__value">
							<span class="case-metric__num" style="font-size: clamp(1.5rem, 1.2rem + 1vw, 2rem);"><?php echo esc_html( $package['duration'] ); ?></span>
						</dd>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $package['devices'] ) && empty( $package['is_custom'] ) ) : ?>
					<div class="case-metric">
						<dt class="case-metric__label"><?php esc_html_e( 'Toplam cihaz', 'sazara' ); ?></dt>
						<dd class="case-metric__value">
							<span class="case-metric__num"><?php echo (int) count( $package['devices'] ); ?></span>
							<span class="case-metric__unit"><?php esc_html_e( 'kalem', 'sazara' ); ?></span>
						</dd>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $package['target'] ) ) : ?>
					<div class="case-metric">
						<dt class="case-metric__label"><?php esc_html_e( 'Hedef kullanım', 'sazara' ); ?></dt>
						<dd class="case-metric__value">
							<span class="case-metric__num" style="font-size: clamp(1rem, 0.9rem + 0.5vw, 1.25rem); font-weight: 500;"><?php echo esc_html( $package['target'] ); ?></span>
						</dd>
					</div>
				<?php endif; ?>
			</dl>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ CİHAZLAR ════════ -->
	<?php
	if ( ! empty( $package['devices'] ) && empty( $package['is_custom'] ) ) :
		// Herhangi bir cihazda 'image' varsa büyük kart grid'i kullan;
		// yoksa mevcut kompakt liste görünümüne fallback.
		$has_images = false;
		foreach ( $package['devices'] as $d ) {
			if ( ! empty( $d['image'] ) ) {
				$has_images = true;
				break;
			}
		}
		$list_classes = $has_images ? 'package-devices package-devices--grid' : 'package-devices';
		?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '01 — İçindekiler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Pakete dahil cihazlar.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Sazara olarak sistemi yerine kuruyor, kalibre ediyor ve devreye alıyoruz. Cihazlar kutusundan çıkmış Ajax orijinal ürünlerdir; sertifika kurulum sonrası tarafımızca verilir.', 'sazara' ); ?></p>
			</header>

			<ul class="<?php echo esc_attr( $list_classes ); ?>" role="list">
				<?php foreach ( $package['devices'] as $device ) : ?>
					<?php if ( $has_images ) : ?>
						<li class="package-devices__card reveal">
							<div class="package-devices__image">
								<?php if ( ! empty( $device['image'] ) ) : ?>
									<img src="<?php echo esc_url( $device['image'] ); ?>"
									     alt="<?php echo esc_attr( $device['label'] ); ?>"
									     loading="lazy" decoding="async">
								<?php else : ?>
									<svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12l3 3 5-6"/></svg>
								<?php endif; ?>
							</div>
							<div class="package-devices__card-body">
								<h3 class="package-devices__card-label"><?php echo esc_html( $device['label'] ); ?></h3>
								<?php if ( ! empty( $device['note'] ) ) : ?>
									<p class="package-devices__card-note"><?php echo esc_html( $device['note'] ); ?></p>
								<?php endif; ?>
							</div>
						</li>
					<?php else : ?>
						<li class="package-devices__item reveal">
							<div class="package-devices__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12l4 4L19 7"/></svg>
							</div>
							<div class="package-devices__body">
								<span class="package-devices__label"><?php echo esc_html( $device['label'] ); ?></span>
								<?php if ( ! empty( $device['note'] ) ) : ?>
									<span class="package-devices__note"><?php echo esc_html( $device['note'] ); ?></span>
								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ DAHİL / DAHİL DEĞİL ════════ -->
	<?php if ( ! empty( $package['included'] ) || ! empty( $package['not_included'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Kapsam', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Ne dahil, ne değil.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Şeffaflık önemli. Paket fiyatı içine giren ve girmeyen kalemleri tek yerde topluyoruz.', 'sazara' ); ?></p>
			</header>

			<div class="package-scope reveal">
				<?php if ( ! empty( $package['included'] ) ) : ?>
					<div class="package-scope__col package-scope__col--included">
						<h3 class="package-scope__title">
							<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
							<?php esc_html_e( 'Fiyata dahil', 'sazara' ); ?>
						</h3>
						<ul>
							<?php foreach ( $package['included'] as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $package['not_included'] ) ) : ?>
					<div class="package-scope__col package-scope__col--excluded">
						<h3 class="package-scope__title">
							<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M6 6l12 12M6 18L18 6"/></svg>
							<?php esc_html_e( 'Fiyata dahil değil', 'sazara' ); ?>
						</h3>
						<ul>
							<?php foreach ( $package['not_included'] as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ SÜREKLİ HİZMETLER (SIM + AHM) ════════ -->
	<?php
	if ( function_exists( 'sazara_load_subscriptions' ) ) :
		$subscriptions = sazara_load_subscriptions();
		if ( ! empty( $subscriptions ) ) :
			?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '03 — Sürekli Hizmetler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Yıllık abonelikler — opsiyonel.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Ajax sistemi paket teslim sonrası tek başına tam işlevli çalışır. Aşağıdaki hizmetler profesyonel koruma seviyesini bir üst basamağa çıkarmak isteyenler için opsiyoneldir. Paket fiyatına dahil değildir; şeffaflık için burada net olarak sunuluyor.', 'sazara' ); ?></p>
			</header>

			<ul class="package-subscriptions" role="list">
				<?php foreach ( $subscriptions as $sub_slug => $sub ) : ?>
					<li class="package-subscription reveal">
						<div class="package-subscription__head">
							<?php if ( ! empty( $sub['icon'] ) ) : ?>
								<span class="package-subscription__icon" aria-hidden="true">
									<?php echo sazara_inline_svg( 'assets/icons/' . $sub['icon'] . '.svg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							<?php endif; ?>
							<h3 class="package-subscription__title"><?php echo esc_html( $sub['title'] ); ?></h3>
						</div>

						<div class="package-subscription__price">
							<span class="package-subscription__price-value">
								<?php echo esc_html( sazara_format_usd( (float) $sub['price_usd'] ) ); ?>
							</span>
							<span class="package-subscription__price-period">
								/ <?php echo esc_html( $sub['period'] ?? 'yıl' ); ?> · <?php esc_html_e( 'KDV dahil', 'sazara' ); ?>
							</span>
						</div>

						<?php if ( ! empty( $sub['description'] ) ) : ?>
							<p class="package-subscription__desc"><?php echo esc_html( $sub['description'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $sub['why_needed'] ) ) : ?>
							<p class="package-subscription__why">
								<strong><?php esc_html_e( 'Neden gerekli:', 'sazara' ); ?></strong>
								<?php echo esc_html( $sub['why_needed'] ); ?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $sub['audience'] ) ) : ?>
							<p class="package-subscription__audience"><?php echo esc_html( $sub['audience'] ); ?></p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
			<?php
		endif;
	endif;
	?>

	<!-- ════════ KİMİN İÇİN UYGUN? ════════ -->
	<?php if ( ! empty( $package['application_areas'] ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '04 — Kim için uygun?', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Bu paketin doğal uygulama alanları.', 'sazara' ); ?></h2>
			</header>

			<ul class="package-areas" role="list">
				<?php foreach ( $package['application_areas'] as $area ) : ?>
					<li class="package-areas__item reveal">
						<span class="package-areas__icon" aria-hidden="true">
							<?php echo sazara_inline_svg( 'assets/icons/' . ( $area['icon'] ?? 'home' ) . '.svg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
						<span class="package-areas__label"><?php echo esc_html( $area['label'] ?? '' ); ?></span>
						<?php if ( ! empty( $area['note'] ) ) : ?>
							<span class="package-areas__note"><?php echo esc_html( $area['note'] ); ?></span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php elseif ( ! empty( $package['ideal_for'] ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '04 — İdeal profil', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Kim için uygun?', 'sazara' ); ?></h2>
			</header>

			<ul class="package-ideal reveal" role="list">
				<?php foreach ( $package['ideal_for'] as $profile ) : ?>
					<li>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
						<?php echo esc_html( $profile ); ?>
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
				<h2 class="cta__title">
					<?php
					printf(
						/* translators: %s: paket adı */
						esc_html__( '%s için başlamaya hazır mısınız?', 'sazara' ),
						esc_html( $package['title'] )
					);
					?>
				</h2>
				<p class="cta__lead"><?php esc_html_e( 'Saha keşfiyle başlıyoruz. İstanbul içi ücretsiz, teklif net.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="<?php echo esc_url( home_url( '/iletisim/?paket=' . $slug ) ); ?>" class="btn btn--primary">
						<span><?php esc_html_e( 'Bu paket için teklif al', 'sazara' ); ?></span>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
					<a href="<?php echo esc_url( home_url( '/paketler/' ) ); ?>" class="btn btn--ghost"><?php esc_html_e( 'Diğer paketlere bak', 'sazara' ); ?></a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
