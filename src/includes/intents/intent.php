<?php 
$stripe = new \Stripe\StripeClient('<<YOUR SECERT KEY>>');

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['book-title']) && isset($_POST['book-cover']) && isset($_POST['book-quantity'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $book_title = $_POST['book-title'];
    $book_cover = $_POST['book-cover'];
    $book_quantity = $_POST['book-quantity'];

    //amount is displayed in cents e.g. $1 = 100
    if($book_title == "Harry_Potter" && $book_cover == "Hardback" && $book_quantity > 0){
      $amount = 1500 * $book_quantity;
    }else if($book_title == "Harry_Potter" && $book_cover == "Paperback" && $book_quantity > 0){
      $amount = 600 * $book_quantity;
    }else if($book_title == "Hunger_Games" && $book_cover == "Hardback" && $book_quantity > 0){
      $amount = 1200 * $book_quantity;
    }else if($book_title == "Hunger_Games" && $book_cover == "Paperback" && $book_quantity > 0){
      $amount = 900 * $book_quantity;
    }

   $intent = $stripe->paymentIntents->create([
    'amount' => $amount,
    'currency' => 'usd',
    'automatic_payment_methods' => ['enabled' => true],
    'receipt_email' => $email,
    'metadata' => array(
      'name' => $name,
      'email' => $email,
      'book_title' => $book_title,
      'book_cover' => $book_cover,
      'quantity' => $book_quantity,
    ),
  ]);
}else{
  http_response_code(400);
}

