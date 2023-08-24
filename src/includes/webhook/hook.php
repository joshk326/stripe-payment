<?php
require_once( __DIR__ . '/../stripe-php/init.php');

\Stripe\Stripe::setApiKey('<<YOUR SECRET KEY>>');

$endpoint_secret = '<<YOUR SECRET SIGNING KEY>>';

// some checks start here
$payload = @file_get_contents('php://input');
$event = null;

try {
	$event = \Stripe\Event::constructFrom( json_decode($payload, true) );
} catch(\UnexpectedValueException $e) {
	echo 'Webhook error while parsing basic request.';
	http_response_code(400);
	exit();
}

if ($endpoint_secret) {
	$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
	try {
		$event = \Stripe\Webhook::constructEvent( $payload, $sig_header, $endpoint_secret );
	} catch(\Stripe\Exception\SignatureVerificationException $e) {
		echo 'Webhook error while validating signature.';
		http_response_code(400);
		exit();
	}
}
// checks ended

// handle the event
if( 'payment_intent.succeeded' === $event->type ) {

	$paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
	
	//EXAMPLES
	// $name = $paymentIntent['metadata']->name
	// $prodcut_id = $paymentIntent[ 'metadata' ]->prodcut_id;
	// $amount = $paymentIntent[ 'amount_received' ] / 100;
	// $billing_details = $paymentIntent[ 'charges' ]->data[0]->billing_details;
	// $email = $billing_details->email;
	// $name = $billing_details->name;
	// $country_code = $billing_details->address->country;

	// Do anything you want, e.g. create orders, send emails, upload metadata into database, etc.

}

http_response_code(200);