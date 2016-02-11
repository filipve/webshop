<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		$user = new User();

		$product = Product::find($request->input('product_id'));

		$stripeEmail = $request->input('stripeEmail');

		$stripeToken = $request->input('stripeToken');
		$stripeTokenType = $request->input('stripeTokenType');

		if ( $user->charge($product->priceToCents(), 
			 	[
			 	'source' => $stripeToken, 
			 	'receipt_email' => $stripeEmail, 
			 	'metadata' => ['shipping' => '9.99', 'sales_tax' => '4.27']
			 	]
			 	)
		    ) {

			$order = new Order();

			// Generate random order number
			$order->order_number = substr(md5(microtime()),rand(0,26),3) . time();

			$order->product_id = $product->id;

			$order->email = $request->input('stripeEmail');
			$order->billing_name = $request->input('stripeBillingName');
			$order->billing_address = $request->input('stripeBillingAddressLine1');
			$order->billing_city = $request->input('stripeBillingAddressCity');
			$order->billing_state = $request->input('stripeBillingAddressState');
			$order->billing_zip = $request->input('stripeBillingAddressZip');
			$order->billing_country = $request->input('stripeBillingAddressCountry');

			$order->shipping_name = $request->input('stripeShippingName');
			$order->shipping_address = $request->input('stripeShippingAddressLine1');
			$order->shipping_city = $request->input('stripeShippingAddressCity');
			$order->shipping_state = $request->input('stripeShippingAddressState');
			$order->shipping_zip = $request->input('stripeShippingAddressZip');
			$order->shipping_country = $request->input('stripeShippingAddressCountry');

			$order->save();

			if ($order->product->is_downloadable) {
				
				$order->onetimeurl = md5(time() . $order->email . $order->order_number);
				$order->save();

				$data = ['order' => $order];

		        \Mail::send('emails.download',
		            $data, 
		            function($message) use ($data)
		        {
		        	$message->from(env('MAIL_FROM'));
		            $message->to($data['order']->email, $data['order']->billing_name);
		            $message->subject('WeDewLawns.com Digital Download Instructions');
		        });

			}



		} else {

		    return \Redirect::route('products.show', [$product->id])
		    	->with('message', 'There was a problem completing your order.');

		}

		    return \Redirect::route('checkout.thankyou')
		    	->with('message', 'Thank you for your order.');

	}

	/**
	 * Thank the customer for purchase
	 *
	 * @return Response
	 */
	public function thankyou()
	{
		return view('checkout.thankyou');
	}

}
