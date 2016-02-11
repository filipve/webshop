@extends('app')

@section('intro')
    <div class="intro">
        <div class="container">
            <h1>Invoices</h1>
        </div>
    </div>
@endsection

@section('content')

    @if ($user->subscribed('main'))
<p>You are subscribed</p>

        @if($user->subscription('main')->cancelled())
            <p>Your subscription will end on {{$user->subscription('main')->ends_at->format(' D d M Y')}} </p>
        @endif

<ul>@if(!$user->subscription('main')->cancelled())
        <li>
            <a href="{{url('/plans/cancel')}}">Cancel my subscription</a>
        </li>
    @else
        <li>
            <a href="{{url('/plans/resume')}}">Resume my subscription</a>
        </li>
    @endif
</ul>







<div class="panel panel-default">
    <div class="panel-heading">Current Plan</div>
    <div class="panel-body">
        {!! Form::open(['route' => 'plans.swap', 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Current Plan</label>
            <div class="col-sm-8">
                <p class="form-control-static">{{ $user->subscription('main')->stripe_plan }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Next Scheduled Payment</label>
            <div class="col-sm-8">
                <p class="form-control-static">

                    {{$nextpayment}}

                    {{--${{ $user->formatCurrency($user->upcomingInvoice()->total) }} on
                    <small>{{ Carbon\Carbon::createFromTimestamp($user->upcomingInvoice()->
                    next_payment_attempt)->toDayDateTimeString() }}</small>--}}
                </p>
            </div>
        </div>

        @if($user->upcomingInvoice()->discount)
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Discount</label>
                <div class="col-sm-8">
                    <p class="form-control-static text-success">
                        @if($user->upcomingInvoice()->discount->coupon->percent_off)
                            {{ $user->upcomingInvoice()->discount->coupon->percent_off }}% off
                            {{ $user->upcomingInvoice()->discount->coupon->duration }}
                        @else
                            ${{ $user->upcomingInvoice()->discount->coupon->amount_off }} off
                            {{ $user->upcomingInvoice()->discount->coupon->duration }}
                        @endif
                    </p>
                </div>
            </div>
        @endif

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Change Plan</label>
            <div class="col-sm-8">
                <select name="plan_id" class="form-control" id="plan_id">
                    <option value="gold">Gold / $20 per month</option>
                    <option value="platinum">Platinum / $35 per month</option>
                    <option value="diamond">Diamond / $50 per month</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-default">Swap Plans</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">Add a coupon</div>
    <div class="panel-body">
        {!! Form::open(array('route' => 'plans.coupon', 'class' => 'form-inline')) !!}
        <div class="form-group">
            <label for="coupon">Coupon</label>
            <input type="text" name="coupon" class="form-control" id="coupon">
        </div>
        <button type="submit" class="btn btn-default">Save</button>
        {!! Form::close() !!}
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Payment History</div>
    <div class="panel-body">
        <table class="table">
            @foreach ($user->invoices() as $invoice)
                <tr>
                    <td>Paid {{ $invoice->total() }} on
                        <small>{{ $invoice->date()->toFormattedDateString() }}</small></td>
                    <td>
                        <a href="/invoices/download/{{ $invoice->id }}" title="Download Receipt">
                            Download Receipt
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">Cancel Account</div>
    <div class="panel-body">
        {!! Form::open(['route' => 'plans.cancel', 'class' => 'form-inline']) !!}
        <p>If you wish to cancel your monthly lawn service, please click the button below.</p>
        <button type="submit" class="btn btn-danger">Cancel</button>
        {!! Form::close() !!}
    </div>
</div>

        @else
        <p>You are not currently subscribed. <a href="{{url('/plans')}}">Join now</a> </p>
    @endif
@endsection
