<?php
	require_once( __DIR__ . '/includes/stripe-php/init.php' );

	if(isset($_POST['product'])){
		$product = $_POST['product'];
		$amount = 0;
		//Can use a switch case to handle multiple products
		//You can setup multiple intents depending on the selected product
		switch($product){
			case 'book':
				if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['book-title']) && isset($_POST['book-cover']) && isset($_POST['book-quantity'])){
					require_once(__DIR__ .'/includes/intent.php');

					$book_title = $_POST['book-title'];
					$book_cover = $_POST['book-cover'];
					$book_quantity = $_POST['book-quantity'];
					if($book_title == "Harry_Potter" && $book_cover == "Hardback" && $book_quantity > 0){
						$amount = 15 * $book_quantity;
					}else if($book_title == "Harry_Potter" && $book_cover == "Paperback" && $book_quantity > 0){
						$amount = 6 * $book_quantity;
					}else if($book_title == "Hunger_Games" && $book_cover == "Hardback" && $book_quantity > 0){
						$amount = 12 * $book_quantity;
					}else if($book_title == "Hunger_Games" && $book_cover == "Paperback" && $book_quantity > 0){
						$amount = 9 * $book_quantity;
					}
				}else{
					http_response_code(400);
				}
				break;
		}
	}else{
		http_response_code(400);
	}
?>
<!DOCTYPE html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<title>Stripe Checkout</title>
		<link rel="icon" href="#" type="image/x-icon"/>
		<script src="https://js.stripe.com/v3/"></script>
	</head>
	<body>
		<div class="content">
			<form id="payment-form" data-secret="<?= $intent->client_secret ?>">
			  <h1>Total: $<span id="total-amount"><?echo $amount?></span></h1>
			  <div id="payment-element">
			    <!-- Elements will create form elements here -->
			  </div>
			  <br>
			  <button id="submit">Submit</button>
			  <p style="width: 226px; padding: 10px 0">By submitting your payment you agree to these <a href="javascript:void(0);" id="terms" class="terms">terms and conditions</a></p>
			</form>
		</div>
	</body>
	<script src="checkout.js"></script>
</html>