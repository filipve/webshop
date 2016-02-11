<?php namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the cart
     */
    public function index()
    {
        $cart = Auth::user()->cart;
        return view('cart.index', compact('cart'));
    }

    /**
     * Add an item to the cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $product = Product::find($request->get('product_id'));

        $cart = new Cart([
            'product_id' => $product->id,
            'qty' => $request->get('qty', 1),
            'price' => $product->price,
        ]);

        Auth::user()->cart()->save($cart);
        return redirect('/cart');

    }

    /**
     * Remove an item from the cart
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove($id)
    {
        Auth::user()->cart()
          ->where('id', $id)->firstOrFail()->delete();
        return redirect('/cart');
    }

    /**
     * Complete the order
     *
     * @param Request $request
     * @return $this|\Illuminate\View\View
     */
    public function complete(Request $request)
    {
        $user = Auth::user();

        $total = $user->cart->sum(function($item){
            return $item->product->priceToCents();
        });

        $charge = $user->charge($total, [
            'source' => $request->get('stripe_token'),
            'receipt_email' => $user->email,
            'metadata' => [
                'name' => $user->name,
            ],
        ]);

        if (! $charge) {
            return back()->withErrors('Charge Failed');
        }

        // Add the order
        $order = new Order();
        $order->order_number = $charge->id;
        $order->email = $user->email;
        $order->billing_name = $request->input('card_name');
        $order->billing_address = $request->input('address');
        $order->billing_city = $request->input('city');
        $order->billing_state = $request->input('state');
        $order->billing_zip = $request->input('zip');
        $order->billing_country = $request->input('country');

        $order->shipping_name = $request->input('shipping_name');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_state = $request->input('shipping_state');
        $order->shipping_zip = $request->input('shipping_zip');
        $order->shipping_country = $request->input('shipping_country');
        $order->save();

        // Update the old cart
        foreach ($user->cart as $cart) {
            $cart->order_id = $order->id;
            $cart->complete = 1;
            $cart->save();
        }

        return view('checkout.thankyou', compact('order', 'charge'));
    }
}