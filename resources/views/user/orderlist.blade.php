@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: 10px">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    @foreach(\App\Order::all() as $order)
                        @if($order->user_id == Auth::user()->id)
                            <div class="card">
                                <details class="card-body">
                                    <summary class="card-header">
                                        @if($order->isHandled())
                                            <i style="color: dimgray">
                                                @endif
                                                Order
                                                @if($order->isHandled())
                                            </i>
                                        @endif
                                    </summary>

                                    <p class="card-text">
                                        Handled:
                                        @if($order->isHandled())
                                            Yes
                                        @else
                                            No
                                        @endif<br>

                                        Name: {{$order->getFullname()}}<br>
                                        Country: {{$order->getCountry()}}<br>
                                        State: {{$order->getState()}}<br>
                                        City: {{$order->getCity()}}<br>
                                        Street: {{$order->getStreet()}}<br>
                                        Zip: {{$order->getZip()}}<br>
                                        Phone: {{$order->getPhone()}}<br>
                                        <br>
                                        Products:
                                    </p>
                                    <ul>
                                        @foreach($order->getProducts() as $product => $amount)
                                            @php($product = \App\Product::find($product))
                                            <li>{{$product->getLabel()}}: {{$amount}}</li>
                                        @endforeach
                                    </ul>
                                </details>

                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
