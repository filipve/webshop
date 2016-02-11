@extends('admin.layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-md-6">

            <h1>Create a New Product</h1>


            {!! Form::open(array('route' => 'admin.products.store', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    There were some problems with your input.<br/>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Product Name') !!}
                {!! Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'Product Name')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('sku', 'Product SKU') !!}
                {!! Form::text('sku', null, array('required', 'class'=>'form-control', 'placeholder'=>'LAWN-1234')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Product Image') !!}
                {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Price') !!}
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {!! Form::text('price', null, array('required', 'class'=>'form-control', 'placeholder'=>'9.99')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Product Description') !!}
                {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Enter a short description')) !!}
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label for="is_downloadable">
                        {!! Form::checkbox('is_downloadable', true, null, array('id'=>'downloadable')) !!}
                        Downloadable?
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('download', 'Product Download (if downloadable product)') !!}
                {!! Form::file('download', null, array('class'=>'form-control')) !!}
            </div>

            {!! Form::submit('Create Product!', array('class'=>'btn btn-primary')) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
