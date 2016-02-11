@extends('app')

@section('content')
    <div class="col-xs-12">
        <h1>Product Catalog</h1>

        @if (count($products) > 0)
            <?php $i = 0; ?>

            <div class="row">
                @foreach ($products as $product)
                    {{--{{Debugbar::info($i)}}--}}
                    <div class="col-md-4 col-xs-6">
                        <img class="product-img centerimg" src="/imgs/products/{{ $product->sku }}.png"/>
                        <h3 class="text-center">
                            {!! link_to_route('products.show', $product->name, [$product->id]) !!}
                        </h3>
                        <div class="text-center">
                            <div class="price">
                                <strong>${{ $product->price }}</strong>
                            </div> <!-- price -->
                            <div class="description">
                                {{ $product->description }}
                            </div> <!-- description -->
                            <div>
                                <span class="cart"><a href="#">Add to cart</a></span>
                                <!-- Media icon --><span class="p-media pull-right">
                    <a href="#" class="b-tooltip" data-placement="top" title="21"><i class="fa fa-heart red"></i></a>
                    <a href="#" class="b-tooltip" data-placement="top" title="49"><i
                                class="fa fa-share-alt red"></i></a>
                    <a href="#" class="b-tooltip" data-placement="top" title="35"><i
                                class="fa fa-thumbs-up red"></i></a>
                </span>
                            </div> <!-- add to cart -->
                        </div>

                    </div> <!-- einde col-md- col-xs- -->


                    <?php $i++;
                    if($i % 4 == 0) echo "</div>" + "\n" + "<div class='row'>";
                        ?>

                @endforeach
            </div>

        @else
            <p>The product catalog is currently offline.</p>
        @endif
    </div>
@endsection