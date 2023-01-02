@extends('layouts.master')

@section('content')
    <div class="section">
        <div class="container" style="min-height: 50vh;">
            <div class="row" style="display: flex;justify-content:center">
                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Orders</h3>
                    </div>

                    @foreach ($orders as $order)
                        <div class="order-summary mb-5" style="border-bottom: 1px solid #dddbdb">
                            <div class="order-col">
                                <div><strong>Order No:</strong></div>
                                <div><strong>{{ $order->order_no }}</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>PRODUCTS</strong></div>
                                <div><strong></strong></div>
                            </div>
                            <div class="order-products">
                                @foreach ($order->products as $product)
                                    <div class="order-col">
                                        <div>{{ $product->pivot->quantity }}x {{ $product->name }}</div>
                                        <div>${{ $product->pivot->price }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div>Shipping Fee</div>
                                <div><strong>+100</strong></div>
                            </div>
                            @if ($order->voucher_id)
                                <div class="order-col">
                                    <div>{{ $order->voucher->code }}</div>
                                    <div><strong>-{{ $order->voucher->value }}</strong></div>
                                </div>
                            @endif
                            <div class="order-col">
                                <div>Order Status</div>
                                <div><strong>{{ $order->status }}</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">{{ $order->total }}</strong></div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- /Order Details -->
            </div>
        </div>
    </div>
@endsection
