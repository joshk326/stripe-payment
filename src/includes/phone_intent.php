<?php 
$stripe = new \Stripe\StripeClient('<<YOUR SECERT KEY>>');

if(isset($_POST['establishment']) && isset($_POST['phone']) && isset($_POST['email'])){

    $name = $_POST['establishment'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

   $intent = $stripe->paymentIntents->create([
    'amount' => 6500,
    'currency' => 'usd',
    'automatic_payment_methods' => ['enabled' => true],
    'metadata' => array(
      'establishment' => $name,
      'email' => $email,
      'phone' => $phone
    ),
  ]);
}else{
  http_response_code(400);
}

