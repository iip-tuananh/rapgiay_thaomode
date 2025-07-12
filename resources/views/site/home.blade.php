@extends('site.layouts.master')
@section('title')
    {{ $config->meta_title ?? $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection
@section('css')
    <link href="/site/css/index.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('content')
    <div class="home-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="swiper-slide item-effect">
                    <a href="{{ $banner->link }}" class="clearfix" title="{{ $banner->name }}">
                        <picture>
                            <source media="(min-width: 1200px)"
                                srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1920x695' }}">
                            <source media="(min-width: 992px)"
                                srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1920x695' }}">
                            <source media="(min-width: 569px)"
                                srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1920x695' }}">
                            <source media="(max-width: 567px)"
                                srcset="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1920x695' }}">
                            <img width="1920" height="695" loading="lazy"
                                src="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1920x695' }}"
                                alt="{{ $banner->name }}" class="img-responsive" />
                        </picture>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var homeSwiper = new Swiper('.home-slider', {
                slidesPerView: 1,
                loop: false,
                grabCursor: true,
                spaceBetween: 0,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                pagination: {
                    el: '.home-slider  .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.home-slider .swiper-button-next',
                    prevEl: '.home-slider .swiper-button-prev',
                },
                autoplay: false,
                breakpoints: {
                    300: {
                        slidesPerView: 1,
                    },
                    500: {
                        slidesPerView: 1,
                    },
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,

                    },
                    991: {
                        slidesPerView: 1,

                    },
                    1200: {
                        slidesPerView: 1,

                    }
                }
            });
        });
    </script>
    <div class="home-policy item-effect">
        <div class="container">
            <div class="inner">
                <div class="policy-slider swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide item">
                            <div class="icon">
                                <img width="48" height="48" loading="lazy"
                                    src="/site/images/icon_policy_1.png?1749442635129" alt="Giao hàng toán quốc" />
                            </div>
                            <div class="info">
                                <div class="title">
                                    Giao hàng toán quốc
                                </div>
                                <p>
                                    Thanh toán (COD) khi nhận hàng
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide item">
                            <div class="icon">
                                <img width="48" height="48" loading="lazy"
                                    src="/site/images/icon_policy_2.png?1749442635129" alt="Miễn phí giao hàng" />
                            </div>
                            <div class="info">
                                <div class="title">
                                    Miễn phí giao hàng
                                </div>
                                <p>
                                    Theo chính sách
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide item">
                            <div class="icon">
                                <img width="48" height="48" loading="lazy"
                                    src="/site/images/icon_policy_3.png?1749442635129" alt="Đổi trả trong 7 ngày" />
                            </div>
                            <div class="info">
                                <div class="title">
                                    Đổi trả trong 7 ngày
                                </div>
                                <p>
                                    Kể từ ngày mua hàng
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide item">
                            <div class="icon">
                                <img width="48" height="48" loading="lazy"
                                    src="/site/images/icon_policy_4.png?1749442635129" alt="Hỗ trợ 24/7" />
                            </div>
                            <div class="info">
                                <div class="title">
                                    Hỗ trợ 24/7
                                </div>
                                <p>
                                    Theo chính sách
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var policySwiper = new Swiper('.policy-slider', {
                            slidesPerView: 4,
                            loop: false,
                            spaceBetween: 40,
                            autoHeight: true,
                            pagination: {
                                el: '.policy-slider  .swiper-pagination',
                                clickable: true,
                            },
                            navigation: {
                                nextEl: '.policy-slider .swiper-button-next',
                                prevEl: '.policy-slider .swiper-button-prev',
                            },
                            autoplay: {
                                delay: 4000,
                            },
                            breakpoints: {
                                300: {
                                    slidesPerView: 1,
                                },
                                500: {
                                    slidesPerView: 1,
                                },
                                640: {
                                    slidesPerView: 1,
                                },
                                768: {
                                    slidesPerView: 2,

                                },
                                991: {
                                    slidesPerView: 3,
                                    spaceBetween: 20
                                },
                                1200: {
                                    slidesPerView: 4,

                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="home-cate">
        <div class="container">
            <div class="list-cate item-effect">
                @foreach ($productCategories as $productCategory)
                    <div class="item">
                        <div class="thumb-cate">
                            <a href="{{ route('front.show-product-category', $productCategory->slug) }}"
                                title="{{ $productCategory->name }}">
                                <img width="195" height="195" loading="lazy"
                                    src="{{ $productCategory->image ? $productCategory->image->path : 'https://placehold.co/195x195' }}"
                                    alt="{{ $productCategory->name }}" />
                            </a>
                        </div>
                        <div class="title">
                            <a href="{{ route('front.show-product-category', $productCategory->slug) }}"
                                title="{{ $productCategory->name }}">
                                {{ $productCategory->name }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="home-flash-sale">
        <div class="container">
            <div class="block-countdown">
                <div id="countdown"></div>
            </div>
            <h2 class="item-effect">
                <a href="{{ route('front.show-product-category', $categorySpecialFlashsale->slug) }}"
                    title="{{ $categorySpecialFlashsale->name }}">
                    {{ $categorySpecialFlashsale->name }}
                </a>
            </h2>
            <div class="flash-sale-swiper swiper-container item-effect">
                <div class="swiper-wrapper">
                    @foreach ($categorySpecialFlashsale->products as $product)
                        <div class="swiper-slide flashsale__item" data-pdid="38290551" data-inventory-quantity="200"
                            data-available="true">
                            @include('site.products.product_item', ['product' => $product])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="viewMore item-effect">
                <a href="{{ route('front.show-product-category', $categorySpecialFlashsale->slug) }}" title="Xem tất cả">
                    Xem tất cả
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
                        fill="none">
                        <path d="M4.49902 12.7646H20.499M20.499 12.7646L14.499 6.76465M20.499 12.7646L14.499 18.7646"
                            stroke="#FF6347" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <script>
        window.falshSale = {
            type: "hours",
            dateStart: "",
            dateFinish: "",
            hourStart: "00:00",
            hourFinish: "24",
            activeDay: "7",
            finishAction: "show",
            percentMin: "40",
            percentMax: "80",
            maxInStock: "200",
            useSoldQuantity: false,
            quantityType: "sold",
            timestamp: new Date().getTime(),
        }
    </script>
    <script src="/site/js/flash_sale.js?1749442635129" defer></script>
    <script>
        $(document).ready(function() {
            var cateflash = new Swiper('.flash-sale-swiper', {
                slidesPerView: 4,
                loop: false,
                grabCursor: true,
                spaceBetween: 20,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                pagination: {
                    el: '.flash-sale-swiper  .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.flash-sale-swiper .swiper-button-next',
                    prevEl: '.flash-sale-swiper .swiper-button-prev',
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
                        slidesPerView: 3,

                    },
                    991: {
                        slidesPerView: 4,

                    },
                    1200: {
                        slidesPerView: 4,

                    }
                }
            });
        });


        var x = setInterval(function() {
            const now = new Date();
            const targetDate = new Date(
                '{{ $categorySpecialFlashsale->end_date }}'); // Đặt giờ là 00:00:00 của ngày 2024-07-01
            const distance = targetDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = "<div class='inner-countdown'>" +
                "<div class='item'><span>" + String(days).padStart(2, '0') + "</span></div>" +
                "<div class='dots'>:</div>" + "<div class='item'><span>" + String(hours).padStart(2, '0') +
                "</span></div>" +
                "<div class='dots'>:</div>" + "<div class='item'><span>" + String(minutes).padStart(2, '0') +
                "</span></div>" + "<div class='dots'>:</div>" + "<div class='item'><span>" + String(seconds)
                .padStart(2, '0') + "</span></div>" + "</div>";
            if (distance < 0) {
                clearInterval(x);
                var blockCountdown = document.querySelectorAll(".block-countdown");
                blockCountdown.forEach(function(element) {
                    element.remove();
                });
            }
        }, 1000);
    </script>

    @if ($categorySpecial->count() > 0)
        @foreach ($categorySpecial as $category)
            <div class="home-product-tab ajax-tab ajax-tab-1" data-section="ajax-tab-1" data-view="view_tab_1">
                <div class="container">
                    <div class="block-title">
                        <h2 class="item-effect">
                            <span>{{ $category->name }}</span>
                        </h2>
                        {{-- <ul class="item-effect">
                        <li class="item-tab has-item active" data-tab="tab-1" data-url="hang-moi-ve">
                            Hàng mới về
                        </li>
                        <li class="item-tab " data-tab="tab-2" data-url="gia-tot">
                            Giá tốt
                        </li>
                        <li class="item-tab " data-tab="tab-3" data-url="tim-kiem-nhieu-nhat">
                            Tìm kiếm nhiều nhất
                        </li>
                        <li class="item-tab " data-tab="tab-5" data-url="demo">
                            Demo
                        </li>
                    </ul> --}}
                    </div>
                    <div class="tab-content item-effect">
                        <div class="tab-content-item tab-1 active">
                            <div class="fill-content">
                                <div class="row">
                                    @foreach ($category->products as $product)
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-6 col-fix">
                                            @include('site.products.product_item', ['product' => $product])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-banner item-effect">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <a class="thumb-banner banner-2"
                                href="{{ route('front.show-product-category', $category->slug) }}"
                                title="{{ $category->name }}">
                                <img width="1920" height="320" loading="lazy"
                                    src="{{ $category->image ? $category->image->path : 'http://placehold.co/1920x320' }}"
                                    alt="{{ $category->name }}" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="home-review-customer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 block-info item-effect order-lg-2">
                    <h2>
                        Đánh giá của khách hàng
                    </h2>
                    <div class="review-customer-swiper swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($reviews as $review)
                                <div class="swiper-slide">
                                    <div class="des">
                                        {{ $review->message }}
                                    </div>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="168" height="24"
                                            viewBox="0 0 168 24" fill="none">
                                            <path
                                                d="M10.8481 3.36272C11.3241 2.39688 12.7013 2.39687 13.1773 3.36272L15.1187 7.30163C15.3078 7.68538 15.6738 7.95133 16.0972 8.01263L20.4034 8.63601C21.4672 8.79001 21.8939 10.096 21.1262 10.8483L17.9917 13.9202C17.6877 14.2181 17.5491 14.6462 17.6206 15.0658L18.3598 19.3989C18.541 20.4611 17.4242 21.269 16.4721 20.7646L12.6206 18.724C12.2404 18.5226 11.7851 18.5226 11.4049 18.724L7.55337 20.7646C6.60123 21.269 5.48444 20.4611 5.66563 19.3989L6.40447 15.0677C6.47623 14.647 6.3367 14.218 6.03123 13.92L2.88462 10.8504C2.11404 10.0987 2.54038 8.78966 3.60586 8.63593L7.92776 8.01236C8.35141 7.95124 8.71772 7.68523 8.90695 7.30128L10.8481 3.36272Z"
                                                fill="#FFC700" stroke="#FFC700" stroke-width="1.29837"
                                                stroke-miterlimit="10" />
                                            <path
                                                d="M46.8481 3.36272C47.3241 2.39688 48.7013 2.39687 49.1773 3.36272L51.1187 7.30163C51.3078 7.68538 51.6738 7.95133 52.0972 8.01263L56.4034 8.63601C57.4672 8.79001 57.8939 10.096 57.1262 10.8483L53.9917 13.9202C53.6877 14.2181 53.5491 14.6462 53.6206 15.0658L54.3598 19.3989C54.541 20.4611 53.4242 21.269 52.4721 20.7646L48.6206 18.724C48.2404 18.5226 47.7851 18.5226 47.4049 18.724L43.5534 20.7646C42.6012 21.269 41.4844 20.4611 41.6656 19.3989L42.4045 15.0677C42.4762 14.647 42.3367 14.218 42.0312 13.92L38.8846 10.8504C38.114 10.0987 38.5404 8.78966 39.6059 8.63593L43.9278 8.01236C44.3514 7.95124 44.7177 7.68523 44.907 7.30128L46.8481 3.36272Z"
                                                fill="#FFC700" stroke="#FFC700" stroke-width="1.29837"
                                                stroke-miterlimit="10" />
                                            <path
                                                d="M82.8481 3.36272C83.3241 2.39688 84.7013 2.39687 85.1773 3.36272L87.1187 7.30163C87.3078 7.68538 87.6738 7.95133 88.0972 8.01263L92.4034 8.63601C93.4672 8.79001 93.8939 10.096 93.1262 10.8483L89.9917 13.9202C89.6877 14.2181 89.5491 14.6462 89.6206 15.0658L90.3598 19.3989C90.541 20.4611 89.4242 21.269 88.4721 20.7646L84.6206 18.724C84.2404 18.5226 83.7851 18.5226 83.4049 18.724L79.5534 20.7646C78.6012 21.269 77.4844 20.4611 77.6656 19.3989L78.4045 15.0677C78.4762 14.647 78.3367 14.218 78.0312 13.92L74.8846 10.8504C74.114 10.0987 74.5404 8.78966 75.6059 8.63593L79.9278 8.01236C80.3514 7.95124 80.7177 7.68523 80.907 7.30128L82.8481 3.36272Z"
                                                fill="#FFC700" stroke="#FFC700" stroke-width="1.29837"
                                                stroke-miterlimit="10" />
                                            <path
                                                d="M118.848 3.36272C119.324 2.39688 120.701 2.39687 121.177 3.36272L123.119 7.30163C123.308 7.68538 123.674 7.95133 124.097 8.01263L128.403 8.63601C129.467 8.79001 129.894 10.096 129.126 10.8483L125.992 13.9202C125.688 14.2181 125.549 14.6462 125.621 15.0658L126.36 19.3989C126.541 20.4611 125.424 21.269 124.472 20.7646L120.621 18.724C120.24 18.5226 119.785 18.5226 119.405 18.724L115.553 20.7646C114.601 21.269 113.484 20.4611 113.666 19.3989L114.404 15.0677C114.476 14.647 114.337 14.218 114.031 13.92L110.885 10.8504C110.114 10.0987 110.54 8.78966 111.606 8.63593L115.928 8.01236C116.351 7.95124 116.718 7.68523 116.907 7.30128L118.848 3.36272Z"
                                                fill="#FFC700" stroke="#FFC700" stroke-width="1.29837"
                                                stroke-miterlimit="10" />
                                            <path
                                                d="M154.848 3.36272C155.324 2.39688 156.701 2.39687 157.177 3.36272L159.119 7.30163C159.308 7.68538 159.674 7.95133 160.097 8.01263L164.403 8.63601C165.467 8.79001 165.894 10.096 165.126 10.8483L161.992 13.9202C161.688 14.2181 161.549 14.6462 161.621 15.0658L162.36 19.3989C162.541 20.4611 161.424 21.269 160.472 20.7646L156.621 18.724C156.24 18.5226 155.785 18.5226 155.405 18.724L151.553 20.7646C150.601 21.269 149.484 20.4611 149.666 19.3989L150.404 15.0677C150.476 14.647 150.337 14.218 150.031 13.92L146.885 10.8504C146.114 10.0987 146.54 8.78966 147.606 8.63593L151.928 8.01236C152.351 7.95124 152.718 7.68523 152.907 7.30128L154.848 3.36272Z"
                                                fill="#FFC700" stroke="#FFC700" stroke-width="1.29837"
                                                stroke-miterlimit="10" />
                                        </svg>
                                    </div>
                                    <div class="thumb-review">
                                        <img width="65" height="66" loading="lazy"
                                            src="{{ $review->image ? $review->image->path : 'http://placehold.co/65x66' }}"
                                            alt="{{ $review->name }}" />
                                    </div>
                                    <div class="name">
                                        {{ $review->name }}
                                    </div>
                                    <div class="job">
                                        {{ $review->position }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 block-image item-effect order-lg-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6">
                            <img width="292" height="333" loading="lazy"
                                src="//bizweb.dktcdn.net/100/534/571/themes/972900/assets/img_mini_review.png?1749442635129"
                                alt="ND Style" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">
                            <img width="292" height="333" loading="lazy"
                                src="//bizweb.dktcdn.net/100/534/571/themes/972900/assets/img_mini_review_2.png?1749442635129"
                                alt="ND Style" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            var swiper = new Swiper('.review-customer-swiper', {
                autoplay: true, // Đặt autoplay thành true để bắt đầu tự chuyển đổi
                pagination: {
                    el: '.home-review-customer .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.review-customer-swiper .swiper-button-next',
                    prevEl: '.review-customer-swiper .swiper-button-prev',
                },
            });
        }, 2000);
    </script>

    @if ($categorySpecialPost->count() > 0)
        @foreach ($categorySpecialPost as $category)
            <div class="home-blogs">
                <div class="container ">
                    <div class="block-title">
                        <h2 class="item-effect">
                            <a href="{{ route('front.list-blog', $category->slug) }}"
                                title="{{ $category->name }}">{{ $category->name }}</a>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-left item-effect">
                            <div class="item-blog  ">
                                <div class="block-thumb">
                                    <a class="thumb-blog" title="{{ $category->posts[0]->name }}">
                                        <img loading="lazy"
                                            src="{{ $category->posts[0]->image ? $category->posts[0]->image->path : 'http://placehold.co/620x246' }}"
                                            alt="{{ $category->posts[0]->name }}">
                                    </a>
                                </div>
                                <div class="block-info">
                                    <div class="time-post">
                                        <span class="posted">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.4"
                                                    d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                            </svg>
                                            {{ $category->posts[0]->created_at->format('d/m/Y') }}
                                        </span>
                                        <span class="author">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.4"
                                                    d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            By Admin
                                        </span>
                                    </div>
                                    <h3>
                                        <a href="{{ route('front.detail-blog', $category->posts[0]->slug) }}"
                                            title="{{ $category->posts[0]->name }}">{{ $category->posts[0]->name }}</a>
                                    </h3>
                                    <div class="article-content">
                                        {{ $category->posts[0]->intro }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="list-content item-effect">
                                @foreach ($category->posts as $key => $post)
                                    @if ($key != 0)
                                        <div class="item-blog  ">
                                            <div class="block-thumb">
                                                <a class="thumb-blog"
                                                    href="{{ route('front.detail-blog', $post->slug) }}"
                                                    title="{{ $post->name }}">
                                                    <img loading="lazy"
                                                        src="{{ $post->image ? $post->image->path : 'http://placehold.co/620x246' }}"
                                                        alt="{{ $post->name }}">
                                                </a>
                                            </div>
                                            <div class="block-info">
                                                <div class="time-post">
                                                    <span class="posted">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.4"
                                                                d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                                        </svg>
                                                        {{ $post->created_at->format('d/m/Y') }}
                                                    </span>
                                                    <span class="author">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.4"
                                                                d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                        By Admin
                                                    </span>
                                                </div>
                                                <h3>
                                                    <a href="{{ route('front.detail-blog', $post->slug) }}"
                                                        title="{{ $post->name }}">{{ $post->name }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="viewMore item-effect">
                        <a href="{{ route('front.list-blog', $category->slug) }}" title="Xem tất cả">
                            Xem tất cả
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
                                fill="none">
                                <path
                                    d="M4.49902 12.7646H20.499M20.499 12.7646L14.499 6.76465M20.499 12.7646L14.499 18.7646"
                                    stroke="#FF6347" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
@push('script')
@endpush
