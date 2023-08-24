<?php 
$stripe = new \Stripe\StripeClient('<<YOUR SECERT KEY>>');

if(isset($_POST['fname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['category'])){

    $name = $_POST['fname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $category = $_POST['category'];

    $intent = $stripe->paymentIntents->create([
      'amount' => 1800,
      'currency' => 'usd',
      'automatic_payment_methods' => ['enabled' => true],
      'metadata' => array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'category' => $category
      ),
    ]);
}else{
  http_response_code(400);
}

