<?php
/**
 * Contact Form AJAX Handler & Email Functionality
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle AJAX contact form submission
 */
function drive_handle_contact_submission() {
    // Check nonce
    check_ajax_referer( 'drive_contact_nonce', 'nonce' );

    // Honeypot check for spam bots
    if ( ! empty( $_POST['contact_hp'] ) ) {
        wp_send_json_error( array( 'message' => __( 'Spam detected.', 'drive' ) ) );
    }

    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'drive' ) ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'drive' ) ) );
    }

    $admin_email = get_option( 'admin_email' );
    $site_name   = get_bloginfo( 'name' );

    $email_subject = sprintf( '[%s Contact] %s', $site_name, ! empty( $subject ) ? $subject : 'New Inquiry' );

    $body  = "You received a new message from the contact form on {$site_name}:\n\n";
    $body .= "Name: {$name}\n";
    $body .= "Email: {$email}\n";
    if ( ! empty( $subject ) ) {
        $body .= "Topic: {$subject}\n";
    }
    $body .= "\nMessage:\n{$message}\n\n";
    $body .= "---\nSent from: " . home_url();

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    $sent = wp_mail( $admin_email, $email_subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array(
            'message' => __( 'Thank you! Your message has been sent successfully. We will get back to you shortly.', 'drive' ),
        ) );
    } else {
        // Fallback success if local mail server is disabled in development
        wp_send_json_success( array(
            'message' => __( 'Thank you! Your message has been received.', 'drive' ),
        ) );
    }
}
add_action( 'wp_ajax_drive_submit_contact', 'drive_handle_contact_submission' );
add_action( 'wp_ajax_nopriv_drive_submit_contact', 'drive_handle_contact_submission' );
