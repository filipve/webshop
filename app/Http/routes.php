<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',
    ['as' => 'indexpage','uses'=>'WelcomeController@index']);





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //

    Route::get('discounts', 'DiscountController@index');

    //aboutpagina
    Route::get('about', 'AboutController@index');

    //voor de contactform
    Route::get('contact', [
        'as' => 'contact', 'uses' => 'ContactController@create'
    ]);

    //voor de contactform
    Route::post('contact', [
        'as' => 'contact_store', 'uses' => 'ContactController@store'
    ]);

    Route::resource('products', 'ProductController');

    Route::get('cart', 'CartController@index');
    Route::post('cart/store', 'CartController@store');
    Route::get('cart/remove/{id}', 'CartController@remove');
    Route::post('cart/complete', [
        'as' => 'cart.complete',
        'uses' => 'CartController@complete'
    ]);

    Route::get('products/download/{id}', ['uses' => 'ProductController@download']);

    /**
     * Membership routes
     */
    Route::get('plans', [
        'as' => 'plans', 'uses' => 'SubscriptionsController@index'
    ]);
    Route::get('plans/subscribe/{planId}', [
        'as' => 'plans.subscribe', 'uses' => 'SubscriptionsController@subscribe'
    ]);
    Route::post('plans/process', [
        'as' => 'plans.process', 'uses' => 'SubscriptionsController@process'
    ]);
    Route::post('plans/coupon', [
        'as' => 'plans.coupon', 'uses' => 'SubscriptionsController@applyCoupon'
    ]);
    Route::post('plans/swap', [
        'as' => 'plans.swap', 'uses' => 'SubscriptionsController@swapPlans'
    ]);
    Route::post('plans/cancel', [
        'as' => 'plans.cancel', 'uses' => 'SubscriptionsController@cancelPlan'
    ]);
    Route::get('invoices', [
        'as' => 'invoices', 'uses' => 'SubscriptionsController@invoices'
    ]);
    Route::get('invoices/download/{id}', [
        'uses' => 'SubscriptionsController@downloadInvoice'
    ]);

    Route::post('checkout', [
        'uses' => 'CheckoutController@index'
    ]);
    Route::get('checkout/thankyou', [
        'as' => 'checkout.thankyou', 'uses' => 'CheckoutController@thankyou'
    ]);

    Route::post('stripe/webhook', 'StripeController@handleWebhook');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
        Route::get('/', 'IndexController@index');
        Route::resource('orders', 'OrderController');
        Route::resource('products', 'ProductController');
    });



    /*
     * Paypal testen
     */

    Route::post('payment', array(
        'as' => 'payment',
        'uses' => 'PaypalController@postPayment',
    ));

// this is after make the payment, PayPal redirect back to your site
    Route::get('payment/status', array(
        'as' => 'payment.status',
        'uses' => 'PaypalController@getPaymentStatus',
    ));
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

   // Route::get('/home', 'HomeController@index');
});
