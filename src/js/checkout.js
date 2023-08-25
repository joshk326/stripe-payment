const terms = document.getElementById('terms');
const form = document.getElementById('payment-form');

terms.addEventListener("click", function() {
	alert("My Terms Here");
});

const stripe = Stripe( '<<YOUR PUBLIC KEY>>' );

const options = {
  clientSecret: form.getAttribute('data-secret'),
  appearance: {/*Vist https://stripe.com/docs/elements/appearance-api for more details on how to customize your payment form*/},
};

const elements = stripe.elements(options);

const paymentElement = elements.create('payment');
paymentElement.mount('#payment-element');



form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {error} = await stripe.confirmPayment({
    elements,
    confirmParams: { //if payment processing is successful then redirect to success.html
      return_url: 'https://<<YOUR DOMAIN>>/success.html',
    },
  });

  if (error) {
    const messageContainer = document.querySelector('#error-message');
    messageContainer.textContent = error.message;
  } else {
    // Your customer will be redirected to your `return_url`. For some payment
    // methods like iDEAL, your customer will be redirected to an intermediate
    // site first to authorize the payment, then redirected to the `return_url`.
  }
});