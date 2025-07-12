<!DOCTYPE html>
<html lang="vi">

<head>
    @include('site.partials.head')
    <link rel="preload" as='style' type="text/css" href="/site/css/common.scss.css?1749442635129">
    <link rel="preload" as='style' type="text/css" href="/site/css/main.scss.css?1749442635129">
    <link rel="preload" as='style' type="text/css" href="/site/css/index.scss.css?1749442635129">
    <link rel="stylesheet" href="/site/css/common.scss.css?1749442635129">
    <link href="/site/css/main.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/header.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.theme = window.theme || {};
        theme.settings = {
            productSize: 48,
            moneyFormat: "",
            template: "index",
            lazyload: '.lazyload',
            classProduct: '.item_product_main',
            urlpage_yeuthich: 'yeu-thich',
            urlpage_comparison: 'so-sanh-san-pham',
            swatch: 'true'
        };
    </script>
    <style>
        :root {
            --mainColor: #ff6347;
            --priceColor: #ff6347;
            --middleHeaderColor: #ffffff;
            --middleHeaderTextColor: #000000;
            --topBarColor: #ffc700;
            --topBarTextColor: #000000;
            --oldColor: #ffc700;
            --backgroundColorReview: #152755;
            --oldColorReview: #ffc700;
            --backgroundColorFlashSale: #152755;
            --oldColorFlashSale: #000f36;
            --oldColorFlashSale2: #fcdb10;
            --oldColorFlashSale3: #152755;
            --backgroundColorService: #152755;
            --backgroundColorItemVoucher: #305a9b;
        }
    </style>

    @yield('css')

    <!-- Angular Js -->
    <script src="{{ asset('libs/angularjs/angular.js?v=222222') }}"></script>
    <script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
    <script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
    <script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
    <script src="{{ asset('libs/angularjs/select.js') }}"></script>
    <script src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>

    @stack('script')
    <script>
        app.controller('AppController', function($rootScope, $scope, cartItemSync, $interval, $compile) {
            $scope.currentUser = @json(Auth::guard('client')->user());
            $scope.isAdminClient = @json(Auth::guard('client')->check());
            // $scope.showMenuAdminClient = localStorage.getItem('showMenuAdminClient') ? localStorage.getItem('showMenuAdminClient') : false;

            // const currentUrl = window.location.href;
            // if (currentUrl != "{{ route('front.client-account') }}" && currentUrl != "{{ route('front.user-order') }}" && currentUrl != "{{ route('front.user-revenue') }}" && currentUrl != "{{ route('front.user-level') }}") {
            //     $scope.showMenuAdminClient = false;
            //     localStorage.removeItem('showMenuAdminClient');
            // }

            // $scope.changeMenuClient = function($event, url){
            //     $event.preventDefault();
            //     $scope.showMenuAdminClient = !$scope.showMenuAdminClient;
            //     if(url == '{{ route('front.user-order') }}' || url == '{{ route('front.user-revenue') }}' || url == '{{ route('front.user-level') }}') {
            //         $scope.showMenuAdminClient = true;
            //     }

            //     if($scope.showMenuAdminClient){
            //         localStorage.setItem('showMenuAdminClient', $scope.showMenuAdminClient);
            //         window.location.href = url;
            //     }else{
            //         localStorage.removeItem('showMenuAdminClient');
            //         window.location.href = '{{ route('front.home-page') }}';
            //     }
            // }

            // Biên dịch lại nội dung bên trong container
            // var container = angular.element(document.getElementsByClassName('item_product_main'));
            // $compile(container.contents())($scope);

            var popup = angular.element(document.getElementById('popup-cart-mobile'));
            $compile(popup.contents())($scope);

            var quickView = angular.element(document.getElementById('quick-view-product'));
            $compile(quickView.contents())($scope);

            // Đặt mua hàng
            $scope.hasItemInCart = false;
            $scope.cart = cartItemSync;
            $scope.item_qty = 1;
            $scope.quantity_quickview = 1;
            $scope.noti_product = {};

            $scope.addToCart = function(productId, quantity = 1) {
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', productId);
                let item_qty = quantity;

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(item_qty)
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            // toastr.success('Thao tác thành công !')
                            $scope.noti_product = response.noti_product;
                            $scope.$applyAsync();
                            console.log($scope.noti_product);

                            $('#popup-cart-mobile').addClass('active');
                            $('.backdrop__body-backdrop___1rvky').addClass('active');
                            $('#quick-view-product.quickview-product').hide();
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
                // if ($scope.isAdminClient) {
                // } else {
                //     window.location.href = "{{ route('front.login-client') }}";
                // }
            }

            $scope.changeQty = function(qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function(product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function(product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.item') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // xóa item trong giỏ
            $scope.removeItem = function(product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{ route('cart.remove.item') }}",
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.cart.items = response.items;
                            $scope.cart.count = Object.keys($scope.cart.items).length;
                            $scope.cart.totalCost = response.total;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            if ($scope.cart.count == 0) {
                                $scope.hasItemInCart = false;
                            }
                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        jQuery.toast.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // Xem nhanh
            $scope.quickViewProduct = {};
            $scope.showQuickView = function(productId) {
                $.ajax({
                    url: "{{ route('front.get-product-quick-view') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        $('#quick-view-product .quick-view-product').html(response.html);
                        var quickView = angular.element(document.getElementById(
                            'quick-view-product'));
                        $compile(quickView.contents())($scope);
                        $scope.$applyAsync();
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // Search product
            jQuery('#live-search').keyup(function() {
                var keyword = jQuery(this).val();
                jQuery.ajax({
                    type: 'post',
                    url: '{{ route('front.auto-search-complete') }}',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        jQuery('.live-search-results').html(data.html);
                    }
                })
            });
        })

        app.factory('cartItemSync', function($interval) {
            var cart = {
                items: null,
                total: null
            };

            cart.items = @json($cartItems);
            cart.count = {{ $cartItems->sum('quantity') }};
            cart.total = {{ $totalPriceCart }};

            return cart;
        });

        @if (Session::has('token'))
            localStorage.setItem('{{ env('prefix') }}-token', "{{ Session::get('token') }}")
        @endif
        @if (Session::has('logout'))
            localStorage.removeItem('{{ env('prefix') }}-token');
        @endif
        var CSRF_TOKEN = "{{ csrf_token() }}";
        @if (Auth::guard('client')->check())
            const DEFAULT_CLIENT_USER = {
                id: "{{ Auth::guard('client')->user()->id }}",
                fullname: "{{ Auth::guard('client')->user()->name }}"
            };
        @else
            const DEFAULT_CLIENT_USER = null;
        @endif
    </script>
</head>

<body ng-app="App" ng-controller="AppController" ng-cloak>
    @include('site.partials.header')
    <main class="bodywrap">
        @yield('content')
        @include('site.partials.footer')
    </main>
    <div class="popup-video">
        <div class="body-popup">
        </div>
        <div class="close-popup-video">
            Đóng
        </div>
    </div>
    <link rel="preload" as="style" href="/site/css/shoppingcart.scss.css?1749442635129" type="text/css">
    <link href="/site/css/shoppingcart.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <div class="backdrop__body-backdrop___1rvky"></div>
    <script type="text/javascript">
        function handleClick(event) {
            const target = event.target;
            // console.log("Clicked on:", target); // Xem phần tử nào được click

            if (target.closest('.continue-shopping') || target.matches(
                    '.backdrop__body-backdrop___1rvky, .cart-btn-close, .popup-cart-desktop-close')) {
                document.querySelectorAll('.backdrop__body-backdrop___1rvky, #popup-cart-desktop, .popup-cart-mobile')
                    .forEach(function(element) {
                        element.classList.remove('active');
                    });

                document.querySelector('.popup-search-compare').classList.remove('show');
                event.preventDefault();
                event.stopPropagation();
            }
        }

        document.addEventListener('click', handleClick);
    </script>
    <div id="popup-cart-desktop" class="popup-cart-desktop">
        <div class="cart-header">
            <div class="title">
                Giỏ hàng của bạn
            </div>
            <button class="continue-shopping" title="Đóng">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                    fill="none">
                    <path d="M7 17L16.8995 7.10051" stroke="#000000" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                    <path d="M7 7.00001L16.8995 16.8995" stroke="#000000" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
        <div class="cartPopupContainer">
            <div class="cart-content">
                <div class="cart-item d-flex" ng-repeat="item in cart.items">
                    <img ng-src="<% item.attributes.image %>" alt="<% item.name %>">
                    <div class="item-details">
                        <h3><a href="/san-pham/<% item.attributes.slug %>.html"><% item.name %></a></h3>
                        <p class="variant-title" ng-repeat="attribute in item.attributes.attributes">
                            <% attribute.name %>: <span class="value-roperties"><% attribute.value %></span>
                        </p>
                        <div class="qty-price align-items-center d-flex flex-wrap justify-content-between">
                            <div class="ajaxcart__qty d-flex align-items-center">
                                <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count"
                                    ng-click="decrementQuantity(item); changeQty(item.quantity, item.id)" data-id="<% item.id %>" aria-label="-"></button>
                                <input type="text" ng-model="item.quantity" ng-change="changeQty(item.quantity, item.id)" class="ajaxcart__qty-num number-sidebar"
                                    maxlength="3" value="<% item.quantity %>" min="0" data-id="<% item.id %>"
                                    aria-label="quantity" pattern="[0-9]*">
                                <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count"
                                    ng-click="incrementQuantity(item); changeQty(item.quantity, item.id)" data-id="<% item.id %>"
                                    aria-label="+"></button>
                            </div>
                            <p class="line-price"><% item.price | number %>₫</p>
                        </div><a class="remove-item-cart" href="javascript:;" ng-click="removeItem(item.id)">Xóa</a>
                    </div>
                </div>
            </div>
            <div class="cart-bottom">
                <div class="cart-footer d-flex justify-content-end align-items-center">
                    <div class="text-total">Tổng tiền:</div>
                    <div class="total-price"><% cart.total | number %>₫</div>
                </div>
                <div class="cart__btn-proceed-checkout-dt"><button onclick="location.href='{{ route('cart.index') }}'"
                        type="button" class="cart-view" id="cart-view" title="Giỏ hàng">Giỏ hàng</button><button
                        onclick="location.href='{{ route('cart.checkout') }}'" type="button" class="cart-checkout"
                        id="btn-proceed-checkout" title="Thanh toán ngay">Thanh toán ngay</button></div>
                <div class="continue-shopping">Hoặc tiếp tục mua hàng</div>
            </div>
        </div>
    </div>
    <div id="popup-cart-mobile" class="popup-cart-mobile">
        <div class="popup-cart-dialog">
            <div class="popup-cart-header">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.00006 15.3803C12.0761 15.3803 15.3804 12.076 15.3804 7.99995C15.3804 3.92391 12.0761 0.619629 8.00006 0.619629C3.92403 0.619629 0.619751 3.92391 0.619751 7.99995C0.619751 12.076 3.92403 15.3803 8.00006 15.3803Z"
                        fill="#2EB346"></path>
                    <path
                        d="M8 16C3.58916 16 0 12.4115 0 8C0 3.58916 3.58916 0 8 0C12.4115 0 16 3.58916 16 8C16 12.4115 12.4115 16 8 16ZM8 1.23934C4.27203 1.23934 1.23934 4.27203 1.23934 8C1.23934 11.728 4.27203 14.7607 8 14.7607C11.728 14.7607 14.7607 11.7273 14.7607 8C14.7607 4.27203 11.728 1.23934 8 1.23934Z"
                        fill="#2EB346"></path>
                    <path
                        d="M7.03336 10.9434C6.8673 10.9434 6.70865 10.8771 6.59152 10.7582L4.30493 8.43438C4.06511 8.19023 4.06821 7.7986 4.31236 7.55816C4.55652 7.31898 4.94877 7.32145 5.18858 7.5656L7.0154 9.42213L10.7948 5.25979C11.0259 5.00635 11.4176 4.98838 11.6698 5.21766C11.9232 5.44757 11.9418 5.8392 11.7119 6.09326L7.49193 10.7408C7.3773 10.8672 7.21618 10.9403 7.04577 10.944C7.04143 10.9434 7.03771 10.9434 7.03336 10.9434Z"
                        fill="white"></path>
                </svg>
                Thêm vào giỏ hàng thành công
                <a title="Đóng" class="popup-cart-close iconclose">
                    ×
                </a>
            </div>
            <div class="popup-cart-content d-flex">
                <div class="product-cart-thumb">
                    <img ng-src="<% noti_product.product_image %>" alt="<% noti_product.product_name %>">
                </div>
                <div class="product-cart-info">
                    <h4 class="product-title"><% noti_product.product_name %></h4>
                    <div class="product-new-price">
                        <b><% noti_product.product_price | number %>₫</b>
                        {{-- <span><% noti_product.product_attribute %></span> --}}
                    </div>
                    <span class="product-qua-tang"></span>
                    <span class="product-alias"></span>
                </div>
            </div>
            <a class="popup-cart-noti" href="{{ route('cart.index') }}" title="Giỏ hàng">
                Giỏ hàng của bạn hiện có <span class="count_item_pr"><% cart.count %></span> sản phẩm
            </a>
            <div class="popup-cart-footer d-flex">
                <div class="popup-cart-close continue-shopping">
                    Tiếp tục mua hàng
                </div>
                <a href="{{ route('cart.checkout') }}" class="pay-now">
                    Thanh toán ngay
                </a>
            </div>
        </div>
    </div>
    <link rel="preload" as="script" href="/site/js/index.js?1749442635129" />
    <script src="/site/js/index.js?1749442635129" type="text/javascript"></script>
    <link rel="preload" as="script" href="/site/js/main.js?1749442635129" />
    <link rel="preload" as="script" href="/site/js/swatch-func.js?1749442635129" />
    <script src="/site/js/main.js?1749442635129" type="text/javascript"></script>
    <script src="/site/js/swatch-func.js?1749442635129" type="text/javascript"></script>
    <link rel="preload" href="/site/js/wishlist.js?1749442635129" as="script">
    <script src="/site/js/wishlist.js?1749442635129" type="text/javascript"></script>
    <link rel="preload" href="/site/js/compare.js?1749442635129" as="script">
    <script src="/site/js/compare.js?1749442635129" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <div class="popup-compare">
        <span class="mini-compare" onclick="collapseCompare()">Thu gọn</span>
        <div id="list-compare" class="list-compare">
        </div>
        <div class="bottom-compare">
            <a href="/so-sanh-san-pham" title="So sánh ngay" class="button-go-compare">So sánh ngay</a>
            <a href="javascript:;" onclick="removeAllCompare()" class="remove-all" title="Xóa tất cả sản phẩm">Xóa
                tất cả sản phẩm</a>
        </div>
    </div>
    <div class="popup-search-compare"></div>
    <div style="visibility:hidden; position: absolute; z-index: -1; bottom: 0; left: 0;">
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="IconTikTok">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" version="1.1">
                    <path
                        d="M16.656 1.029c1.637-0.025 3.262-0.012 4.886-0.025 0.054 2.031 0.878 3.859 2.189 5.213l-0.002-0.002c1.411 1.271 3.247 2.095 5.271 2.235l0.028 0.002v5.036c-1.912-0.048-3.71-0.489-5.331-1.247l0.082 0.034c-0.784-0.377-1.447-0.764-2.077-1.196l0.052 0.034c-0.012 3.649 0.012 7.298-0.025 10.934-0.103 1.853-0.719 3.543-1.707 4.954l0.020-0.031c-1.652 2.366-4.328 3.919-7.371 4.011l-0.014 0c-0.123 0.006-0.268 0.009-0.414 0.009-1.73 0-3.347-0.482-4.725-1.319l0.040 0.023c-2.508-1.509-4.238-4.091-4.558-7.094l-0.004-0.041c-0.025-0.625-0.037-1.25-0.012-1.862 0.49-4.779 4.494-8.476 9.361-8.476 0.547 0 1.083 0.047 1.604 0.136l-0.056-0.008c0.025 1.849-0.050 3.699-0.050 5.548-0.423-0.153-0.911-0.242-1.42-0.242-1.868 0-3.457 1.194-4.045 2.861l-0.009 0.030c-0.133 0.427-0.21 0.918-0.21 1.426 0 0.206 0.013 0.41 0.037 0.61l-0.002-0.024c0.332 2.046 2.086 3.59 4.201 3.59 0.061 0 0.121-0.001 0.181-0.004l-0.009 0c1.463-0.044 2.733-0.831 3.451-1.994l0.010-0.018c0.267-0.372 0.45-0.822 0.511-1.311l0.001-0.014c0.125-2.237 0.075-4.461 0.087-6.698 0.012-5.036-0.012-10.060 0.025-15.083z" />
                </svg>
            </symbol>
            <symbol id="IconClose">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 0 25 25">
                    <path d="M3 21.32L21 3.32001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                    <path d="M3 3.32001L21 21.32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </symbol>
            <symbol id="iconSettings">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18"
                    fill="none">
                    <path d="M2.45044 6.00006C5.96516 6.00006 7.93572 6.00006 11.4504 6.00006" stroke="#FFF1C1"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M13.8203 8.20599C15.063 8.20599 16.0703 7.19863 16.0703 5.95599C16.0703 4.71335 15.063 3.70599 13.8203 3.70599C12.5777 3.70599 11.5703 4.71335 11.5703 5.95599C11.5703 7.19863 12.5777 8.20599 13.8203 8.20599Z"
                        stroke="#FFC700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M2.45044 6.00006C5.96516 6.00006 7.93572 6.00006 11.4504 6.00006" stroke="#FFF1C1"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M13.8203 8.20599C15.063 8.20599 16.0703 7.19863 16.0703 5.95599C16.0703 4.71335 15.063 3.70599 13.8203 3.70599C12.5777 3.70599 11.5703 4.71335 11.5703 5.95599C11.5703 7.19863 12.5777 8.20599 13.8203 8.20599Z"
                        stroke="#FFC700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.071 12.2567C12.5563 12.2567 10.5858 12.2567 7.07104 12.2567" stroke="#FFF1C1"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M4.70117 14.4626C3.45853 14.4626 2.45117 13.4553 2.45117 12.2126C2.45117 10.97 3.45853 9.96265 4.70117 9.96265C5.94381 9.96265 6.95117 10.97 6.95117 12.2126C6.95117 13.4553 5.94381 14.4626 4.70117 14.4626Z"
                        stroke="#FFC700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </symbol>
            <symbol id="iconDetail">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18"
                    fill="none">
                    <path
                        d="M2.41495 9.53488C2.31281 9.37315 2.26174 9.29229 2.23315 9.16756C2.21167 9.07388 2.21167 8.92612 2.23315 8.83244C2.26174 8.70771 2.31281 8.62685 2.41495 8.46512C3.259 7.12863 5.7714 3.75 9.60016 3.75C13.4289 3.75 15.9413 7.12863 16.7854 8.46512C16.8875 8.62685 16.9386 8.70771 16.9672 8.83244C16.9886 8.92612 16.9886 9.07388 16.9672 9.16756C16.9386 9.29229 16.8875 9.37315 16.7854 9.53488C15.9413 10.8714 13.4289 14.25 9.60016 14.25C5.7714 14.25 3.259 10.8714 2.41495 9.53488Z"
                        stroke="#FFC700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M9.60016 11.25C10.8428 11.25 11.8502 10.2426 11.8502 9C11.8502 7.75736 10.8428 6.75 9.60016 6.75C8.35751 6.75 7.35016 7.75736 7.35016 9C7.35016 10.2426 8.35751 11.25 9.60016 11.25Z"
                        stroke="#FFC700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M9.60016 3.75C5.7714 3.75 3.259 7.12863 2.41495 8.46512C2.31281 8.62685 2.26174 8.70771 2.23315 8.83244C2.21167 8.92613 2.21167 9.07387 2.23315 9.16756C2.26174 9.29229 2.31281 9.37315 2.41495 9.53488C3.259 10.8714 5.7714 14.25 9.60016 14.25C13.4289 14.25 15.9413 10.8714 16.7854 9.53488C16.8875 9.37315 16.9386 9.29229 16.9672 9.16756C16.9886 9.07387 16.9886 8.92613 16.9672 8.83244C16.9386 8.70771 16.8875 8.62685 16.7854 8.46512C15.9413 7.12863 13.4289 3.75 9.60016 3.75Z"
                        stroke="#FFF1C1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </symbol>
            <symbol id="iconSoldout">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34"
                    fill="none">
                    <circle cx="17.7998" cy="17" r="15" fill="var(--mainColor)" />
                    <circle cx="17.7998" cy="17" r="10.25" stroke="#FFF1C1" stroke-width="1.5" />
                    <rect x="27.4124" y="1.35754" width="11.2922" height="35.3314" rx="2"
                        transform="rotate(48.1792 27.4124 1.35754)" fill="var(--mainColor)" stroke="#FFF1C1"
                        stroke-width="1.5" />
                    <path
                        d="M9.32408 28.6173C8.50611 29.3463 7.68097 29.4421 7.10845 28.8614L7.06727 28.8196L7.94866 28.034L7.96644 28.0495C8.12648 28.1895 8.41935 28.1482 8.70149 27.8967C8.97924 27.6492 9.04457 27.379 8.89837 27.215L8.89642 27.2128C8.76192 27.0619 8.58829 27.1225 8.17988 27.3688L7.81012 27.5924C7.01907 28.0698 6.43946 28.0095 5.99112 27.5065L5.98917 27.5043C5.41217 26.8569 5.59637 25.9628 6.34434 25.2961C7.18855 24.5437 7.9776 24.5704 8.55251 25.1097L8.57614 25.1318L7.72537 25.8901L7.69955 25.87C7.51494 25.7245 7.2425 25.7711 6.9888 25.9972C6.73292 26.2252 6.70111 26.4537 6.82976 26.5981L6.83171 26.6003C6.97206 26.7577 7.17394 26.7112 7.54151 26.4896L7.91126 26.266C8.70231 25.7886 9.26334 25.7752 9.73312 26.3022L9.73507 26.3044C10.3257 26.9671 10.1945 27.8415 9.32408 28.6173ZM12.7272 25.5842C11.7583 26.4477 10.5738 26.3692 9.65373 25.3369L9.64983 25.3326C8.73366 24.3047 8.79386 23.1129 9.75836 22.2533C10.7229 21.3936 11.9115 21.4723 12.8276 22.5002L12.8315 22.5046C13.7516 23.5369 13.6917 24.7245 12.7272 25.5842ZM12.0527 24.8274C12.4332 24.4883 12.3799 23.9 11.8867 23.3467L11.8828 23.3423C11.3916 22.7912 10.8134 22.6708 10.4328 23.01C10.0501 23.3511 10.1034 23.9393 10.5946 24.4905L10.5985 24.4948C11.0917 25.0482 11.67 25.1686 12.0527 24.8274ZM14.8078 23.5727L11.995 20.4168L12.9223 19.5903L15.0802 22.0113L16.3662 20.8652L17.0211 21.6L14.8078 23.5727ZM17.5941 21.0893L14.7813 17.9334L16.181 16.6858C17.1236 15.8456 18.1441 15.9251 19.0213 16.9092L19.0252 16.9136C19.9589 17.9612 19.9474 18.9918 18.9939 19.8417L17.5941 21.0893ZM17.8665 19.5279L18.1574 19.2687C18.621 18.8554 18.6126 18.3528 18.096 17.7732L18.0921 17.7688C17.6204 17.2396 17.1006 17.1848 16.6545 17.5824L16.3636 17.8417L17.8665 19.5279ZM23.5969 15.8961C22.628 16.7596 21.4435 16.6812 20.5235 15.6489L20.5196 15.6445C19.6034 14.6166 19.6636 13.4248 20.6281 12.5652C21.5926 11.7056 22.7812 11.7842 23.6974 12.8122L23.7013 12.8165C24.6213 13.8488 24.5614 15.0365 23.5969 15.8961ZM22.9224 15.1394C23.303 14.8002 23.2496 14.212 22.7565 13.6586L22.7526 13.6543C22.2613 13.1031 21.6831 12.9827 21.3026 13.3219C20.9198 13.6631 20.9732 14.2513 21.4644 14.8024L21.4683 14.8068C21.9615 15.3601 22.5397 15.4805 22.9224 15.1394ZM27.1443 12.7343C26.311 13.477 25.3442 13.5107 24.7048 12.7933L22.8647 10.7287L23.792 9.90221L25.5503 11.8749C25.8446 12.2052 26.1702 12.2447 26.472 11.9757C26.7739 11.7066 26.772 11.3787 26.4776 11.0484L24.7193 9.0757L25.6467 8.24919L27.4868 10.3138C28.1223 11.0268 27.9885 11.9819 27.1443 12.7343ZM29.8964 10.1244L27.7385 7.70335L26.8615 8.48503L26.2065 7.75017L28.8879 5.36032L29.5429 6.09518L28.6658 6.87685L30.8237 9.29793L29.8964 10.1244Z"
                        fill="#FFC700" />
                </svg>
            </symbol>
            <symbol id="iconAddCart">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19"
                    fill="none">
                    <path
                        d="M4.29185 11.5H13.5963C14.3137 11.5 14.6724 11.5 14.958 11.3584C15.2096 11.2336 15.4209 11.0333 15.5658 10.7824C15.7303 10.4975 15.7699 10.12 15.8491 9.36504L16.2635 5.41626C16.2877 5.18566 16.2998 5.07036 16.2648 4.98112C16.234 4.90274 16.1791 4.83773 16.1089 4.79671C16.029 4.75 15.9194 4.75 15.7003 4.75H3.93768M2.16675 2.5H3.05106C3.2385 2.5 3.33222 2.5 3.40554 2.53774C3.47009 2.57097 3.52359 2.62418 3.55893 2.69032C3.59908 2.76545 3.60493 2.86449 3.61662 3.06257L4.25854 13.9374C4.27023 14.1355 4.27608 14.2345 4.31623 14.3097C4.35158 14.3758 4.40507 14.429 4.46962 14.4623C4.54294 14.5 4.63666 14.5 4.8241 14.5H14.2084M6.06258 17.125H6.06967M12.4376 17.125H12.4447M6.41675 17.125C6.41675 17.3321 6.25818 17.5 6.06258 17.5C5.86698 17.5 5.70841 17.3321 5.70841 17.125C5.70841 16.9179 5.86698 16.75 6.06258 16.75C6.25818 16.75 6.41675 16.9179 6.41675 17.125ZM12.7917 17.125C12.7917 17.3321 12.6332 17.5 12.4376 17.5C12.242 17.5 12.0834 17.3321 12.0834 17.125C12.0834 16.9179 12.242 16.75 12.4376 16.75C12.6332 16.75 12.7917 16.9179 12.7917 17.125Z"
                        stroke="#FFF1C1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                    <g clip-path="url(#clip0_873_4556)">
                        <path
                            d="M10.0999 1.30005V6.10005M10.0999 6.10005L11.7999 4.30005M10.0999 6.10005L8.3999 4.30005"
                            stroke="#152755" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </g>
                    <g clip-path="url(#clip1_873_4556)">
                        <path
                            d="M10.0999 1.30005V6.10005M10.0999 6.10005L11.7999 4.30005M10.0999 6.10005L8.3999 4.30005"
                            stroke="#FFC700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </g>
                    <defs>
                        <clipPath id="clip0_873_4556">
                            <rect width="6.8" height="7.2" fill="white"
                                transform="translate(6.69995 0.100006)"></rect>
                        </clipPath>
                        <clipPath id="clip1_873_4556">
                            <rect width="6.8" height="7.2" fill="white"
                                transform="translate(6.69995 0.100006)"></rect>
                        </clipPath>
                    </defs>
                </svg>
            </symbol>
            <symbol id="iconMinus">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M400 288h-352c-17.69 0-32-14.32-32-32.01s14.31-31.99 32-31.99h352c17.69 0 32 14.3 32 31.99S417.7 288 400 288z" />
                </svg>
            </symbol>
            <symbol id="iconPlus">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z">
                    </path>
                </svg>
            </symbol>
            <symbol id="iconAddressContact">
                <svg viewBox="0 0 44 55" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.0001 0.0769043C33.6644 0.0769043 43.154 9.56645 43.154 21.2307C43.154 26.897 39.7211 34.1734 32.9508 42.8571C29.849 46.8253 26.49 50.5854 22.8953 54.1133C22.6543 54.3438 22.3336 54.4725 22.0001 54.4725C21.6666 54.4725 21.346 54.3438 21.105 54.1133C17.5103 50.5854 14.1513 46.8253 11.0495 42.8571C4.27916 34.1734 0.846298 26.897 0.846298 21.2307C0.846298 9.56645 10.3358 0.0769043 22.0001 0.0769043ZM22.0001 36.3406C30.3322 36.3406 37.11 29.5628 37.11 21.2307C37.11 12.8987 30.3322 6.12086 22.0001 6.12086C13.6681 6.12086 6.89025 12.8987 6.89025 21.2307C6.89025 29.5628 13.6681 36.3406 22.0001 36.3406Z" />
                    <path
                        d="M11.6309 19.4088L21.1286 10.7746C21.367 10.5579 21.6776 10.4378 21.9998 10.4378C22.3219 10.4378 22.6326 10.5579 22.8709 10.7746L32.3686 19.4088C32.5899 19.6101 32.7347 19.8816 32.7786 20.1775C32.8225 20.4733 32.7626 20.7752 32.6093 21.032C32.4883 21.2275 32.3187 21.3883 32.1171 21.4987C31.9154 21.6092 31.6886 21.6655 31.4588 21.6623H30.2023V29.8648C30.2023 30.2083 30.0658 30.5377 29.8229 30.7806C29.58 31.0235 29.2506 31.1599 28.9071 31.1599H25.8852C25.5417 31.1599 25.2122 31.0235 24.9694 30.7806C24.7265 30.5377 24.59 30.2083 24.59 29.8648V25.116C24.59 24.7725 24.4536 24.443 24.2107 24.2002C23.9678 23.9573 23.6384 23.8208 23.2949 23.8208H20.7046C20.3611 23.8208 20.0317 23.9573 19.7888 24.2002C19.5459 24.443 19.4095 24.7725 19.4095 25.116V29.8648C19.4095 30.2083 19.273 30.5377 19.0302 30.7806C18.7873 31.0235 18.4578 31.1599 18.1144 31.1599H15.0924C14.7489 31.1599 14.4195 31.0235 14.1766 30.7806C13.9337 30.5377 13.7972 30.2083 13.7972 29.8648V21.6623H12.5407C12.3109 21.6655 12.0841 21.6092 11.8824 21.4987C11.6808 21.3883 11.5112 21.2275 11.3902 21.032C11.2369 20.7752 11.1771 20.4733 11.2209 20.1775C11.2648 19.8816 11.4096 19.6101 11.6309 19.4088Z" />
                </svg>
            </symbol>
            <symbol id="iconPhoneContact">
                <svg viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.5318 24.4683C13.6774 20.6139 12.8071 16.7595 12.6107 15.2153C12.5558 14.7883 12.7028 14.3601 13.0083 14.0567L16.1274 10.9389C16.5863 10.4804 16.6677 9.76575 16.3238 9.21574L11.3575 1.50416C10.977 0.895119 10.1958 0.67531 9.55351 0.996597L1.58084 4.75143C1.06149 5.00717 0.75601 5.55897 0.814977 6.13487C1.23272 10.1034 2.96288 19.8592 12.5501 29.4471C22.1374 39.0351 31.8918 40.7646 35.8624 41.1823C36.4383 41.2413 36.9901 40.9358 37.2459 40.4164L41.0007 32.4438C41.3208 31.8029 41.1024 31.0238 40.4959 30.6426L32.7843 25.6777C32.2346 25.3334 31.52 25.4143 31.0611 25.8726L27.9434 28.9918C27.64 29.2973 27.2118 29.4442 26.7848 29.3894C25.2405 29.193 21.3862 28.3227 17.5318 24.4683Z" />
                    <path
                        d="M30.7486 0.807693C24.9809 0.807693 20.305 4.85982 20.305 9.85884C20.3144 11.6931 20.9396 13.4709 22.0804 14.9073L21.0012 20.3025L26.4765 18.1121C27.8386 18.641 29.2874 18.9116 30.7486 18.91C36.5163 18.91 41.1922 14.8579 41.1922 9.85884C41.1922 4.85982 36.5163 0.807693 30.7486 0.807693ZM25.1787 11.2513C24.4096 11.2513 23.7862 10.6279 23.7862 9.85884C23.7862 9.0898 24.4096 8.46636 25.1787 8.46636C25.9477 8.46636 26.5711 9.0898 26.5711 9.85884C26.5711 10.6279 25.9477 11.2513 25.1787 11.2513ZM30.7486 11.2513C29.9796 11.2513 29.3561 10.6279 29.3561 9.85884C29.3561 9.0898 29.9796 8.46636 30.7486 8.46636C31.5177 8.46636 32.1411 9.0898 32.1411 9.85884C32.1411 10.6279 31.5177 11.2513 30.7486 11.2513ZM36.3185 11.2513C35.5495 11.2513 34.9261 10.6279 34.9261 9.85884C34.9261 9.0898 35.5495 8.46636 36.3185 8.46636C37.0876 8.46636 37.711 9.0898 37.711 9.85884C37.711 10.6279 37.0876 11.2513 36.3185 11.2513Z" />
                </svg>
            </symbol>
            <symbol id="iconEmailContact">
                <svg viewBox="0 0 45 38" xmlns="http://www.w3.org/2000/svg">
                    <path d="M38.4482 9.05962V16.9539L43.8375 12.8161L38.4482 9.05962Z" />
                    <path d="M6.873 9.05962L1.4837 12.8161L6.873 16.9539V9.05962Z" />
                    <path
                        d="M36.8153 18.2064V0.730789H8.50579V18.2064L22.6605 29.0945L36.8153 18.2064ZM13.9503 6.17532H18.8499C19.3011 6.17532 19.6668 6.54107 19.6668 6.99226C19.6668 7.44345 19.3011 7.8092 18.8499 7.8092H13.9503C13.4991 7.8092 13.1334 7.44345 13.1334 6.99226C13.1334 6.54107 13.4991 6.17532 13.9503 6.17532ZM13.9503 11.0738H31.3707C31.8219 11.0738 32.1877 11.4396 32.1877 11.8908C32.1877 12.342 31.8219 12.7077 31.3707 12.7077H13.9503C13.4991 12.7077 13.1334 12.342 13.1334 11.8908C13.1334 11.4396 13.4991 11.0738 13.9503 11.0738ZM13.1334 16.7903C13.1334 16.3391 13.4991 15.9734 13.9503 15.9734H31.3707C31.8219 15.9734 32.1877 16.3391 32.1877 16.7903C32.1877 17.2415 31.8219 17.6073 31.3707 17.6073H13.9503C13.4991 17.6073 13.1334 17.2415 13.1334 16.7903Z" />
                    <path d="M0.884613 14.3405V37.2055L16.6722 26.5353L0.884613 14.3405Z" />
                    <path d="M28.649 26.5353L44.4366 37.2055V14.3405L28.649 26.5353Z" />
                    <path
                        d="M23.1506 30.7273C22.8599 30.9451 22.4608 30.9451 22.1711 30.7273L18.0885 27.6242L2.95324 37.7505H42.3675L27.2874 27.57L23.1506 30.7273Z" />
                </svg>
            </symbol>
            <symbol id="iconQuickview">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 21 21"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.0556 2.5748C5.47649 2.5748 2.57505 5.47625 2.57505 9.05536C2.57505 12.6345 5.47649 15.5359 9.0556 15.5359C10.7209 15.5359 12.2394 14.9078 13.3873 13.8756L13.8758 13.3871C14.9081 12.2392 15.5362 10.7206 15.5362 9.05536C15.5362 5.47625 12.6347 2.5748 9.0556 2.5748ZM15.8712 14.3507C17.0087 12.8888 17.6862 11.0512 17.6862 9.05536C17.6862 4.28884 13.8221 0.424805 9.0556 0.424805C4.28908 0.424805 0.425049 4.28884 0.425049 9.05536C0.425049 13.8219 4.28908 17.6859 9.0556 17.6859C11.0514 17.6859 12.889 17.0085 14.3509 15.871L18.5 20.0201L20.0203 18.4998L15.8712 14.3507Z"
                        fill="#FFF1C1"></path>
                </svg>
            </symbol>
            <symbol id="iconDate">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V11.6893L15.0303 13.9697C15.3232 14.2626 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2626 15.3232 13.9697 15.0303L11.8358 12.8964C11.5468 12.6074 11.4022 12.4629 11.3261 12.2791C11.25 12.0954 11.25 11.891 11.25 11.4822V8C11.25 7.58579 11.5858 7.25 12 7.25Z"
                        fill="#231f20" />
                </svg>
            </symbol>
            <symbol id="iconAuthor">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9 6.25C7.48122 6.25 6.25 7.48122 6.25 9C6.25 10.5188 7.48122 11.75 9 11.75C10.5188 11.75 11.75 10.5188 11.75 9C11.75 7.48122 10.5188 6.25 9 6.25ZM7.75 9C7.75 8.30965 8.30965 7.75 9 7.75C9.69036 7.75 10.25 8.30965 10.25 9C10.25 9.69036 9.69036 10.25 9 10.25C8.30965 10.25 7.75 9.69036 7.75 9Z"
                        fill="#231f20" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9 12.25C7.80424 12.25 6.68461 12.4907 5.83616 12.915C5.03258 13.3168 4.25 14.0106 4.25 15L4.24987 15.0625C4.24834 15.5728 4.24576 16.4322 5.06023 17.0218C5.43818 17.2953 5.9369 17.4698 6.55469 17.581C7.1782 17.6932 7.97721 17.75 9 17.75C10.0228 17.75 10.8218 17.6932 11.4453 17.581C12.0631 17.4698 12.5618 17.2953 12.9398 17.0218C13.7542 16.4322 13.7517 15.5728 13.7501 15.0625L13.75 15C13.75 14.0106 12.9674 13.3168 12.1638 12.915C11.3154 12.4907 10.1958 12.25 9 12.25ZM5.75 15C5.75 14.8848 5.86285 14.5787 6.50698 14.2566C7.10625 13.957 7.98662 13.75 9 13.75C10.0134 13.75 10.8937 13.957 11.493 14.2566C12.1371 14.5787 12.25 14.8848 12.25 15C12.25 15.6045 12.2115 15.6972 12.0602 15.8067C11.9382 15.895 11.6869 16.0134 11.1797 16.1047C10.6782 16.1949 9.97721 16.25 9 16.25C8.02279 16.25 7.3218 16.1949 6.82031 16.1047C6.31311 16.0134 6.06182 15.895 5.93977 15.8067C5.78849 15.6972 5.75 15.6045 5.75 15Z"
                        fill="#231f20" />
                    <path
                        d="M19 12.75C19.4142 12.75 19.75 12.4142 19.75 12C19.75 11.5858 19.4142 11.25 19 11.25H15C14.5858 11.25 14.25 11.5858 14.25 12C14.25 12.4142 14.5858 12.75 15 12.75H19Z"
                        fill="#231f20" />
                    <path
                        d="M19.75 9C19.75 9.41422 19.4142 9.75 19 9.75H14C13.5858 9.75 13.25 9.41422 13.25 9C13.25 8.58579 13.5858 8.25 14 8.25H19C19.4142 8.25 19.75 8.58579 19.75 9Z"
                        fill="#231f20" />
                    <path
                        d="M19 15.75C19.4142 15.75 19.75 15.4142 19.75 15C19.75 14.5858 19.4142 14.25 19 14.25H16C15.5858 14.25 15.25 14.5858 15.25 15C15.25 15.4142 15.5858 15.75 16 15.75H19Z"
                        fill="#231f20" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.94358 3.25H14.0564C15.8942 3.24998 17.3498 3.24997 18.489 3.40314C19.6614 3.56076 20.6104 3.89288 21.3588 4.64124C22.1071 5.38961 22.4392 6.33856 22.5969 7.51098C22.75 8.65018 22.75 10.1058 22.75 11.9435V12.0564C22.75 13.8942 22.75 15.3498 22.5969 16.489C22.4392 17.6614 22.1071 18.6104 21.3588 19.3588C20.6104 20.1071 19.6614 20.4392 18.489 20.5969C17.3498 20.75 15.8942 20.75 14.0565 20.75H9.94359C8.10585 20.75 6.65018 20.75 5.51098 20.5969C4.33856 20.4392 3.38961 20.1071 2.64124 19.3588C1.89288 18.6104 1.56076 17.6614 1.40314 16.489C1.24997 15.3498 1.24998 13.8942 1.25 12.0564V11.9436C1.24998 10.1058 1.24997 8.65019 1.40314 7.51098C1.56076 6.33856 1.89288 5.38961 2.64124 4.64124C3.38961 3.89288 4.33856 3.56076 5.51098 3.40314C6.65019 3.24997 8.10583 3.24998 9.94358 3.25ZM5.71085 4.88976C4.70476 5.02503 4.12511 5.27869 3.7019 5.7019C3.27869 6.12511 3.02503 6.70476 2.88976 7.71085C2.75159 8.73851 2.75 10.0932 2.75 12C2.75 13.9068 2.75159 15.2615 2.88976 16.2892C3.02503 17.2952 3.27869 17.8749 3.7019 18.2981C4.12511 18.7213 4.70476 18.975 5.71085 19.1102C6.73851 19.2484 8.09318 19.25 10 19.25H14C15.9068 19.25 17.2615 19.2484 18.2892 19.1102C19.2952 18.975 19.8749 18.7213 20.2981 18.2981C20.7213 17.8749 20.975 17.2952 21.1102 16.2892C21.2484 15.2615 21.25 13.9068 21.25 12C21.25 10.0932 21.2484 8.73851 21.1102 7.71085C20.975 6.70476 20.7213 6.12511 20.2981 5.7019C19.8749 5.27869 19.2952 5.02503 18.2892 4.88976C17.2615 4.75159 15.9068 4.75 14 4.75H10C8.09318 4.75 6.73851 4.75159 5.71085 4.88976Z"
                        fill="#231f20" />
                </svg>
            </symbol>
            <symbol id="iconMap">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                    <g id="maps">
                        <path id="icon" fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.5 18.4675L10.0207 18.0128C14.3994 14.1895 16.625 10.851 16.625 7.9165C16.625 3.76078 13.3815 0.791504 9.5 0.791504C5.6185 0.791504 2.375 3.76078 2.375 7.9165C2.375 10.851 4.60062 14.1895 8.9793 18.0128L9.5 18.4675ZM9.5 16.3584C5.7844 13.0097 3.95833 10.1721 3.95833 7.9165C3.95833 4.66798 6.46326 2.37484 9.5 2.37484C12.5367 2.37484 15.0417 4.66798 15.0417 7.9165C15.0417 10.1721 13.2156 13.0097 9.5 16.3584ZM9.5 3.95817C11.6861 3.95817 13.4583 5.73038 13.4583 7.9165C13.4583 10.1026 11.6861 11.8748 9.5 11.8748C7.31387 11.8748 5.54167 10.1026 5.54167 7.9165C5.54167 5.73038 7.31387 3.95817 9.5 3.95817ZM7.125 7.9165C7.125 6.60483 8.18832 5.5415 9.5 5.5415C10.8117 5.5415 11.875 6.60483 11.875 7.9165C11.875 9.22818 10.8117 10.2915 9.5 10.2915C8.18832 10.2915 7.125 9.22818 7.125 7.9165Z" />
                    </g>
                </svg>
            </symbol>
            <symbol id="iconCall">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                    <g id="call">
                        <path id="icon2" fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.59479 6.6008C9.00495 6.04805 9.15203 5.4655 8.68815 4.95129C7.64714 3.49464 6.94704 2.59385 6.5079 2.16005C5.67304 1.33535 4.29968 1.4469 3.57663 2.15935C3.18828 2.54201 3.0568 2.67342 2.65804 3.07844C0.436904 5.30077 1.79147 9.99871 5.3924 13.6032C8.99251 17.2068 13.69 18.5621 15.9158 16.3351C16.2838 15.9804 16.5953 15.6686 16.841 15.4089C17.5496 14.66 17.6572 13.3472 16.8364 12.4944C16.4155 12.0571 15.5566 11.3908 14.0386 10.305C13.5737 9.88933 13.0225 9.97942 12.5171 10.311C12.274 10.4705 12.0971 10.6318 11.7631 10.9662L11.1565 11.5731C11.0766 11.6531 9.99166 11.1097 8.93853 10.0556C7.88483 9.00084 7.34188 7.91588 7.42141 7.83637L8.02844 7.229C8.13442 7.12291 8.18509 7.07155 8.25007 7.00326C8.38545 6.86097 8.49754 6.73185 8.59479 6.6008ZM12.2754 12.6927L12.8822 12.0856C13.066 11.9016 13.1852 11.7885 13.2821 11.7104C14.6118 12.6654 15.3819 13.2658 15.6965 13.5926C15.8853 13.7889 15.856 14.1469 15.6918 14.3205C15.4646 14.5606 15.1694 14.8559 14.8072 15.2053C13.3679 16.6452 9.57597 15.5512 6.51161 12.4838C3.44629 9.4155 2.35279 5.623 3.7812 4.1938C4.17836 3.79044 4.30418 3.66468 4.687 3.28748C4.83053 3.14605 5.2215 3.11429 5.39611 3.28677C5.7342 3.62076 6.36136 4.42378 7.28394 5.70893C7.23618 5.76822 7.17653 5.83523 7.10394 5.91153C7.05066 5.96752 7.00627 6.01252 6.90922 6.10966L6.30279 6.71642C5.27113 7.748 6.14973 9.50369 7.81932 11.1749C9.48776 12.845 11.2441 13.7246 12.2754 12.6927ZM10.8103 1.63827C14.2329 2.05313 16.9468 4.767 17.3616 8.18963L15.7977 8.45028C15.4958 5.6934 13.3065 3.50411 10.5496 3.20215L10.8103 1.63827ZM10.2887 4.76739C12.38 4.95443 14.0455 6.61994 14.2325 8.71115L12.6636 8.97263C12.597 7.54693 11.453 6.40288 10.0273 6.3363L10.2887 4.76739Z" />
                    </g>
                </svg>
            </symbol>
            <symbol id="iconMail">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                    <g id="mail">
                        <path id="icon3" fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.375 2.375H16.625C17.4995 2.375 18.2083 3.08388 18.2083 3.95833V15.0417C18.2083 15.9161 17.4995 16.625 16.625 16.625H2.375C1.50055 16.625 0.791668 15.9161 0.791668 15.0417V3.95833C0.791668 3.08388 1.50055 2.375 2.375 2.375ZM2.375 7.61433V15.0417H16.625V7.61467L9.49998 11.1772L2.375 7.61433ZM2.375 5.84408L9.50002 9.40694L16.625 5.84445V3.95833H2.375V5.84408Z" />
                    </g>
                </svg>
            </symbol>
            <symbol id="iconMessFaceBook">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M256.55 8C116.52 8 8 110.34 8 248.57c0 72.3 29.71 134.78 78.07 177.94 8.35 7.51 6.63 11.86 8.05 58.23A19.92 19.92 0 0 0 122 502.31c52.91-23.3 53.59-25.14 62.56-22.7C337.85 521.8 504 423.7 504 248.57 504 110.34 396.59 8 256.55 8zm149.24 185.13l-73 115.57a37.37 37.37 0 0 1-53.91 9.93l-58.08-43.47a15 15 0 0 0-18 0l-78.37 59.44c-10.46 7.93-24.16-4.6-17.11-15.67l73-115.57a37.36 37.36 0 0 1 53.91-9.93l58.06 43.46a15 15 0 0 0 18 0l78.41-59.38c10.44-7.98 24.14 4.54 17.09 15.62z">
                    </path>
                </svg>
            </symbol>
            <symbol id="iconSearch">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.74762 1.97143C5.45295 1.97143 1.97143 5.45295 1.97143 9.74762C1.97143 14.0423 5.45295 17.5238 9.74762 17.5238C14.0423 17.5238 17.5238 14.0423 17.5238 9.74762C17.5238 5.45295 14.0423 1.97143 9.74762 1.97143ZM0 9.74762C0 4.36416 4.36416 0 9.74762 0C15.1311 0 19.4952 4.36416 19.4952 9.74762C19.4952 15.1311 15.1311 19.4952 9.74762 19.4952C4.36416 19.4952 0 15.1311 0 9.74762Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.4762 15.4758C15.8612 15.0909 16.4853 15.0909 16.8702 15.4758L22.7115 21.3171C23.0964 21.7021 23.0964 22.3262 22.7115 22.7111C22.3265 23.0961 21.7024 23.0961 21.3175 22.7111L15.4762 16.8699C15.0913 16.4849 15.0913 15.8608 15.4762 15.4758Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17.3998 14.0208C17.9432 14.0532 18.3576 14.5199 18.3252 15.0634C18.2732 15.9379 18.0981 16.7857 17.4713 17.4066C16.8629 18.0093 16.0096 18.2133 15.1224 18.32C14.5819 18.385 14.0911 17.9995 14.0261 17.459C13.9611 16.9185 14.3465 16.4276 14.887 16.3626C15.7091 16.2638 15.9756 16.1133 16.0839 16.006C16.1738 15.917 16.3124 15.6992 16.3573 14.9462C16.3896 14.4028 16.8564 13.9885 17.3998 14.0208Z" />
                </svg>
            </symbol>
            <symbol id="iconUser">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 25">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.5568 2.31155C8.86416 2.31155 7.49197 3.70096 7.49197 5.41487C7.49197 7.12879 8.86416 8.51819 10.5568 8.51819C12.2495 8.51819 13.6217 7.12879 13.6217 5.41487C13.6217 3.70096 12.2495 2.31155 10.5568 2.31155ZM5.44873 5.41487C5.44873 2.55835 7.73571 0.242676 10.5568 0.242676C13.378 0.242676 15.6649 2.55835 15.6649 5.41487C15.6649 8.2714 13.378 10.5871 10.5568 10.5871C7.73571 10.5871 5.44873 8.2714 5.44873 5.41487Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.5568 14.7249C8.38839 14.7249 5.3945 15.5211 3.59349 16.2036C2.65911 16.5577 2.04324 17.4995 2.04324 18.5991V23.3452C2.04324 23.9165 1.58585 24.3797 1.02162 24.3797C0.457396 24.3797 0 23.9165 0 23.3452V18.5991C0 16.7277 1.06364 14.9533 2.87728 14.266C4.78319 13.5437 8.03931 12.656 10.5568 12.656C13.1441 12.656 15.9579 13.5975 18.0215 14.2983C19.9335 14.9476 21.1135 16.7789 21.1135 18.7526V23.3452C21.1135 23.9165 20.6561 24.3797 20.0919 24.3797C19.5277 24.3797 19.0703 23.9165 19.0703 23.3452V18.7526C19.0703 17.5988 18.3883 16.605 17.3717 16.2598C15.2495 15.5391 12.754 14.7249 10.5568 14.7249Z" />
                </svg>
            </symbol>
            <symbol id="iconWish">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.9932 5.44636C9.9938 3.10895 6.65975 2.48019 4.15469 4.62056C1.64964 6.76093 1.29697 10.3395 3.2642 12.8709C4.89982 14.9757 9.84977 19.4146 11.4721 20.8514C11.6536 21.0121 11.7444 21.0925 11.8502 21.1241C11.9426 21.1516 12.0437 21.1516 12.1361 21.1241C12.2419 21.0925 12.3327 21.0121 12.5142 20.8514C14.1365 19.4146 19.0865 14.9757 20.7221 12.8709C22.6893 10.3395 22.3797 6.73842 19.8316 4.62056C17.2835 2.5027 13.9925 3.10895 11.9932 5.44636Z"
                        stroke="var(--mainColor)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </symbol>
            <symbol id="iconCompare">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"
                    class="compare-icon">
                    <path
                        d="M24,128A72.08,72.08,0,0,1,96,56H204.69L194.34,45.66a8,8,0,0,1,11.32-11.32l24,24a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32-11.32L204.69,72H96a56.06,56.06,0,0,0-56,56,8,8,0,0,1-16,0Zm200-8a8,8,0,0,0-8,8,56.06,56.06,0,0,1-56,56H51.31l10.35-10.34a8,8,0,0,0-11.32-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.32-11.32L51.31,200H160a72.08,72.08,0,0,0,72-72A8,8,0,0,0,224,120Z">
                    </path>
                </svg>
            </symbol>
            <symbol id="iconCart">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 26">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.136229 12.5861C-0.700812 9.07725 2.45811 6.0996 5.81466 6.6552C9.7347 7.30406 13.1213 7.32351 17.1588 6.66052C20.5174 6.10899 23.6887 9.08982 22.8502 12.6047L20.5339 22.3145C20.0279 24.4356 18.1508 25.9281 15.9951 25.9281H6.99586C4.84013 25.9281 2.96298 24.4356 2.457 22.3145L0.136229 12.5861ZM5.49688 8.62353C3.36236 8.27021 1.58393 10.1602 2.05091 12.1178L4.37168 21.8462C4.66349 23.0695 5.74739 23.9336 6.99586 23.9336H15.9951C17.2435 23.9336 18.3274 23.0695 18.6192 21.8462L20.9356 12.1364C21.4032 10.1763 19.6164 8.27747 17.4741 8.62926C13.2243 9.32713 9.62384 9.30665 5.49688 8.62353Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.8179 1.99446C8.82349 1.99446 7.2067 3.63153 7.20669 5.65096L7.20668 11.4114C7.20668 11.9621 6.76574 12.4086 6.22181 12.4086C5.67788 12.4086 5.23694 11.9621 5.23694 11.4114L5.23695 5.65096C5.23695 2.53002 7.73563 0 10.8179 0H12.131C15.2133 0 17.712 2.53003 17.712 5.65097V11.6343C17.712 12.1851 17.2711 12.6316 16.7271 12.6316C16.1832 12.6316 15.7422 12.1851 15.7422 11.6343V5.65097C15.7422 3.63154 14.1255 1.99446 12.131 1.99446H10.8179Z" />
                </svg>
            </symbol>
            <symbol id="IconInstagram">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                </svg>
            </symbol>
            <symbol id="IconFacebook">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" viewBox="0 0 512.000000 512.000000"
                    preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" stroke="none">
                        <path
                            d="M2980 5106 c-288 -45 -490 -143 -656 -318 -140 -148 -227 -321 -276 -548 -19 -86 -21 -138 -25 -542 l-4 -448 -395 0 -394 0 0 -455 0 -455 393 -2 392 -3 3 -1167 2 -1168 470 0 470 0 0 1170 0 1170 390 0 c215 0 390 1 390 3 27 182 116 894 113 900 -2 4 -204 7 -449 7 l-445 0 3 373 c3 364 4 373 27 431 47 117 145 187 293 206 40 5 193 10 341 10 l267 0 -2 408 -3 407 -130 12 c-213 19 -675 25 -775 9z" />
                    </g>
                </svg>
            </symbol>
            <symbol id="IconYoutube">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path
                        d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
                </svg>
            </symbol>
            <symbol id="IconTwitter">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                </svg>
            </symbol>
            <symbol id="iconBackTop">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM390.6 310.6c-12.5 12.5-32.75 12.5-45.25 0L256 221.3L166.6 310.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l112-112C239.6 147.1 247.8 144 256 144s16.38 3.125 22.62 9.375l112 112C403.1 277.9 403.1 298.1 390.6 310.6z">
                    </path>
                </svg>
            </symbol>
        </svg>
    </div>
    {{-- <div class="popup-sale">
        <div id="product-random"></div>
    </div>
    <script>
        const randomProducts = [
            "<div class='block-thumb'> <a href='/tui-xach-nu-cong-so'> <img width='480' height='480' src='https://bizweb.dktcdn.net/100/534/571/products/sp2-0f2d71f7-df2d-4dcf-a86c-9f931835aab5.jpg?v=1731853615793' alt='Túi Xách Nữ Công Sở'/> </a> </div> <div class='block-content'> <div id='product-user'></div> <h3><a href='/tui-xach-nu-cong-so' title='Túi Xách Nữ Công Sở'>Đã đặt Túi Xách Nữ Công Sở</a></h3> <div id='product-time'></div> </div>",
            "<div class='block-thumb'> <a href='/ao-len-gilet-nu-co-tim-det-thung'> <img width='480' height='480' src='https://bizweb.dktcdn.net/100/534/571/products/sp5-660552ea-9642-48c7-adcd-4f01971415ea.jpg?v=1731552942300' alt='Áo Len Gilet Nữ Cổ Tim Dệt Thừng'/> </a> </div> <div class='block-content'> <div id='product-user'></div> <h3><a href='/ao-len-gilet-nu-co-tim-det-thung' title='Áo Len Gilet Nữ Cổ Tim Dệt Thừng'>Đã đặt Áo Len Gilet Nữ Cổ Tim Dệt Thừng</a></h3> <div id='product-time'></div> </div>",
            "<div class='block-thumb'> <a href='/ao-khoac-da-lon-nam-2-lop'> <img width='480' height='480' src='https://bizweb.dktcdn.net/100/534/571/products/sp3-09851ea2-f541-42f7-a962-2c02055d85df.jpg?v=1731513403483' alt='Áo Khoác Da Lộn Nam 2 Lớp'/> </a> </div> <div class='block-content'> <div id='product-user'></div> <h3><a href='/ao-khoac-da-lon-nam-2-lop' title='Áo Khoác Da Lộn Nam 2 Lớp'>Đã đặt Áo Khoác Da Lộn Nam 2 Lớp</a></h3> <div id='product-time'></div> </div>",
            "<div class='block-thumb'> <a href='/ao-polo-nam-phoi-mau-nd008'> <img width='480' height='480' src='https://bizweb.dktcdn.net/100/534/571/products/sp8-4069b06d-4ec4-4029-9124-ef50cbd0cbd9.jpg?v=1731320140383' alt='Áo polo nam phối màu ND008'/> </a> </div> <div class='block-content'> <div id='product-user'></div> <h3><a href='/ao-polo-nam-phoi-mau-nd008' title='Áo polo nam phối màu ND008'>Đã đặt Áo polo nam phối màu ND008</a></h3> <div id='product-time'></div> </div>",
        ]
        const productUsers = [
            "Nguyễn Dũng - 0985016xxx",
            "Hồng Mến - 0835033xxx",
            "Nguyễn Thắm - 0866881xxx",
            "Nguyễn Sơn - 0978089xxx",
            "Quang Anh - 0866881xxx"
        ];

        const randomTimes = [
            "8 phút trước",
            "18 phút trước",
            "34 phút trước",
            "38 phút trước",
            "52 phút trước"
        ];


        function generateRandomProduct() {
            const randomProduct = randomProducts[Math.floor(Math.random() * randomProducts.length)];
            const randomUser = productUsers[Math.floor(Math.random() * productUsers.length)];
            const randomTime = randomTimes[Math.floor(Math.random() * randomTimes.length)];

            document.getElementById('product-random').innerHTML = randomProduct;
            document.getElementById('product-user').textContent = randomUser;
            document.getElementById('product-time').textContent = randomTime;

            const popup = document.querySelector('.popup-sale');
            popup.classList.add('show');

            setTimeout(() => {
                popup.classList.remove('show');
            }, 10000);
        }

        setInterval(generateRandomProduct, 25000);
    </script> --}}
    {{-- <div class="promotion-popup" id="promotion-popup">
        <div class="promotion-popup-content">
            <span class="close-btn" id="close-btn">&times;</span>
            <div class="col-left">
                <p>
                    Săn mã khuyến mãi
                </p>
                <h2>
                    Black<br>Fridays
                </h2>
                <p>
                    Giảm giá lên đến 50%
                </p>
                <div class="coupon-code">
                    GET30OFF
                </div>
            </div>
            <div class="col-right">
                <div class="block-product">
                    <h2>
                        <a href="san-pham-noi-bat" title="Bạn có thể thích">
                            Bạn có thể thích
                        </a>
                    </h2>
                    <div class="product-promotion-swiper swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <form action="/cart/add" method="post" class="variants product-action"
                                    data-cart-form data-id="product-actions-38405743" enctype="multipart/form-data">
                                    <div class="product-thumbnail">
                                        <a class="thumb" href="/tui-xach-nu-cong-so" title="Túi Xách Nữ Công Sở">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp2-0f2d71f7-df2d-4dcf-a86c-9f931835aab5.jpg?v=1731853615793"
                                                alt="Túi Xách Nữ Công Sở">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp2-2-fde09577-feb4-47ee-9881-8ced01eca8a3.jpg?v=1731853615793"
                                                alt="Túi Xách Nữ Công Sở" />
                                        </a>
                                        <div class="list-action-right">
                                            <a href="javascript:;" data-url="/tui-xach-nu-cong-so"
                                                title="Thêm vào yêu thích" class="favorite-link btn-wish">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.9932 5.44636C9.9938 3.10895 6.65975 2.48019 4.15469 4.62056C1.64964 6.76093 1.29697 10.3395 3.2642 12.8709C4.89982 14.9757 9.84977 19.4146 11.4721 20.8514C11.6536 21.0121 11.7444 21.0925 11.8502 21.1241C11.9426 21.1516 12.0437 21.1516 12.1361 21.1241C12.2419 21.0925 12.3327 21.0121 12.5142 20.8514C14.1365 19.4146 19.0865 14.9757 20.7221 12.8709C22.6893 10.3395 22.3797 6.73842 19.8316 4.62056C17.2835 2.5027 13.9925 3.10895 11.9932 5.44636Z"
                                                        stroke="#231f20" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                            <a href="javascript:;" data-url="/tui-xach-nu-cong-so"
                                                data-img="//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp2-0f2d71f7-df2d-4dcf-a86c-9f931835aab5.jpg?v=1731853615793"
                                                data-name="Túi Xách Nữ Công Sở" data-type="Túi xách"
                                                title="Thêm vào so sánh" class="btn-compare">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 256 256">
                                                    <path
                                                        d="M24,128A72.08,72.08,0,0,1,96,56H204.69L194.34,45.66a8,8,0,0,1,11.32-11.32l24,24a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32-11.32L204.69,72H96a56.06,56.06,0,0,0-56,56,8,8,0,0,1-16,0Zm200-8a8,8,0,0,0-8,8,56.06,56.06,0,0,1-56,56H51.31l10.35-10.34a8,8,0,0,0-11.32-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.32-11.32L51.31,200H160a72.08,72.08,0,0,0,72-72A8,8,0,0,0,224,120Z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="list-action-bottom d-lg-block d-none">
                                            <input type="hidden" name="variantId" value="151743420" />
                                            <button class="add_to_cart " title="Thêm vào giỏ hàng">
                                                Thêm vào giỏ hàng
                                            </button>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-info__name">
                                            <a href="/tui-xach-nu-cong-so" title="Túi Xách Nữ Công Sở">
                                                Túi Xách Nữ Công Sở
                                            </a>
                                        </h3>
                                        <div class="product-info__price">
                                            1.800.000₫
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form action="/cart/add" method="post" class="variants product-action"
                                    data-cart-form data-id="product-actions-38293271" enctype="multipart/form-data">
                                    <div class="product-thumbnail">
                                        <a class="thumb" href="/ao-len-gilet-nu-co-tim-det-thung"
                                            title="Áo Len Gilet Nữ Cổ Tim Dệt Thừng">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp5-660552ea-9642-48c7-adcd-4f01971415ea.jpg?v=1731552942300"
                                                alt="Áo Len Gilet Nữ Cổ Tim Dệt Thừng">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp5-2-974b486e-7887-4720-a7ba-180d4f4b85ce.jpg?v=1731552942300"
                                                alt="Áo Len Gilet Nữ Cổ Tim Dệt Thừng" />
                                        </a>
                                        <span class="smart">-
                                            29%
                                        </span>
                                        <div class="list-action-right">
                                            <a href="javascript:;" data-url="/ao-len-gilet-nu-co-tim-det-thung"
                                                title="Thêm vào yêu thích" class="favorite-link btn-wish">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.9932 5.44636C9.9938 3.10895 6.65975 2.48019 4.15469 4.62056C1.64964 6.76093 1.29697 10.3395 3.2642 12.8709C4.89982 14.9757 9.84977 19.4146 11.4721 20.8514C11.6536 21.0121 11.7444 21.0925 11.8502 21.1241C11.9426 21.1516 12.0437 21.1516 12.1361 21.1241C12.2419 21.0925 12.3327 21.0121 12.5142 20.8514C14.1365 19.4146 19.0865 14.9757 20.7221 12.8709C22.6893 10.3395 22.3797 6.73842 19.8316 4.62056C17.2835 2.5027 13.9925 3.10895 11.9932 5.44636Z"
                                                        stroke="#231f20" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                            <a href="javascript:;" data-url="/ao-len-gilet-nu-co-tim-det-thung"
                                                data-img="//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp5-660552ea-9642-48c7-adcd-4f01971415ea.jpg?v=1731552942300"
                                                data-name="Áo Len Gilet Nữ Cổ Tim Dệt Thừng" data-type="Áo len"
                                                title="Thêm vào so sánh" class="btn-compare">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 256 256">
                                                    <path
                                                        d="M24,128A72.08,72.08,0,0,1,96,56H204.69L194.34,45.66a8,8,0,0,1,11.32-11.32l24,24a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32-11.32L204.69,72H96a56.06,56.06,0,0,0-56,56,8,8,0,0,1-16,0Zm200-8a8,8,0,0,0-8,8,56.06,56.06,0,0,1-56,56H51.31l10.35-10.34a8,8,0,0,0-11.32-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.32-11.32L51.31,200H160a72.08,72.08,0,0,0,72-72A8,8,0,0,0,224,120Z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="list-action-bottom d-lg-block d-none">
                                            <input class="hidden" type="hidden" name="variantId"
                                                value="128931197" />
                                            <a title="Tùy chọn" href="/ao-len-gilet-nu-co-tim-det-thung">
                                                Tùy chọn
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-swatchs">
                                        <div class="item-swatch colors  hong-dao"
                                            data-image="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp5-2-974b486e-7887-4720-a7ba-180d4f4b85ce.jpg?v=1731552942300">
                                            <a href="/ao-len-gilet-nu-co-tim-det-thung?variantId=128931197"
                                                data-image="https://bizweb.dktcdn.net/100/534/571/products/sp5-2-974b486e-7887-4720-a7ba-180d4f4b85ce.jpg?v=1731552942300"
                                                style="background-image: url(//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp5-2-974b486e-7887-4720-a7ba-180d4f4b85ce.jpg?v=1731552942300); background-size: cover;">
                                            </a>
                                        </div>
                                        <div class="item-swatch colors  kem"
                                            data-image="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp5-5-326d8801-68cb-4304-bc5d-b1ff775530d5.jpg?v=1731552942300">
                                            <a href="/ao-len-gilet-nu-co-tim-det-thung?variantId=128931209"
                                                data-image="https://bizweb.dktcdn.net/100/534/571/products/sp5-5-326d8801-68cb-4304-bc5d-b1ff775530d5.jpg?v=1731552942300"
                                                style="background-color:#fffdd0; background-image: url(//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp5-5-326d8801-68cb-4304-bc5d-b1ff775530d5.jpg?v=1731552942300); background-size: cover;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-info__name">
                                            <a href="/ao-len-gilet-nu-co-tim-det-thung"
                                                title="Áo Len Gilet Nữ Cổ Tim Dệt Thừng">
                                                Áo Len Gilet Nữ Cổ Tim Dệt Thừng
                                            </a>
                                        </h3>
                                        <div class="product-info__price">
                                            486.000₫&nbsp;
                                            <span class="compare-price">686.000₫</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form action="/cart/add" method="post" class="variants product-action"
                                    data-cart-form data-id="product-actions-38290551" enctype="multipart/form-data">
                                    <div class="product-thumbnail">
                                        <a class="thumb" href="/ao-khoac-da-lon-nam-2-lop"
                                            title="Áo Khoác Da Lộn Nam 2 Lớp">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp3-09851ea2-f541-42f7-a962-2c02055d85df.jpg?v=1731513403483"
                                                alt="Áo Khoác Da Lộn Nam 2 Lớp">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp3-2-c140d0a9-b56c-4166-8f5b-3da0c917eba6.jpg?v=1731513403483"
                                                alt="Áo Khoác Da Lộn Nam 2 Lớp" />
                                        </a>
                                        <span class="smart">-
                                            7%
                                        </span>
                                        <div class="list-action-right">
                                            <a href="javascript:;" data-url="/ao-khoac-da-lon-nam-2-lop"
                                                title="Thêm vào yêu thích" class="favorite-link btn-wish">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.9932 5.44636C9.9938 3.10895 6.65975 2.48019 4.15469 4.62056C1.64964 6.76093 1.29697 10.3395 3.2642 12.8709C4.89982 14.9757 9.84977 19.4146 11.4721 20.8514C11.6536 21.0121 11.7444 21.0925 11.8502 21.1241C11.9426 21.1516 12.0437 21.1516 12.1361 21.1241C12.2419 21.0925 12.3327 21.0121 12.5142 20.8514C14.1365 19.4146 19.0865 14.9757 20.7221 12.8709C22.6893 10.3395 22.3797 6.73842 19.8316 4.62056C17.2835 2.5027 13.9925 3.10895 11.9932 5.44636Z"
                                                        stroke="#231f20" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                            <a href="javascript:;" data-url="/ao-khoac-da-lon-nam-2-lop"
                                                data-img="//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp3-09851ea2-f541-42f7-a962-2c02055d85df.jpg?v=1731513403483"
                                                data-name="Áo Khoác Da Lộn Nam 2 Lớp" data-type="Áo khoác da lộn"
                                                title="Thêm vào so sánh" class="btn-compare">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 256 256">
                                                    <path
                                                        d="M24,128A72.08,72.08,0,0,1,96,56H204.69L194.34,45.66a8,8,0,0,1,11.32-11.32l24,24a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32-11.32L204.69,72H96a56.06,56.06,0,0,0-56,56,8,8,0,0,1-16,0Zm200-8a8,8,0,0,0-8,8,56.06,56.06,0,0,1-56,56H51.31l10.35-10.34a8,8,0,0,0-11.32-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.32-11.32L51.31,200H160a72.08,72.08,0,0,0,72-72A8,8,0,0,0,224,120Z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="list-action-bottom d-lg-block d-none">
                                            <input class="hidden" type="hidden" name="variantId"
                                                value="128920341" />
                                            <a title="Tùy chọn" href="/ao-khoac-da-lon-nam-2-lop">
                                                Tùy chọn
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-swatchs">
                                        <div class="item-swatch colors  hong-be"
                                            data-image="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp3-09851ea2-f541-42f7-a962-2c02055d85df.jpg?v=1731513403483">
                                            <a href="/ao-khoac-da-lon-nam-2-lop?variantId=128920341"
                                                data-image="https://bizweb.dktcdn.net/100/534/571/products/sp3-09851ea2-f541-42f7-a962-2c02055d85df.jpg?v=1731513403483"
                                                style="background-image: url(//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp3-09851ea2-f541-42f7-a962-2c02055d85df.jpg?v=1731513403483); background-size: cover;">
                                            </a>
                                        </div>
                                        <div class="item-swatch colors  den"
                                            data-image="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp3-5-77cd757d-c5cb-4c38-afa9-ccd0c42b16d5.jpg?v=1731513403483">
                                            <a href="/ao-khoac-da-lon-nam-2-lop?variantId=128920355"
                                                data-image="https://bizweb.dktcdn.net/100/534/571/products/sp3-5-77cd757d-c5cb-4c38-afa9-ccd0c42b16d5.jpg?v=1731513403483"
                                                style="background-color:#000000; background-image: url(//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp3-5-77cd757d-c5cb-4c38-afa9-ccd0c42b16d5.jpg?v=1731513403483); background-size: cover;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-info__name">
                                            <a href="/ao-khoac-da-lon-nam-2-lop" title="Áo Khoác Da Lộn Nam 2 Lớp">
                                                Áo Khoác Da Lộn Nam 2 Lớp
                                            </a>
                                        </h3>
                                        <div class="product-info__price">
                                            1.860.000₫&nbsp;
                                            <span class="compare-price">2.000.000₫</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="swiper-slide">
                                <form action="/cart/add" method="post" class="variants product-action"
                                    data-cart-form data-id="product-actions-38240550" enctype="multipart/form-data">
                                    <div class="product-thumbnail">
                                        <a class="thumb" href="/ao-polo-nam-phoi-mau-nd008"
                                            title="Áo polo nam phối màu ND008">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp8-4069b06d-4ec4-4029-9124-ef50cbd0cbd9.jpg?v=1731320140383"
                                                alt="Áo polo nam phối màu ND008">
                                            <img width="360" height="360" loading="lazy"
                                                src="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp8-2-b6da4946-d566-436c-bb78-02b179755959.jpg?v=1731320140383"
                                                alt="Áo polo nam phối màu ND008" />
                                        </a>
                                        <span class="smart">-
                                            25%
                                        </span>
                                        <div class="list-action-right">
                                            <a href="javascript:;" data-url="/ao-polo-nam-phoi-mau-nd008"
                                                title="Thêm vào yêu thích" class="favorite-link btn-wish">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.9932 5.44636C9.9938 3.10895 6.65975 2.48019 4.15469 4.62056C1.64964 6.76093 1.29697 10.3395 3.2642 12.8709C4.89982 14.9757 9.84977 19.4146 11.4721 20.8514C11.6536 21.0121 11.7444 21.0925 11.8502 21.1241C11.9426 21.1516 12.0437 21.1516 12.1361 21.1241C12.2419 21.0925 12.3327 21.0121 12.5142 20.8514C14.1365 19.4146 19.0865 14.9757 20.7221 12.8709C22.6893 10.3395 22.3797 6.73842 19.8316 4.62056C17.2835 2.5027 13.9925 3.10895 11.9932 5.44636Z"
                                                        stroke="#231f20" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                            <a href="javascript:;" data-url="/ao-polo-nam-phoi-mau-nd008"
                                                data-img="//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp8-4069b06d-4ec4-4029-9124-ef50cbd0cbd9.jpg?v=1731320140383"
                                                data-name="Áo polo nam phối màu ND008" data-type="Áo T Shirt"
                                                title="Thêm vào so sánh" class="btn-compare">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 256 256">
                                                    <path
                                                        d="M24,128A72.08,72.08,0,0,1,96,56H204.69L194.34,45.66a8,8,0,0,1,11.32-11.32l24,24a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32-11.32L204.69,72H96a56.06,56.06,0,0,0-56,56,8,8,0,0,1-16,0Zm200-8a8,8,0,0,0-8,8,56.06,56.06,0,0,1-56,56H51.31l10.35-10.34a8,8,0,0,0-11.32-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.32-11.32L51.31,200H160a72.08,72.08,0,0,0,72-72A8,8,0,0,0,224,120Z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="list-action-bottom d-lg-block d-none">
                                            <input class="hidden" type="hidden" name="variantId"
                                                value="128742280" />
                                            <a title="Tùy chọn" href="/ao-polo-nam-phoi-mau-nd008">
                                                Tùy chọn
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-swatchs">
                                        <div class="item-swatch colors  be-xam"
                                            data-image="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp8-4069b06d-4ec4-4029-9124-ef50cbd0cbd9.jpg?v=1731320140383">
                                            <a href="/ao-polo-nam-phoi-mau-nd008?variantId=128742280"
                                                data-image="https://bizweb.dktcdn.net/100/534/571/products/sp8-4069b06d-4ec4-4029-9124-ef50cbd0cbd9.jpg?v=1731320140383"
                                                style="background-image: url(//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp8-4069b06d-4ec4-4029-9124-ef50cbd0cbd9.jpg?v=1731320140383); background-size: cover;">
                                            </a>
                                        </div>
                                        <div class="item-swatch colors  xanh-dam"
                                            data-image="//bizweb.dktcdn.net/thumb/large/100/534/571/products/sp8-5-05c1c474-ce3f-4eec-963e-23a6751e0953.jpg?v=1731320140383">
                                            <a href="/ao-polo-nam-phoi-mau-nd008?variantId=128743106"
                                                data-image="https://bizweb.dktcdn.net/100/534/571/products/sp8-5-05c1c474-ce3f-4eec-963e-23a6751e0953.jpg?v=1731320140383"
                                                style="background-image: url(//bizweb.dktcdn.net/thumb/small/100/534/571/products/sp8-5-05c1c474-ce3f-4eec-963e-23a6751e0953.jpg?v=1731320140383); background-size: cover;">
                                            </a>
                                        </div>
                                        <div class="item-swatch colors  do">
                                            <a href="/ao-polo-nam-phoi-mau-nd008?variantId=131845346"
                                                style="background-color:#ff0000;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-info__name">
                                            <a href="/ao-polo-nam-phoi-mau-nd008" title="Áo polo nam phối màu ND008">
                                                Áo polo nam phối màu ND008
                                            </a>
                                        </h3>
                                        <div class="product-info__price">
                                            450.000₫&nbsp;
                                            <span class="compare-price">600.000₫</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var productPromotionSwiper = new Swiper('.product-promotion-swiper', {
            slidesPerView: 2,
            loop: false,
            grabCursor: true,
            spaceBetween: 30,
            pagination: {
                el: '.product-promotion-swiper  .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.product-promotion-swiper .swiper-button-next',
                prevEl: '.product-promotion-swiper .swiper-button-prev',
            },
            autoplay: false,
            breakpoints: {
                300: {
                    slidesPerView: 2,
                },
                500: {
                    slidesPerView: 2,
                },
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,

                },
                991: {
                    slidesPerView: 2,

                },
                1200: {
                    slidesPerView: 2,

                }
            }
        });

        // window.addEventListener('load', function() {
        //     setTimeout(function() {
        //         var promotionPopup = document.getElementById('promotion-popup');
        //         promotionPopup.classList.add('show');
        //         document.querySelectorAll('.favorite-link').forEach(link => link.addEventListener('click',
        //             toggleFavorite));
        //         document.querySelectorAll('.btn-compare').forEach(button => button.addEventListener('click',
        //             toggleComparison));
        //         setupSwatchHover();
        //     }, 5000);

        //     var closeButton = document.getElementById('close-btn');
        //     closeButton.addEventListener('click', function() {
        //         var promotionPopup = document.getElementById('promotion-popup');
        //         promotionPopup.classList.remove('show');
        //     });

        //     window.addEventListener('click', function(event) {
        //         var promotionPopup = document.getElementById('promotion-popup');
        //         if (event.target === promotionPopup) {
        //             promotionPopup.classList.remove('show');
        //         }
        //     });
        // });
    </script> --}}
</body>

</html>
