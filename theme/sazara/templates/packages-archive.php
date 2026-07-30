<?php
/**
 * Paketler arşivi (/paketler/).
 *
 * Sayfa akışı: Hero → Paket kartı grid → Karşılaştırma tablosu → CTA.
 *
 * Veri kaynağı: inc/packages-data.php (sazara_load_packages)
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

$packages = function_exists( 'sazara_load_packages' ) ? sazara_load_packages() : [];

$hero_image = '/wp-content/uploads/photos/photo-1581092918056-0c4c3acd3789.jpg';

get_header();
?>

<main id="main-content" class="main">

	<!-- ════════ HERO ════════ -->
	<section class="hero hero--compact">
		<div class="hero__media">
			<img src="<?php echo esc_url( $hero_image ); ?>" alt="" loading="eager" fetchpriority="high">
		</div>
		<div class="wrap hero__content hero__content--compact">
			<p class="hero__eyebrow"><?php esc_html_e( 'Ajax Paketleri · Şeffaf fiyat', 'sazara' ); ?></p>
			<h1 class="hero__title hero__title--small"><?php esc_html_e( 'Mekanınıza uygun Ajax paketini seçin.', 'sazara' ); ?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Ev, işyeri ve yüksek risk mekanları için hazırladığımız 3 seviyeli paket + özel proje seçeneği. Cihaz, kurulum ve kullanıcı eğitimi dahil.', 'sazara' ); ?></p>
		</div>
	</section>

	<!-- ════════ PAKET KARTLARI ════════ -->
	<?php if ( ! empty( $packages ) ) : ?>
	<section class="section">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '01 — Paketler', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Kime ne uygun?', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Her paket, tipik senaryolara uygun cihaz kombinasyonu ve kurulum kapsamıyla hazırlandı. Sistemi ilerde büyütmek her zaman mümkündür.', 'sazara' ); ?></p>
			</header>

			<ul class="package-grid" role="list">
				<?php foreach ( $packages as $slug => $package ) : ?>
					<?php
					$card_classes = [ 'package-card', 'reveal' ];
					if ( ! empty( $package['is_featured'] ) ) {
						$card_classes[] = 'package-card--featured';
					}
					if ( ! empty( $package['is_custom'] ) ) {
						$card_classes[] = 'package-card--custom';
					}
					$card_url = home_url( '/paketler/' . $slug . '/' );
					?>
					<li class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>">
						<?php if ( ! empty( $package['is_featured'] ) ) : ?>
							<span class="package-card__badge"><?php esc_html_e( 'En popüler', 'sazara' ); ?></span>
						<?php endif; ?>

						<div class="package-card__head">
							<?php if ( ! empty( $package['subtitle'] ) ) : ?>
								<span class="package-card__eyebrow"><?php echo esc_html( $package['subtitle'] ); ?></span>
							<?php endif; ?>
							<h3 class="package-card__title">
								<a href="<?php echo esc_url( $card_url ); ?>"><?php echo esc_html( $package['title'] ); ?></a>
							</h3>
							<?php if ( ! empty( $package['tagline'] ) ) : ?>
								<p class="package-card__tagline"><?php echo esc_html( $package['tagline'] ); ?></p>
							<?php endif; ?>
						</div>

						<div class="package-card__price">
							<?php if ( ! empty( $package['is_custom'] ) ) : ?>
								<span class="package-card__price-value package-card__price-value--custom">
									<?php echo esc_html( $package['price'] ?? 'Teklif bazında' ); ?>
								</span>
							<?php elseif ( isset( $package['price_usd'] ) && function_exists( 'sazara_format_usd' ) ) : ?>
								<span class="package-card__price-value">
									<?php echo esc_html( sazara_format_usd( (float) $package['price_usd'] ) ); ?>
								</span>
								<span class="package-card__price-suffix"><?php esc_html_e( 'KDV dahil', 'sazara' ); ?></span>
							<?php else : ?>
								<span class="package-card__price-value"><?php echo esc_html( $package['price'] ?? '' ); ?></span>
								<?php if ( ! empty( $package['price_prefix'] ) ) : ?>
									<span class="package-card__price-suffix"><?php echo esc_html( $package['price_prefix'] ); ?></span>
								<?php endif; ?>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $package['duration'] ) ) : ?>
							<p class="package-card__meta">
								<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
								<?php
								printf(
									/* translators: %s: kurulum süresi */
									esc_html__( 'Kurulum: %s', 'sazara' ),
									esc_html( $package['duration'] )
								);
								?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $package['devices'] ) && empty( $package['is_custom'] ) ) : ?>
							<ul class="package-card__devices" role="list">
								<?php foreach ( array_slice( $package['devices'], 0, 4 ) as $device ) : ?>
									<li>
										<svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
										<?php echo esc_html( $device['label'] ); ?>
									</li>
								<?php endforeach; ?>
								<?php if ( count( $package['devices'] ) > 4 ) : ?>
									<li class="package-card__devices-more">
										<?php
										printf(
											/* translators: %d: kalan cihaz sayısı */
											esc_html__( '+ %d cihaz daha', 'sazara' ),
											count( $package['devices'] ) - 4
										);
										?>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

						<a href="<?php echo esc_url( $card_url ); ?>" class="package-card__cta">
							<span><?php esc_html_e( 'Detayları gör', 'sazara' ); ?></span>
							<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ KARŞILAŞTIRMA TABLOSU ════════ -->
	<?php if ( ! empty( $packages ) ) : ?>
	<section class="section section--canvas">
		<div class="wrap">
			<header class="section__head reveal">
				<span class="section__num"><?php esc_html_e( '02 — Karşılaştırma', 'sazara' ); ?></span>
				<h2 class="section__title"><?php esc_html_e( 'Paketler yan yana.', 'sazara' ); ?></h2>
				<p class="section__lead"><?php esc_html_e( 'Hangi paket ne sunuyor, tek bakışta.', 'sazara' ); ?></p>
			</header>

			<div class="package-comparison reveal">
				<table>
					<thead>
						<tr>
							<th scope="col"><?php esc_html_e( 'Özellik', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<th scope="col"><?php echo esc_html( $package['title'] ); ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row"><?php esc_html_e( 'Hedef kullanım', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<td><?php echo esc_html( $package['subtitle'] ?? '—' ); ?></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Fiyat (KDV dahil)', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<td>
									<?php
									if ( isset( $package['price_usd'] ) && function_exists( 'sazara_format_usd' ) ) {
										echo esc_html( sazara_format_usd( (float) $package['price_usd'] ) );
									} elseif ( ! empty( $package['price'] ) ) {
										echo esc_html( $package['price'] );
									} else {
										echo '—';
									}
									?>
								</td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Kurulum süresi', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<td><?php echo esc_html( $package['duration'] ?? '—' ); ?></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Toplam cihaz sayısı', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<td>
									<?php
									if ( ! empty( $package['is_custom'] ) ) {
										esc_html_e( 'Özel', 'sazara' );
									} elseif ( ! empty( $package['devices'] ) ) {
										echo (int) count( $package['devices'] );
									} else {
										echo '—';
									}
									?>
								</td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Ücretsiz saha keşfi', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<td class="package-comparison__yes">✓</td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Sertifikalı kurulum belgesi', 'sazara' ); ?></th>
							<?php foreach ( $packages as $slug => $package ) : ?>
								<td class="package-comparison__yes">✓</td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Dış mekan siren dahil', 'sazara' ); ?></th>
							<td class="package-comparison__no">—</td>
							<td class="package-comparison__yes">✓</td>
							<td class="package-comparison__yes">✓</td>
							<td class="package-comparison__yes">✓</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( '4G yedek iletişim', 'sazara' ); ?></th>
							<td class="package-comparison__no">—</td>
							<td class="package-comparison__yes">✓</td>
							<td class="package-comparison__yes">✓</td>
							<td class="package-comparison__yes">✓</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'MotionCam fotoğraflı doğrulama', 'sazara' ); ?></th>
							<td class="package-comparison__no">—</td>
							<td class="package-comparison__no">—</td>
							<td class="package-comparison__yes">✓</td>
							<td class="package-comparison__yes">✓</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'İzleme merkezi entegrasyonu hazırlığı', 'sazara' ); ?></th>
							<td class="package-comparison__no">—</td>
							<td class="package-comparison__no">—</td>
							<td class="package-comparison__yes">✓</td>
							<td class="package-comparison__yes">✓</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Uzaktan destek süresi', 'sazara' ); ?></th>
							<td>—</td>
							<td><?php esc_html_e( '3 ay', 'sazara' ); ?></td>
							<td><?php esc_html_e( '1 yıl', 'sazara' ); ?></td>
							<td><?php esc_html_e( 'Özel', 'sazara' ); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ════════ CTA ════════ -->
	<section class="cta">
		<div class="wrap">
			<div class="cta__inner reveal">
				<h2 class="cta__title"><?php esc_html_e( 'Emin değil misiniz? Önce konuşalım.', 'sazara' ); ?></h2>
				<p class="cta__lead"><?php esc_html_e( 'Saha keşfi ile mekanınıza uygun paketi birlikte netleştiririz. İstanbul içi keşif ücretsiz.', 'sazara' ); ?></p>
				<div class="cta__row">
					<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="btn btn--primary">
						<span><?php esc_html_e( 'Teklif al', 'sazara' ); ?></span>
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
					<a href="<?php echo esc_url( home_url( '/ajax-alarm/ajax-alarm-sss/' ) ); ?>" class="btn btn--ghost">
						<span><?php esc_html_e( 'Sık sorulanlar', 'sazara' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
