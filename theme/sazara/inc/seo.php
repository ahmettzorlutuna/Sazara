<?php
  /**
   * Light SEO — Rank Math veya Yoast yoksa fallback olarak çalışır.
   * Plugin varsa onu rahatsız etmez (priority 1, plugin priority 10+).
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

          // Meta description — Rank Math kendi description'ını set etmediyse fallback bas.
          $has_rm_desc = false;
          if ( class_exists( 'RankMath' ) && is_singular() ) {
              $rm_desc     = get_post_meta( get_the_ID(), 'rank_math_description', true );
              $has_rm_desc = ! empty( $rm_desc );
          }

          if ( ! $has_rm_desc ) {
              $desc = '';
              if ( is_singular() ) {
                  $desc = wp_strip_all_tags( get_the_excerpt() );
                  if ( empty( $desc ) ) {
                      $desc = wp_trim_words(
                          wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ) ),
                          28,
                          '...'
                      );
                  }
              } elseif ( is_front_page() || is_home() ) {
                  $desc = 'Sazara Teknoloji — İstanbul İkitelli Aykosan merkezli güvenlik kamerası (CCTV), network altyapısı, Ajax kablosuz alarm ve
  B2B yazılım çözümleri.';
              } else {
                  $desc = get_bloginfo( 'description' );
              }

              if ( ! empty( $desc ) ) {
                  printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
              }
          }

          // Rank Math veya Yoast varsa OG tags'ı kendileri yönetir.
          if ( class_exists( 'RankMath' ) || defined( 'WPSEO_VERSION' ) ) {
              return;
          }

          // Fallback OG tags.
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
