<?php
/**
 * Customer processing order email
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );

// Is altijd ingevuld, dus geen check doen
echo '<p>Dag '.$order->get_billing_first_name().',</p>';

if ( $order->has_shipping_method('local_pickup_plus') ) {
	$methods = $order->get_shipping_methods();
	$method = reset($methods);
	$pickup_location = $method->get_meta('pickup_location');
	
	$delivery = get_post_meta( $order->get_id(), 'estimated_delivery', true );
	$leverdag = date_i18n( $delivery, 'l d/m' );
	$leveruur = date_i18n( $delivery, 'G\ui' );

	printf( '<p>'.__( 'Bericht bovenaan de 1ste bevestigingsmail (indien afhaling in de winkel), inclusief afhaalwinkel (%1$s), -dag (%2$s) en -uur (%3$s).', 'oxfam-webshop' ).'</p>', $pickup_location['company'], $leverdag, $leverdag );
} else {
	printf( '<p>'.__( 'Bericht bovenaan de 1ste bevestigingsmail (indien thuislevering).', 'oxfam-webshop' ).'</p>' );
}

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
