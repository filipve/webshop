@extends('admin.layouts.app')

@section('main-content')

<p>
    <a href="{{ URL::Route('admin.products.index') }}">&laquo; Return to Products</a>
</p>

<div class="col-md-6">

    <h1>Edit {{ $product->name }}</h1>

    {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'put', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
        
        {!! Form::hidden('id') !!}

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                There were some problems with your input.<br />
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
     
    <div class="form-group">
        {!! Form::label('Product Name') !!}
        {!! Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'List Name')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Product SKU') !!}
        {!! Form::text('sku', null, array('required', 'class'=>'form-control', 'placeholder'=>'LAWN-1234')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Product Image (PNG') !!}
        {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
        @if(file_exists(public_path()."/imgs/products/".$product->sku.".png")) 
            <input type="hidden" name="has_image" value="yes">
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('Price') !!}
        <div class="input-group">
          <span class="input-group-addon">$</span>
        	{!! Form::text('price', null, array('required', 'class'=>'form-control', 'placeholder'=>'9.99')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('Product Description') !!}
        {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Enter a short description')) !!}
    </div>

    @if ($product->is_downloadable)

    <div class="form-group">
        {!! Form::label('download', 'Product Download') !!}
        {!! Form::file('download', null, array('class'=>'form-control')) !!}
    </div>

    @endif
     
        {!! Form::submit('Edit Product!', array('class'=>'btn btn-primary')) !!}

    {!! Form::close() !!}
</div>

<div class="col-md-6">

@if(file_exists(public_path()."/imgs/products/".$product->sku.".png")) 
  <img src="/imgs/products/{{ $product->sku }}.png" />
@else
  Could not find file
@endif

</div>

@endsection
