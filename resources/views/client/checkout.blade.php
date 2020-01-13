<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- <- your css --}}
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>@yield('checkout','Checkout Page')</title>
    <!-- Styles -->
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}"> {{-- <- your css --}}
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
@include('inc.navbar_client')
<main class="container mt-4">
    <div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="#" class="check-bc">Cart</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="#" class="check-bc">Checkout</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
           
            <div class="row cart-body">
            <div id="charge-error" class ="alert alert-danger{{ !Session::has('error') ? 'hidden' : ''}}">
                {{Session::get('error')}}
            </div>
        <form class="form-horizontal" method="POST" action="{{route('product.storeCheckout')}}" id="payment-form">
            {{ csrf_field() }}
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"><small><a class="afix-1" href="#">Edit Cart</a></small></div>
                        </div>
                        <div class="panel-body">
                            @foreach ($products as $product)
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="//c1.staticflickr.com/1/466/19681864394_c332ae87df_t.jpg" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12">{{ $product->name }}</div>
                                    <div class="col-xs-12"><small>Quantity:{{$product->quantity}}</small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6><span>€</span>{{ $product->price*$product->quantity }}</h6>
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>€</span><span>{{ Cart::getSubTotal()}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Address</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Shipping Address</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="country" id="country" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" id="address" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" id="city" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="postalcode" id="postalcode" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" id="phone_number" class="form-control" required></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" id="email_address" class="form-control" required></div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card Type:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" id="CreditCardType" class="form-control" required>
                                        <option value="5">Visa</option>
                                        <option value="6">MasterCard</option>
                                        <option value="7">American Express</option>
                                        <option value="8">Discover</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="card-element">
                                    <div class="col-md-12"><strong>Credit or debit card:</strong></div>
                                  </label>
                                  <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                  </div>
                              
                                  <!-- Used to display form errors. -->
                                  <div id="card-errors" role="alert"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pay secure using your credit card.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                        <li class="amex hand">Amex</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
                </div>
                {{ csrf_field() }}
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>

        <script>
            (function(){
                // Create a Stripe client.
                var stripe = Stripe('{{config('services.stripe.key')}}');

                // Create an instance of Elements.
                var elements = stripe.elements();

                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                    color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
                };

                // Create an instance of the card Element.
                var card = elements.create('card', {style: style,hidePostalCode: true});

                // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');

                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
                });

                // Handle form submission.
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                event.preventDefault();

                var options={
                    name: document.getElementById('name').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_zip: document.getElementById('postalcode').value
                }
                stripe.createToken(card,options).then(function(result) {
                    if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                    }
                });
                });

                // Submit the form with the token ID.
                function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
                }

            })();
        </script>
        </main>
        @include('inc.footer')
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="{{asset('js/app.js')}}"></script> {{-- your js --}}
</body>
</html>