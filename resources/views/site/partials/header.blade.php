<link rel="preload" as="script" href="/site/js/swiper.js?1749442635129" />
<script src="/site/js/swiper.js?1749442635129" type="text/javascript"></script>
<header class="header" ng-cloak>
    <div class="header__topbar">
        <div class="container">
            <div class="topbar-swiper swiper-container">
                <div class="swiper-wrapper">
                    @if ($config->text_top_header)
                        @foreach (explode("\n", $config->text_top_header) as $key => $text)
                            <div class="swiper-slide">
                                <a href="javascript:void(0);" title="">
                                    {{ $text }}
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
    <div class="header__middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-md-4 col-12 col-logo order-lg-1">
                    <a href="{{ route('front.home-page') }}" class="logo-wrapper " title="Logo">
                        <img src="{{ $config->image ? $config->image->path : 'https://placehold.co/100x100' }}"
                            alt="{{ $config->web_title }}">
                    </a>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-8 col-12 col-search order-lg-3 order-md-4 order-md-2 order-3">
                    <form action="{{ route('front.search') }}" method="get" class="header-search" role="search">
                        <input id="targetInput" type="text" name="keyword" autocomplete="off" required
                            placeholder="Tìm kiếm..." class="input-group-field auto-search">
                        <button type="submit" class="btn-search">
                            <svg>
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" href="#iconSearch"></use>
                            </svg>
                        </button>
                    </form>
                </div>
                <div
                    class="col-xl-3 col-lg-3 col-md-12 col-12 d-flex align-items-center justify-content-center col-right order-lg-4 order-md-3 order-2">
                    <div class="menu-bar d-lg-none d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14"
                            fill="none">
                            <path d="M1.43652 7H17.9365M1.43652 1.5H17.9365M1.43652 12.5H17.9365"
                                stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Menu
                    </div>
                    <div class="header-hotline d-lg-none d-block">
                        <a href="tel:{{ str_replace(' ', '', $config->hotline) }}" title="Hotline {{ $config->hotline }}">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.6467 12.22C14.6467 12.46 14.5933 12.7067 14.48 12.9467C14.3667 13.1867 14.22 13.4133 14.0267 13.6267C13.7 13.9867 13.34 14.2467 12.9333 14.4133C12.5333 14.58 12.1 14.6667 11.6333 14.6667C10.9533 14.6667 10.2267 14.5067 9.46 14.18C8.69334 13.8533 7.92667 13.4133 7.16667 12.86C6.4 12.3 5.67334 11.68 4.98 10.9933C4.29334 10.3 3.67334 9.57333 3.12 8.81333C2.57334 8.05333 2.13334 7.29333 1.81334 6.54C1.49334 5.78 1.33334 5.05333 1.33334 4.36C1.33334 3.90667 1.41334 3.47333 1.57334 3.07333C1.73334 2.66667 1.98667 2.29333 2.34 1.96C2.76667 1.54 3.23334 1.33333 3.72667 1.33333C3.91334 1.33333 4.1 1.37333 4.26667 1.45333C4.44 1.53333 4.59334 1.65333 4.71334 1.82667L6.26 4.00667C6.38 4.17333 6.46667 4.32667 6.52667 4.47333C6.58667 4.61333 6.62 4.75333 6.62 4.88C6.62 5.04 6.57334 5.2 6.48 5.35333C6.39334 5.50667 6.26667 5.66667 6.10667 5.82667L5.6 6.35333C5.52667 6.42667 5.49334 6.51333 5.49334 6.62C5.49334 6.67333 5.5 6.72 5.51334 6.77333C5.53334 6.82667 5.55334 6.86667 5.56667 6.90667C5.68667 7.12667 5.89334 7.41333 6.18667 7.76C6.48667 8.10667 6.80667 8.46 7.15334 8.81333C7.51334 9.16667 7.86 9.49333 8.21334 9.79333C8.56 10.0867 8.84667 10.2867 9.07334 10.4067C9.10667 10.42 9.14667 10.44 9.19334 10.46C9.24667 10.48 9.3 10.4867 9.36 10.4867C9.47334 10.4867 9.56 10.4467 9.63334 10.3733L10.14 9.87333C10.3067 9.70667 10.4667 9.58 10.62 9.5C10.7733 9.40667 10.9267 9.36 11.0933 9.36C11.22 9.36 11.3533 9.38667 11.5 9.44667C11.6467 9.50667 11.8 9.59333 11.9667 9.70667L14.1733 11.2733C14.3467 11.3933 14.4667 11.5333 14.54 11.7C14.6067 11.8667 14.6467 12.0333 14.6467 12.22Z"
                                    stroke="#ff6347" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Hotline
                        </a>
                    </div>
                    <div class="header-hotline-desktop d-lg-block d-none">
                        <a href="tel:{{ str_replace(' ', '', $config->hotline) }}" title="Hotline {{ $config->hotline }}">
                            <img src="/site/images/phone-icon.png" alt="Hotline {{ $config->hotline }}" width="46" height="46">
                            <div class="hotline-text ml-0"><span style="color: #ff6347; font-weight: 600; font-size: 16px;">Hotline</span> <br>{{ $config->hotline }}</div>
                        </a>
                    </div>
                    <style>
                        .header-hotline-desktop a {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                        }
                    </style>
                    {{-- <div class="hethong-header d-none">
                        <a href="/he-thong-cua-hang" title="Hệ thống cửa hàng">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                viewBox="0 0 22 22" fill="none">
                                <path
                                    d="M4.5835 13.0957C2.88641 13.8444 1.8335 14.8876 1.8335 16.0415C1.8335 18.3197 5.93755 20.1665 11.0002 20.1665C16.0628 20.1665 20.1668 18.3197 20.1668 16.0415C20.1668 14.8876 19.1139 13.8444 17.4168 13.0957"
                                    stroke="var(--mainColor)" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13.3806 12.7114C12.4415 13.6349 11.5223 14.5389 11 15.5835C10.4777 14.5389 9.55854 13.6349 8.61943 12.7114C7.08633 11.2036 5.5 9.64353 5.5 7.3335C5.5 4.29593 7.96243 1.8335 11 1.8335C14.0376 1.8335 16.5 4.29593 16.5 7.3335C16.5 9.64353 14.9137 11.2036 13.3806 12.7114ZM11 4.66689C9.5273 4.66689 8.33343 5.86076 8.33343 7.33348C8.33343 8.80619 9.5273 10.0001 11 10.0001C12.4727 10.0001 13.6666 8.80619 13.6666 7.33348C13.6666 5.86076 12.4727 4.66689 11 4.66689Z"
                                    fill="var(--mainColor)" />
                                <path
                                    d="M11 15.5835L10.5528 15.8071C10.6375 15.9765 10.8106 16.0835 11 16.0835C11.1894 16.0835 11.3625 15.9765 11.4472 15.8071L11 15.5835ZM13.3806 12.7114L13.7312 13.0678H13.7312L13.3806 12.7114ZM8.61943 12.7114L8.97002 12.3549L8.61943 12.7114ZM11.4472 15.8071C11.9251 14.8513 12.7767 14.0065 13.7312 13.0678L13.03 12.3549C12.1062 13.2634 11.1195 14.2264 10.5528 15.3599L11.4472 15.8071ZM8.26884 13.0678C9.22327 14.0065 10.0749 14.8513 10.5528 15.8071L11.4472 15.3599C10.8805 14.2264 9.89381 13.2634 8.97002 12.3549L8.26884 13.0678ZM5 7.3335C5 9.88649 6.7664 11.5903 8.26884 13.0678L8.97002 12.3549C7.40626 10.817 6 9.40057 6 7.3335H5ZM11 1.3335C7.68629 1.3335 5 4.01979 5 7.3335H6C6 4.57207 8.23858 2.3335 11 2.3335V1.3335ZM17 7.3335C17 4.01979 14.3137 1.3335 11 1.3335V2.3335C13.7614 2.3335 16 4.57207 16 7.3335H17ZM13.7312 13.0678C15.2336 11.5903 17 9.88649 17 7.3335H16C16 9.40057 14.5937 10.817 13.03 12.3549L13.7312 13.0678ZM8.83343 7.33348C8.83343 6.1369 9.80344 5.16689 11 5.16689V4.16689C9.25115 4.16689 7.83343 5.58462 7.83343 7.33348H8.83343ZM11 9.50006C9.80344 9.50006 8.83343 8.53005 8.83343 7.33348H7.83343C7.83343 9.08233 9.25115 10.5001 11 10.5001V9.50006ZM13.1666 7.33348C13.1666 8.53005 12.1966 9.50006 11 9.50006V10.5001C12.7489 10.5001 14.1666 9.08233 14.1666 7.33348H13.1666ZM11 5.16689C12.1966 5.16689 13.1666 6.1369 13.1666 7.33348H14.1666C14.1666 5.58462 12.7489 4.16689 11 4.16689V5.16689Z"
                                    fill="var(--mainColor)" />
                            </svg>
                        </a>
                    </div> --}}
                    {{-- <div class="header-account">
                        <a href="/account" title="Tài khoản của bạn" rel="nofollow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23"
                                viewBox="0 0 22 23" fill="none">
                                <path
                                    d="M4.3163 18.9238C4.92462 17.4906 6.34492 16.4854 8 16.4854H14C15.6551 16.4854 17.0754 17.4906 17.6837 18.9238M15 8.98535C15 11.1945 13.2091 12.9854 11 12.9854C8.79086 12.9854 7 11.1945 7 8.98535C7 6.77621 8.79086 4.98535 11 4.98535C13.2091 4.98535 15 6.77621 15 8.98535ZM21 11.4854C21 17.0082 16.5228 21.4854 11 21.4854C5.47715 21.4854 1 17.0082 1 11.4854C1 5.9625 5.47715 1.48535 11 1.48535C16.5228 1.48535 21 5.9625 21 11.4854Z"
                                    stroke="var(--mainColor)" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Tài khoản
                        </a>
                        <div class="drop-account">
                            <a href="/account/login" title="Đăng nhập">Đăng nhập</a>
                            <a href="/account/register" title="Đăng ký">Đăng ký</a>
                        </div>
                    </div> --}}
                    <div class="header-cart">
                        <a href="{{ route('cart.index') }}" title="Giỏ hàng">
                            <span class="count_item count_item_pr" ng-if="cart.count > 0"><% cart.count %></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21"
                                fill="none">
                                <path
                                    d="M14.9996 6.48535C14.9996 7.54622 14.5782 8.56363 13.828 9.31378C13.0779 10.0639 12.0605 10.4854 10.9996 10.4854C9.93872 10.4854 8.92131 10.0639 8.17116 9.31378C7.42102 8.56363 6.99959 7.54622 6.99959 6.48535M2.63281 5.88674L1.93281 14.2867C1.78243 16.0913 1.70724 16.9935 2.01227 17.6895C2.28027 18.3011 2.74462 18.8057 3.33177 19.1236C4.00006 19.4853 4.90545 19.4853 6.71623 19.4853H15.283C17.0937 19.4853 17.9991 19.4853 18.6674 19.1236C19.2546 18.8057 19.7189 18.3011 19.9869 17.6895C20.2919 16.9935 20.2167 16.0913 20.0664 14.2867L19.3664 5.88673C19.237 4.3341 19.1723 3.55779 18.8285 2.97021C18.5257 2.45279 18.0748 2.03795 17.5341 1.7792C16.92 1.48535 16.141 1.48535 14.583 1.48535L7.41623 1.48535C5.85821 1.48535 5.07921 1.48535 4.4651 1.7792C3.92433 2.03795 3.47349 2.45279 3.17071 2.97021C2.82689 3.55778 2.76219 4.3341 2.63281 5.88674Z"
                                    stroke="var(--mainColor)" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__menu">
        <div class="container">
            <div class="navigation-head">
                <nav class="nav-horizontal">
                    <div class="title d-lg-none d-block">
                        Menu
                    </div>
                    <ul class="item_big item_big_pc">
                        <li class="nav-item active ">
                            <a class="a-img" href="{{ route('front.home-page') }}" title="Trang chủ">
                                Trang chủ
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="a-img" href="{{ route('front.about-us') }}" title="Giới thiệu">
                                Giới thiệu
                            </a>
                        </li>
                        @foreach ($productCategories as $category)
                            <li class="nav-item  has-mega">
                                <a class="a-img caret-down"
                                    href="{{ route('front.show-product-category', $category->slug) }}"
                                    title="{{ $category->name }}">
                                    {{ $category->name }}
                                </a>
                                @if ($category->childs->count() > 0)
                                    <i class="icon-down"></i>
                                    <div class="mega-content d-lg-block d-none">
                                        <div class="nav-block nav-block-center">
                                            <ul class="level0 row">
                                                @foreach ($category->childs as $child)
                                                    <li class="level1 parent item col-lg-3 col-md-3 col-sm-3">
                                                        <a class="h-mega"
                                                            href="{{ route('front.show-product-category', $child->slug) }}"
                                                            title="{{ $child->name }}"><span>{{ $child->name }}</span></a>
                                                        @if ($child->childs->count() > 0)
                                                            <ul class="level1">
                                                                @foreach ($child->childs as $child2)
                                                                    <li class="level2"> <a
                                                                            href="{{ route('front.show-product-category', $child2->slug) }}"
                                                                            title="{{ $child2->name }}"><span>{{ $child2->name }}</span></a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="item_small d-lg-none">
                                        @foreach ($category->childs as $child)
                                            <li>
                                                <a class="caret-down"
                                                    href="{{ route('front.show-product-category', $child->slug) }}"
                                                    title="{{ $child->name }}">
                                                    {{ $child->name }}
                                                </a>
                                                @if ($child->childs->count() > 0)
                                                    <i class="icon-down"></i>
                                                    <ul>
                                                        @foreach ($child->childs as $child2)
                                                            <li>
                                                                <a href="{{ route('front.show-product-category', $child2->slug) }}"
                                                                    title="{{ $child2->name }}"
                                                                    class="a3">{{ $child2->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        @foreach ($postCategories as $postCategory)
                            <li class="nav-item ">
                                <a class="a-img" href="{{ route('front.list-blog', $postCategory->slug) }}"
                                    title="{{ $postCategory->name }}">
                                    {{ $postCategory->name }}
                                </a>
                            </li>
                        @endforeach
                        <li class="nav-item ">
                            <a class="a-img" href="{{ route('front.contact-us') }}" title="Liên hệ">
                                Liên hệ
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="control-menu">
                    <a href="#" id="prevNav">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="#fff"
                                d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                        </svg>
                    </a>
                    <a href="#" id="nextNav">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="#fff"
                                d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    $(document).ready(function() {
        var topbarSwiper = new Swiper('.topbar-swiper', {
            slidesPerView: 1,
            loop: false,
            grabCursor: true,
            spaceBetween: 0,
            pagination: {
                el: '.topbar-swiper  .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.topbar-swiper .swiper-button-next',
                prevEl: '.topbar-swiper .swiper-button-prev',
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
<script src="/site/js/option_selector.js?1749442635129"></script>
<script src="/site/js/api-script-default.js?1749442635129"></script>
