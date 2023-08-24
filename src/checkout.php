<?php
	require_once( __DIR__ . '/includes/stripe-php/init.php' );

	if(isset($_POST['product'])){
		$type = $_POST['product'];
		$amount = 0;
		switch($type){
			case 'book':
				if(isset($_POST['fname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['tickets'])){
					require_once(__DIR__ .'/includes/book_intent.php');
					$amount = 15 * $_POST['tickets'];
				}else{
					http_response_code(400);
				}
				
				break;
			case 'car':
				if(isset($_POST['fname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['color'])){
					require_once(__DIR__ .'/includes/car_intent.php');
					$amount = 18000;
				}
				else{
					http_response_code(400);
				}
				break;
			case 'phone':
				if(isset($_POST['fname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['phone-model'])){
					require_once(__DIR__ .'/includes/phone_intent.php');
					$amount = 1200;
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
			<form id="payment-form" class="box checkout-box" data-secret="<?= $intent->client_secret ?>">
			  <h1>Total: $<span id="total-amount"><?echo $amount?></span></h1>
			  <div id="payment-element">
			    <!-- Elements will create form elements here -->
			  </div>
			  <br>
			  <button id="submit" class="btn pay-btn">Submit</button>
			  <p style="width: 226px; padding: 10px 0">By submitting your payment you agree to these <a href="javascript:void(0);" id="terms" class="terms">terms and conditions</a></p>
			</form>
		</div>
	</body>
	<script src="checkout.js"></script>
</html>