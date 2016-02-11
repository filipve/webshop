@extends('admin.layouts.app')

@section('main-content')

<h1>Manage Orders</h1>

  @if (count($orders) > 0)

      <table class="table table-striped">
      <thead>
      <tr>
        <th>Order #</th>
        <th>Ordered On</th>
        <th>Customer Name</th>
        <th>Customer e-mail</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($orders as $order)

        <tr>
          <td>
            <a href="{{ URL::route('admin.orders.edit', $order->id) }}">{{ $order->order_number }}</a>
          </td>
          <td>
            {{ $order->created_at }}
          </td>
          <td>
            {{ $order->billing_name }}
          </td>
          <td>
            {{ $order->email }}
          </td>
        </tr>

      @endforeach
      </tbody>
      </table>

      {!! $orders->render() !!}

    @else
     <p>
      You haven't created any orders. <a href="/admin/product/create">Create a Product</a>
    </p>
    @endif

@endsection