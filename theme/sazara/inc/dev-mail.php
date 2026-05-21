<?php
/**
 * Dev-only SMTP — wp_mail()'i MailHog'a yönlendirir.
 *
 * Sadece WP_DEBUG aktifken (local Docker setup) çalışır. Production'da
 * default mailer veya bir SMTP plugin (örn. WP Mail SMTP) kullanılır.
 *
 * Docker network: WP container "mailhog" hostname'iyle MailHog konteynerine
 * 1025 portu üzerinden SMTP konuşur. MailHog UI: http://localhost:8025
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

// Sadece dev ortamı.
if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
	return;
}

add_action(
	'phpmailer_init',
	static function ( $phpmailer ) {
		$phpmailer->isSMTP();
		$phpmailer->Host        = 'mailhog';
		$phpmailer->Port        = 1025;
		$phpmailer->SMTPAuth    = false;
		$phpmailer->SMTPAutoTLS = false;
		$phpmailer->SMTPSecure  = '';

		// Default From — MailHog herhangi bir adres kabul eder, ama WP'nin
		// "WordPress <wordpress@localhost>" defaultu yerine theme-friendly olsun.
		$phpmailer->setFrom( 'no-reply@sazara.local', 'Sazara (dev)' );
	}
);

/**
 * From e-mail filter — wp_mail()'in From header'ını da senkron tut.
 */
add_filter( 'wp_mail_from', static fn() => 'no-reply@sazara.local' );
add_filter( 'wp_mail_from_name', static fn() => 'Sazara (dev)' );
