<?php 
$stripe = new \Stripe\StripeClient('<<YOUR SECERT KEY>>');

if(isset($_POST['fname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['tickets'])){

    $name = $_POST['fname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $tickets = $_POST['tickets'];

   $intent = $stripe->paymentIntents->create([
    'amount' => 400 * $tickets,
    'currency' => 'usd',
    'automatic_payment_methods' => ['enabled' => true],
    'metadata' => array(
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'tickets' => $tickets
    ),
  ]);
}else{
  http_response_code(400);
}

