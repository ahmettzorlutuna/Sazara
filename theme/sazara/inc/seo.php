<?php
/**
 * Light SEO — meta description + Rank Math JSON-LD augmentations.
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set viewport + theme-color + meta description + OG tags.
 */
add_action(
    'wp_head',
    static function () {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">' . "\n";
        echo '<meta name="theme-color" content="#0d0d0e">' . "\n";

        // Meta description.
        $desc = '';
        if ( is_front_page() || is_home() ) {
            $desc = 'Sazara Teknoloji — İstanbul İkitelli Aykosan merkezli güvenlik kamerası (CCTV), network altyapısı, Ajax kablosuz alarm ve B2B
  yazılım çözümleri.';
        } elseif ( is_singular() ) {
            $desc = wp_strip_all_tags( get_the_excerpt() );
            if ( empty( $desc ) ) {
                $desc = wp_trim_words(
                    wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ) ),
                    28,
                    '...'
                );
            }
        } else {
            $desc = get_bloginfo( 'description' );
        }

        $skip_desc = false;
        if ( class_exists( 'RankMath' ) && is_singular() && ! ( is_front_page() || is_home() ) ) {
            $rm_desc   = get_post_meta( get_the_ID(), 'rank_math_description', true );
            $skip_desc = ! empty( $rm_desc );
        }

        if ( ! empty( $desc ) && ! $skip_desc ) {
            printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
        }

        if ( class_exists( 'RankMath' ) || defined( 'WPSEO_VERSION' ) ) {
            return;
        }

        $title = wp_get_document_title();
        $desc  = is_singular() ? wp_strip_all_tags( get_the_excerpt() ) : get_bloginfo( 'description' );

        printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
        if ( ! empty( $desc ) ) {
            printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
        }
        printf( '<meta property="og:type" content="%s">' . "\n", is_singular() ? 'article' : 'website' );
        printf( '<meta property="og:url" content="%s">' . "\n", esc_url( home_url( $_SERVER['REQUEST_URI'] ?? '/' ) ) );

        if ( is_singular() && has_post_thumbnail() ) {
            $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sazara-hero' );
            if ( $img ) {
                printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img[0] ) );
            }
        }
    },
    3
);

/**
 * Rank Math JSON-LD enrichment — sameAs, founder, areaServed, knowsAbout.
 */
add_filter(
    'rank_math/json_ld',
    static function ( $data, $jsonld ) {
        if ( ! isset( $data['organization'] ) ) {
            return $data;
        }

        $org = &$data['organization'];

        $org['sameAs'] = array(
            'https://www.linkedin.com/company/sazara-teknoloji/',
        );

        $org['founder'] = array(
            '@type' => 'Person',
            'name'  => 'Ahmet Zorlutuna',
            'sameAs' => array(
                'https://www.linkedin.com/in/ahmetzorlutuna/',
            ),
        );

        $org['foundingDate'] = '2026-05-01';

        $org['areaServed'] = array(
            array( '@type' => 'AdministrativeArea', 'name' => 'İstanbul Avrupa' ),
            array( '@type' => 'AdministrativeArea', 'name' => 'İstanbul Anadolu' ),
            array( '@type' => 'AdministrativeArea', 'name' => 'Tekirdağ' ),
            array( '@type' => 'AdministrativeArea', 'name' => 'Çorlu' ),
            array( '@type' => 'AdministrativeArea', 'name' => 'Kocaeli' ),
        );

        $org['knowsAbout'] = array(
            'Güvenlik Kamerası Sistemleri',
            'CCTV',
            'Network Altyapısı',
            'Yapısal Kablolama',
            'Ajax Kablosuz Alarm',
            'Hırsız Alarmı',
            'Yangın Alarmı',
            'Geçiş Kontrol Sistemleri',
            'Wi-Fi Altyapısı',
            'Sunucu Kurulumu',
            'Yazılım Geliştirme',
            'Web Çözümleri',
            'Teknik Servis',
            'Veri Yedekleme',
        );

        return $data;
    },
    99,
    2
);
