@extends('app')

@section('content')

    <h1>Cart</h1>

    @if (count($cart) == 0)
        <p>Your cart is currently empty</p>
    @else
        <table class="table table-border">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cart as $item)
                <tr>
                <td><a href="/cart/remove/{{ $item->id }}">x</a></td>
                <td>{{ $item->product->name }}</td>
                <td>${{ $item->product->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr/>
        {!! Form::open(['url' => '/cart/complete', 'class' => 'form', 'id' => 'purchase-form']) !!}

            <h1>Billing Information</h1>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="card_name" class="control-label">Name on card</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="card_name"
                               id="card_name" value="{{ Auth::user()->name }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="address" class="control-label">Address</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               id="address"
                               name="address"
                               placeholder="Address">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="city" class="control-label">City</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               id="city"
                               name="city"
                               placeholder="City">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="state" class="control-label">State</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="state"
                               id="state">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="zip" class="control-label">Zip</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="zip"
                               id="zip">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="country" class="control-label">Country</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="country"
                               id="country">
                    </div>
                </div>
            </div>

            <h1>Shipping Information</h1>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="shipping_name" class="control-label">Shipping Name</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="shipping_name"
                               id="shipping_name" value="{{ Auth::user()->name }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="shipping_address" class="control-label">Address</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               id="shipping_address"
                               name="shipping_address"
                               placeholder="Address">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="shipping_city" class="control-label">City</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               id="shipping_city"
                               name="shipping_city"
                               placeholder="City">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="shipping_state" class="control-label">State</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="shipping_state"
                               id="shipping_state"
                               placeholder="State">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="shipping_zip" class="control-label">Zip</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="shipping_zip"
                               placeholder="Zip Code"
                               id="zip">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="shipping_country" class="control-label">Country</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               name="shipping_country"
                               value="USA"
                               id="shipping_country">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="card-number" class="control-label">Credit Card Number</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"
                               class="form-control"
                               id="card-number"
                               placeholder="Valid Card Number" required autofocus
                               data-stripe="number"
                               value="{{ App::environment() == 'local' ? '4242424242424242' : '' }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-4">
                        <label for="card-month">Expiration Date</label>
                    </div>
                    <div class="col-xs-8">
                        <label for="card-cvc">Security Code</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <input type="text" size="3"
                               class="form-control"
                               name="exp_month"
                               data-stripe="exp-month"
                               placeholder="MM"
                               id="card-month"
                               value="{{ App::environment() == 'local' ? '12' : '' }}"
                               required>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" size="4"
                               class="form-control"
                               name="exp_year"
                               data-stripe="exp-year"
                               placeholder="YYYY"
                               id="card-year"
                               value="{{ App::environment() == 'local' ? '2016' : '' }}"
                               required>
                    </div>
                    <div class="col-xs-2">
                        <input type="text"
                               class="form-control"
                               id="card-cvc"
                               placeholder=""
                               size="6"
                               value="{{ App::environment() == 'local' ? '111' : '' }}">
                    </div>
                </div>

            </div>

            <div class="center-block form-actions">
                <button type="submit" class="submit-button btn btn-primary btn-lg">Complete Order</button>
            </div>
        {!! Form::close() !!}





        <hr/>
        {!! Form::open(['url' => '/payment', 'class' => 'form']) !!}

        <h1>Billing Information</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <label for="card_name" class="control-label">Name on card</label>
                </div>
                <div class="col-sm-4">
                    <input type="text"
                           class="form-control"
                           name="card_name"
                           id="card_name" value="{{ Auth::user()->name }}">
                </div>
            </div>
        </div>


        <div class="center-block form-actions">
            <button type="submit" class="submit-button btn btn-primary btn-lg">Complete Order</button>
        </div>
        {!! Form::close() !!}
    @endif


@endsection


@section('footer_js')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey('{{ env('STRIPE_API_PUBLIC') }}');

        //Stripe.setPublishableKey('{{ 'pk_test_Y0Q4sWMVRPyWBzgoZ1xSLNGe' }}');
        jQuery(function($) {
            $("#card-number").focusout(function() {
                var el = $(this);
                if ( ! Stripe.validateCardNumber(el.val())) {
                    el.closest(".form-group").addClass("has-error");
                } else {
                    el.closest(".form-group").removeClass("has-error");
                }
            });
            $("#card-cvc").focusout(function() {
                var el = $(this);
                if ( ! Stripe.validateCVC(el.val())) {
                    el.closest("div").addClass("has-error");
                } else {
                    el.closest("div").removeClass("has-error");
                }
            });
            $('#purchase-form').submit(function(e) {
                $('.submit-button').prop('disabled', true);
                var $form = $(this);
                $form.find('.payment-errors').hide()
                Stripe.card.createToken({
                    number: $form.find('#card-number').val(),
                    cvc: $form.find('#card-cvc').val(),
                    exp_month: $form.find('#card-month').val(),
                    exp_year: $form.find('#card-year').val()
                }, stripeResponseHandler);

                return false;
            });
        });

        var stripeResponseHandler = function(status, response) {
            var $form = $('#purchase-form');
            var $errors = $('.payment-errors');
            // Reset any errors
            $errors.text("");

            if (response.error) {
                $errors.text(response.error.message).show();
                $form.find('button').prop('disabled', false);
            } else {
                var token = response.id;
                $form.append($('<input type="hidden" name="stripe_token" />').val(token));
                $form.get(0).submit();
                $form.find('button').html('Processing...');
            }
        };
    </script>
@endsection