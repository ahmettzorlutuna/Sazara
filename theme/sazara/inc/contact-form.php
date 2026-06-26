<?php
/**
 * İletişim formu — vanilla POST handler, plugin gerektirmez.
 *
 * Form action: /wp-admin/admin-post.php
 * Hidden action field: sazara_contact_send
 *
 * Anti-spam: nonce + honeypot (hidden "website" field).
 *
 * @package Sazara
 */

defined( 'ABSPATH' ) || exit;

const SAZARA_CONTACT_TO    = 'info@sazara.com.tr';
const SAZARA_CONTACT_NONCE = 'sazara_contact_nonce';

/**
 * Handle form submission.
 */
function sazara_contact_handle() {
	$redirect_to = home_url( '/iletisim/' );

	// Honeypot — bots fill hidden fields, real users don't.
	if ( ! empty( $_POST['website'] ?? '' ) ) {
		wp_safe_redirect( $redirect_to . '?gonderim=basarili', 303 );
		exit;
	}

	// Nonce.
	$nonce = $_POST[ SAZARA_CONTACT_NONCE ] ?? '';
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $nonce ) ), 'sazara_contact' ) ) {
		wp_safe_redirect( $redirect_to . '?gonderim=guvenlik', 303 );
		exit;
	}

	// Sanitize.
	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$company = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	// Validate.
	if ( empty( $name ) || empty( $email ) || empty( $message ) || ! is_email( $email ) ) {
		wp_safe_redirect( $redirect_to . '?gonderim=eksik', 303 );
		exit;
	}

	// Build mail.
	$subject = sprintf( '[Sazara İletişim] %s', $name );

	$lines = [
		'Yeni iletişim formu mesajı',
		'',
		'Ad:        ' . $name,
		'E-posta:   ' . $email,
	];

	if ( $phone )   { $lines[] = 'Telefon:   ' . $phone; }
	if ( $company ) { $lines[] = 'Şirket:    ' . $company; }
	if ( $service ) { $lines[] = 'Hizmet:    ' . $service; }

	$lines[] = '';
	$lines[] = '— Mesaj —';
	$lines[] = '';
	$lines[] = $message;
	$lines[] = '';
	$lines[] = '---';
	$lines[] = 'IP: ' . ( $_SERVER['REMOTE_ADDR'] ?? '?' );
	$lines[] = 'Tarih: ' . current_time( 'd F Y, H:i' );

	$body = implode( "\n", $lines );

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	];

	$sent = wp_mail( SAZARA_CONTACT_TO, $subject, $body, $headers );

	wp_safe_redirect(
		$redirect_to . ( $sent ? '?gonderim=basarili' : '?gonderim=hata' ) . '#form',
		303
	);
	exit;
}

add_action( 'admin_post_nopriv_sazara_contact_send', 'sazara_contact_handle' );
add_action( 'admin_post_sazara_contact_send', 'sazara_contact_handle' );
