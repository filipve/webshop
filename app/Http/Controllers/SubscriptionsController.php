<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class SubscriptionsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->subscribed('main'))
        {
            return redirect()->route('invoices');
        }
        return view('subscriptions.index');
    }

    public function subscribe($planId)
    {
        if ($this->planNotAvailable($planId)) {
            return redirect()->route('plans');
        }

        return view('subscriptions.subscribe', compact('planId'));
    }

    public function swapPlans(Request $request)
    {
        $planId = $request->get('plan_id');

        if ($this->planNotAvailable($planId)) {
            return redirect()->back()->withErrors('Plan is required');
        }
        //Auth::user()->subscription($planId)->swap();
        Auth::user()->subscription('main')->swap($planId);

        return redirect()->back()->withMessage('Plan changed!');
    }

    protected function planNotAvailable($id)
    {
        $available = ['gold', 'diamond', 'platinum'];
        if ( ! in_array($id, $available))
        {
            return true;
        }
        return false;
    }

    public function process(Request $request)
    {
        $planId = $request->get('plan_id');

        if ($this->planNotAvailable($planId)) {
            return redirect()->back()->withErrors('Plan is required');
        }

        // Retrieve a model by its primary key...
        //$user = User::find(1);

        $user = Auth::user();

        //The first argument passed to the newSubscription method
        // should be the name of the subscription.
//If your application only offers a
// single subscription, you might call this main or primary.

        //The second argument is the specific Stripe plan the user is subscribing
        // to. This value should correspond to the plan's identifier in Stripe.
        $user->newSubscription('main',$planId)->create($request->get('stripe_token'), [
            'email' => $user->email,
            'metadata' => [
                'name' => $user->name,
            ],
        ]);

        return redirect('invoices');
    }

    public function invoices()
    {

        $user = Auth::user();
        $invoices = Auth::user()->invoices();
        $subscribed = Auth::user()->subscribed('main');
        $nextpayment = Auth::user()->upcomingInvoice()->total();
        $cancelled = Auth::user()->subscription('main')->cancelled();



        return view('subscriptions.invoices', compact('user','invoices','subscribed','nextpayment','cancelled'));
    }

    public function downloadInvoice($id)
    {
        return Auth::user()->downloadInvoice($id, [
            'header'  => 'We Dew Lawns',
            'vendor'  => 'WeDewLawns',
            'product' => Auth::user()->stripe_plan,
            'street' => '123 Lawn Drive',
            'location' => 'Lawndale NC, 28076',
            'phone' => '703.913.2432',
            'url' => 'www.wedewlawns.com',
        ]);
    }

    public function cancelPlan()
    {
        Auth::user()->subscription('main')->cancel();
        return redirect('invoices');
    }
}
