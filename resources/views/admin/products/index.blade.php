@extends('admin.layouts.app')

@section('main-content')

<h1>Manage Products</h1>

  @if (count($products) > 0)
    <p>
      <a href="{{ URL::Route('admin.products.create') }}" class="btn btn-success">Create a Product</a>
    </p>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr>
            <td>
              <a href="{{ URL::route('admin.products.edit', $product->id) }}">{{ $product->name }}</a>
            </td>
            <td>
              ${{ $product->price }}
            </td>
            <td>
              {!! Form::open(array('route' => array('admin.products.destroy', $product->id), 'method' => 'delete')) !!}
              <button type="submit" class="btn btn-success" href="{{ URL::route('admin.products.destroy', $product->id) }}" title="Delete Product">
              Delete
              </button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>
      You haven't created any products. <a href="/admin/products/create">Create a Product</a>
    </p>
  @endif

@endsection