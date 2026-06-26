<?php
/**
 * Ajax içerik hub'ı — Custom Post Type + Taxonomy.
 *
 * Public URLs:
 *   /ajax-alarm/                          → archive
 *   /ajax-alarm/<post-slug>/              → single
 *   /ajax-alarm/konu/<topic-slug>/        → taxonomy archive
 *
 * Why CPT not regular Post: Ajax içerik hub'ı kurumsal blog'dan ayrı yaşar,
 * kendi taxonomy'si ve kendi şablonları olur. WP yerleşik post karışmaz.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register CPT.
 */
add_action(
	'init',
	static function (): void {
		register_post_type(
			'ajax_content',
			[
				'labels'              => [
					'name'               => __( 'Ajax İçerikleri', 'sazara' ),
					'singular_name'      => __( 'Ajax İçeriği', 'sazara' ),
					'menu_name'          => __( 'Ajax Hub', 'sazara' ),
					'add_new'            => __( 'Yeni içerik', 'sazara' ),
					'add_new_item'       => __( 'Yeni Ajax içeriği ekle', 'sazara' ),
					'edit_item'          => __( 'İçeriği düzenle', 'sazara' ),
					'new_item'           => __( 'Yeni içerik', 'sazara' ),
					'view_item'          => __( 'İçeriği görüntüle', 'sazara' ),
					'search_items'       => __( 'İçeriklerde ara', 'sazara' ),
					'not_found'          => __( 'İçerik bulunamadı.', 'sazara' ),
					'not_found_in_trash' => __( 'Çöp kutusunda içerik yok.', 'sazara' ),
					'all_items'          => __( 'Tüm içerikler', 'sazara' ),
				],
				'public'              => true,
				'show_in_rest'        => true,
				'has_archive'         => 'ajax-alarm',
				'rewrite'             => [
					'slug'       => 'ajax-alarm',
					'with_front' => false,
				],
				'menu_position'       => 25,
				'menu_icon'           => 'dashicons-shield-alt',
				'supports'            => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions' ],
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'exclude_from_search' => false,
			]
		);

		register_taxonomy(
			'ajax_topic',
			[ 'ajax_content' ],
			[
				'labels'            => [
					'name'              => __( 'Ajax Konuları', 'sazara' ),
					'singular_name'     => __( 'Ajax Konusu', 'sazara' ),
					'search_items'      => __( 'Konularda ara', 'sazara' ),
					'all_items'         => __( 'Tüm konular', 'sazara' ),
					'edit_item'         => __( 'Konuyu düzenle', 'sazara' ),
					'update_item'       => __( 'Konuyu güncelle', 'sazara' ),
					'add_new_item'      => __( 'Yeni konu ekle', 'sazara' ),
					'new_item_name'     => __( 'Yeni konu adı', 'sazara' ),
					'menu_name'         => __( 'Konular', 'sazara' ),
				],
				'hierarchical'      => true,
				'public'            => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => [
					'slug'       => 'ajax-alarm/konu',
					'with_front' => false,
				],
			]
		);
	}
);

/**
 * Seed default topics on first init.
 * Idempotent — uses option flag, only inserts missing terms.
 */
add_action(
	'init',
	static function (): void {
		$flag = get_option( 'sazara_ajax_topics_seeded' );
		if ( '1' === $flag ) {
			return;
		}

		if ( ! taxonomy_exists( 'ajax_topic' ) ) {
			return;
		}

		$defaults = [
			'urun-kilavuzu'    => 'Ürün Kılavuzu',
			'kurulum'          => 'Kurulum',
			'senaryolar'       => 'Senaryolar',
			'karsilastirmalar' => 'Karşılaştırmalar',
			'sss'              => 'SSS',
		];

		foreach ( $defaults as $slug => $name ) {
			if ( term_exists( $slug, 'ajax_topic' ) ) {
				continue;
			}
			wp_insert_term( $name, 'ajax_topic', [ 'slug' => $slug ] );
		}

		update_option( 'sazara_ajax_topics_seeded', '1' );
		flush_rewrite_rules( false );
	},
	20
);
