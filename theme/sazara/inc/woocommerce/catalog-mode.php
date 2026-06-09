<?php
/**
 * WooCommerce vitrin (catalog) modu.
 * - Sepete ekle butonu kapalı
 * - Fiyatlar gizli (opsiyonel — şu an gizli değil ama gizlemek için filter aşağıda)
 * - Checkout, cart sayfaları erişilemez
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Disable add-to-cart functionality.
 */
add_action(
	'init',
	static function () {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
);

/**
 * Sepet ve checkout sayfalarını 404'e yönlendir.
 */
add_action(
	'template_redirect',
	static function () {
		if ( is_cart() || is_checkout() ) {
			wp_safe_redirect( home_url( '/iletisim/' ), 302 );
			exit;
		}
	}
);

/**
 * Cart fragments her sayfada yüklenmesin.
 */
add_action(
	'wp_enqueue_scripts',
	static function () {
		wp_dequeue_script( 'wc-cart-fragments' );
		wp_dequeue_script( 'wc-add-to-cart' );
	},
	100
);
