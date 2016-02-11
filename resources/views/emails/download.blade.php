<p>
Hi {{ $order->billing_name }},

<p>
Thank you for your purchase. Click on the below link to
download your copy of {{ $order->product->name }}:
</p>

<p>
http://wedewlawns.com/product/download/{{ $order->onetimeurl }}
</p>