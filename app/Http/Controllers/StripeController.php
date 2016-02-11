<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class StripeController extends \Laravel\Cashier\WebhookController {

	public function handleInvoicePaymentFailed($payload)
    {
        $billable = $this->getBillable($payload['data']['object']['customer']);

        if ($billable) {
            \Mail::send('emails.failed_charge', compact('billable'), function($message)
        	{
        		$message->to(env('MAIL_FROM'), env('MAIL_NAME'));
            	$message->subject('WeDewLawns.com Payment Failed');
        	});
        }

        return new Response('Webhook Handled', 200);
    }
}
