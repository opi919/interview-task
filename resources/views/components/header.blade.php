<header>
    {{-- top header --}}
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-right">
                @auth
                    <li><button class="logout" onclick="logout()"><i class="fa fa-user-o"></i>Logout</button></li>
                @else
                    <li><a href="login" class="login"><i class="fa fa-user-o"></i>Login</a></li>
                @endauth
            </ul>
        </div>
        <form action="{{ route('logout') }}" id="logout-form" method="POST">
            @csrf
        </form>
        <script>
            function logout() {
                document.getElementById('logout-form').submit();
            }
        </script>
    </div>
    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo">
                            <img src="{{ asset('electro/img/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        @auth
                            <div>
                                <a href="{{ route('order.index') }}">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Orders</span>
                                    {{-- <div class="qty">2</div> --}}
                                </a>
                            </div>
                        @endauth
                        <!-- Cart -->
                        @php
                            $items = cartArray();
                        @endphp

                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty"><?= count($items) ?></div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @foreach ($items as $item)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./electro/img/{{ $item['attributes'][0] }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">{{ $item['name'] }}</a>
                                                </h3>
                                                <h4 class="product-price"><span
                                                        class="qty">{{ $item['quantity'] }}x</span>${{ $item['price'] }}
                                                </h4>
                                            </div>
                                            <a href="{{ route('deleteFromCart', $item['id']) }}" class="delete"><i
                                                    class="fa fa-close"></i></a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cart-summary">
                                    <small><?= count($items) ?> Item(s) selected</small>
                                    <h5>SUBTOTAL: ${{ Cart::getTotal() }}</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="{{ route('checkout') }}" style="width: 100% !important">Checkout <i
                                            class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
