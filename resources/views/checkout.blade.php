@extends('layouts.master')

@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- row -->
            <div class="row">
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Billing address</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="name" placeholder="Full Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="address" id="" rows="5" style="resize: none; width:100%;border:1px solid #e4e7ed"
                                    placeholder="Address"></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /Billing Details -->
                    </div>

                    <!-- Order Details -->
                    @php
                        $items = cartArray();
                    @endphp
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach ($items as $item)
                                    <div class="order-col">
                                        <div>{{ $item['quantity'] }}x {{ $item['name'] }}</div>
                                        <div>${{ Cart::get($item['id'])->getPriceSum() }}</div>
                                    </div>
                                @endforeach
                            </div>
                            @php
                                $cartCondition = Cart::getCondition('Shipping Fee');
                            @endphp
                            <div class="order-col">
                                <div>{{ $cartCondition->getName() }}</div>
                                <div><strong>{{ $cartCondition->getValue() }}</strong></div>
                            </div>
                            @php
                                $voucher = Cart::getConditionsByType('voucher')->first();
                            @endphp
                            <div class="order-col">
                                @if ($voucher != null)
                                    <input type="hidden" name="voucher" value="{{ $voucher->getName() }}">
                                    <div>{{ $voucher->getName() }}</div>
                                    <div><strong>{{ $voucher->getValue() }}</strong></div>
                                @else
                                    <div class="input-group mb-3" style="width:100%; display:flex;">
                                        <input type="text" class="form-control" name="voucher_input" id="voucher_input"
                                            placeholder="Add Voucher" aria-label="Voucher" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button onclick="Submit()" class="btn btn-outline-secondary"
                                                type="button">Add</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">{{ Cart::getTotal() }}</strong></div>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn order-submit">Place Order</button>
                    </div>
                    <!-- /Order Details -->
                </form>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <form action="{{ route('addVoucher') }}" method="POST" id="voucher_form" style="display: none">
        @csrf
        <input type="text" name="voucher">
    </form>
    <script>
        function Submit() {
            var voucher = document.getElementById('voucher_input').value;
            document.getElementById('voucher_form').elements[1].value = voucher;
            document.getElementById('voucher_form').submit();
        }
    </script>
@endsection
