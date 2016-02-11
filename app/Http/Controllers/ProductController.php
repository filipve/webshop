<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use Illuminate\Http\Request;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::orderBy('name', 'asc')->get();
		return view('product.index', compact('products'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = Product::findOrFail($id);
		return view('product.show', compact('product'));
	}

	/**
	 * Download electronic product
	 * @param  string $id one time URL key
	 * @return Response
	 */
	public function download($id) {

		$order = Order::where('onetimeurl', $id)->first();

		if ($order) {

			$product = $order->product;

			$order->onetimeurl = '';
			$order->save();

			return response()->download(storage_path().'/downloads/' . $product->download);

		} else {
			abort(401, 'Access denied');
		} 

	}

}
