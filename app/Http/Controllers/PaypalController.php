<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class PaypalController extends Controller {

	private $_api_context;

	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	/**
	 * @return mixed
	 * Update the controller, this method is when you submit the form or checkout shopping cart,
	 * then post to this route: app/controllers/PaypalController.php
	 */
	public function postPayment()
	{

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$item_1 = new Item();
		$item_1->setName('Item 1') // item name
		->setCurrency('USD')
			->setQuantity(2)
			->setPrice('15'); // unit price

		$item_2 = new Item();
		$item_2->setName('Item 2')
			->setCurrency('USD')
			->setQuantity(4)
			->setPrice('7');

		$item_3 = new Item();
		$item_3->setName('Item 3')
			->setCurrency('USD')
			->setQuantity(1)
			->setPrice('20');

		// add item to list
		$item_list = new ItemList();
		$item_list->setItems(array($item_1, $item_2, $item_3));

		$amount = new Amount();
		$amount->setCurrency('USD')
			->setTotal(78);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Your transaction description');

		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::route('payment.status'))
			->setCancelUrl(URL::route('payment.status'));

		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));

		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Some error occur, sorry for inconvenient');
			}
		}

		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());

		if(isset($redirect_url)) {
			// redirect to paypal
			return Redirect::away($redirect_url);
		}

		return Redirect::route('indexpage')
			->with('error', 'Unknown error occurred');
	}

//SAdd another handler to handle PayPal after payment

	public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');

		// clear the session payment ID
		Session::forget('paypal_payment_id');

		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			return Redirect::route('indexpage')
				->with('error', 'Payment failed');
		}

		$payment = Payment::get($payment_id, $this->_api_context);

		// PaymentExecution object includes information necessary
		// to execute a PayPal account payment.
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));

		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);

		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

		if ($result->getState() == 'approved') { // payment made
			return Redirect::route('checkout.thankyou')
				->with('success', 'Payment success');
		}
		return Redirect::route('checkout.thankyou')
			->with('error', 'Payment failed');
	}

}
