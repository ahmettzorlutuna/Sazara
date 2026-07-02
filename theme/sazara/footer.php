<?php
/**
 * The footer — closing markup + footer columns + legal.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="footer">
	<?php if ( sazara_shop_can_render( 'footer_lead' ) ) : ?>
		<?php $shop_copy = sazara_shop_copy(); ?>
		<div class="footer__shop-banner">
			<div class="wrap footer__shop-banner__inner">
				<div class="footer__shop-banner__copy">
					<span class="footer__shop-banner__eyebrow"><?php echo esc_html( $shop_copy['footer_heading'] ); ?></span>
					<p class="footer__shop-banner__lead"><?php echo esc_html( $shop_copy['footer_lead'] ); ?></p>
				</div>
				<a href="<?php echo esc_url( sazara_shop_url() ); ?>"
				   class="footer__shop-banner__cta"
				   rel="noopener"
				   target="_blank">
					<span><?php echo esc_html( $shop_copy['footer_cta'] ); ?></span>
					<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
		</div>
	<?php endif; ?>
	<div class="wrap">
		<div class="footer__top">

			<div class="footer__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__brand-logo" aria-label="<?php esc_attr_e( 'Sazara — Anasayfa', 'sazara' ); ?>">
					<span class="footer__brand-mark" aria-hidden="true">
						<?php echo sazara_inline_svg( 'assets/brand/mark.svg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</span>
					<span class="footer__brand-wordmark" aria-hidden="true">
						<?php echo sazara_inline_svg( 'assets/brand/wordmark.svg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</span>
				</a>
				<p class="footer__brand-tagline"><?php esc_html_e( 'Donanım, ağ ve yazılımı tek mühendisliğe çeviren teknoloji şirketi.', 'sazara' ); ?></p>
				<p class="footer__brand-loc"><?php esc_html_e( 'Aykosan Sanayi Sitesi · İkitelli, İstanbul', 'sazara' ); ?></p>
			</div>

			<div class="footer__col">
				<h4><?php esc_html_e( 'Hizmetler', 'sazara' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/hizmetler/kamera-sistemleri/' ) ); ?>"><?php esc_html_e( 'Kamera sistemleri', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/hizmetler/network-it-altyapi/' ) ); ?>"><?php esc_html_e( 'Network &amp; IT', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/hizmetler/ajax-kablosuz-alarm/' ) ); ?>"><?php esc_html_e( 'Ajax alarm', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/hizmetler/yazilim-gelistirme/' ) ); ?>"><?php esc_html_e( 'Yazılım', 'sazara' ); ?></a></li>
				</ul>
			</div>

			<div class="footer__col">
				<h4><?php esc_html_e( 'Bilgi', 'sazara' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/ajax/' ) ); ?>"><?php esc_html_e( 'Ajax Systems', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/ajax-alarm/' ) ); ?>"><?php esc_html_e( 'Ajax Bilgi Merkezi', 'sazara' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/referanslar/' ) ); ?>"><?php esc_html_e( 'Referanslar', 'sazara' ); ?></a></li>
					<?php if ( sazara_shop_can_render( 'nav_cta' ) ) : ?>
						<?php $shop_copy = sazara_shop_copy(); ?>
						<li><a href="<?php echo esc_url( sazara_shop_url() ); ?>" rel="noopener" target="_blank"><?php echo esc_html( $shop_copy['nav_cta'] ); ?></a></li>
					<?php endif; ?>
				</ul>
			</div>

			<div class="footer__col">
				<h4><?php esc_html_e( 'Şirket', 'sazara' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/hakkimizda/' ) ); ?>"><?php esc_html_e( 'Hakkımızda', 'sazara' ); ?></a></li>
				</ul>
			</div>

			<div class="footer__col">
				<h4><?php esc_html_e( 'İletişim', 'sazara' ); ?></h4>
				<ul>
					<li><a href="mailto:hello@sazara.com.tr">hello@sazara.com.tr</a></li>
					<li><a href="https://wa.me/905555555555">WhatsApp</a></li>
					<li><a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>"><?php esc_html_e( 'İletişim formu', 'sazara' ); ?></a></li>
				</ul>
			</div>

		</div>

		<div class="footer__bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Sazara Teknoloji</span>
			<span>
				<a href="<?php echo esc_url( home_url( '/kvkk/' ) ); ?>"><?php esc_html_e( 'KVKK', 'sazara' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/cerez-politikasi/' ) ); ?>"><?php esc_html_e( 'Çerez', 'sazara' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/kullanim-sartlari/' ) ); ?>"><?php esc_html_e( 'Kullanım', 'sazara' ); ?></a>
			</span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
