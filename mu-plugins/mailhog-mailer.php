<?php
/**
 * Plugin Name:  Sazara — MailHog Mailer (dev only)
 * Description:  Yerel geliştirmede tüm wp_mail() çağrılarını MailHog'a yönlendirir
 *               (http://localhost:8025). Production'da bu klasör deploy edilmez.
 * Author:       Sazara
 * Version:      1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( defined( 'WP_ENVIRONMENT_TYPE' ) && WP_ENVIRONMENT_TYPE === 'local' ) {
	add_action(
		'phpmailer_init',
		static function ( $phpmailer ) {
			$phpmailer->isSMTP();
			$phpmailer->Host       = 'mailhog';
			$phpmailer->Port       = 1025;
			$phpmailer->SMTPAuth   = false;
			$phpmailer->SMTPSecure = '';
			$phpmailer->From       = 'noreply@sazara.local';
			$phpmailer->FromName   = 'Sazara (dev)';
		}
	);

	add_filter(
		'wp_mail_from',
		static fn() => 'noreply@sazara.local'
	);

	add_filter(
		'wp_mail_from_name',
		static fn() => 'Sazara (dev)'
	);
}
