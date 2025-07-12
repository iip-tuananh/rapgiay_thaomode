@extends('site.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('description')
    {{ strip_tags($product->intro) }}
@endsection
@section('image')
    {{ $product->image ? $product->image->path : $product->galleries[0]->image->path }}
@endsection

@section('css')
    <link href="/site/css/breadcrumb.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/product_style.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />

    <style>
        .text-limit-3-line {
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hidden {
            display: none;
        }

        .product-attributes {
            margin-bottom: 0 !important;
        }

        .product-attributes label {
            font-weight: 600;
            margin-bottom: 0 !important;
        }

        .product-attribute-values {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .product-attribute-values .badge,
        .product-attribute-values .badge+.badge {
            width: auto;
            border: 1px solid #0974ba;
            padding: 2px 10px;
            border-radius: 5px;
            font-size: 14px;
            color: #0974ba;
            height: 30px;
            cursor: pointer;
            pointer-events: auto;
        }

        .product-attribute-values .badge:hover {
            background-color: #0974ba;
            color: #fff;
        }

        .product-attribute-values .badge.active {
            background-color: #0974ba;
            color: #fff;
        }

        .countdown {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin-top: 20px;
        }

        .countdown .countdown-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .countdown-item {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 6px 10px;
            border-radius: 2px;
            background: linear-gradient(to bottom, #ff5e00, #f4955e);
        }

        .countdown-item-number {
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .countdown-item-label {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .countdown-item-separator {
            font-size: 14px;
            font-weight: 600;
        }

        .btn-fixed-bottom {
            display: none;
            position: fixed;
            width: 80% !important;
            bottom: 65px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #0974ba;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            z-index: 1000;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #cccccc;
        }

        @media (max-width: 768px) {
            .btn-fixed-bottom {
                display: block;
            }
        }
    </style>
@endsection

@section('content')
    <section class="product layout-product" itemscope itemtype="https://schema.org/Product" ng-controller="ProductDetailController">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li class="home">
                        <a href="{{ route('front.home-page') }}"><span>Trang chủ</span></a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="#fff"
                                d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                            </path>
                        </svg>
                    </li>
                    <li>
                        <a class="changeurl"
                            href="{{ route('front.show-product-category', $product->category->slug) }}"><span>{{ $product->category->name }}</span></a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="#fff"
                                d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                            </path>
                        </svg>
                    </li>
                    <li><strong><span>{{ $product->name }}</span></strong>
                    <li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="featured-product">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 col-xl-6 col-image">
                        <div class="position-sticky">
                            <div class="product-images">
                                <div class="big-image">
                                    <div class="swiper-container gallery-top">
                                        <div class="swiper-wrapper" id="lightgallery">
                                            <a class="swiper-slide" data-hash="0"
                                                href="{{ $product->image ? $product->image->path : 'http://placehold.co/1024x1024' }}"
                                                title="{{ $product->name }}">
                                                <img data-zoom-image="{{ $product->image ? $product->image->path : 'http://placehold.co/1024x1024' }}"
                                                    loading="lazy"
                                                    src="{{ $product->image ? $product->image->path : 'http://placehold.co/1024x1024' }}"
                                                    alt="{{ $product->name }}"
                                                    data-image="{{ $product->image ? $product->image->path : 'http://placehold.co/1024x1024' }}" />
                                            </a>
                                            @foreach ($product->galleries as $key => $gallery)
                                                <a class="swiper-slide" data-hash="{{ $key + 1 }}"
                                                    href="{{ $gallery->image ? $gallery->image->path : 'http://placehold.co/1024x1024' }}"
                                                    title="{{ $product->name }}">
                                                    <img data-zoom-image="{{ $gallery->image ? $gallery->image->path : 'http://placehold.co/1024x1024' }}"
                                                        loading="lazy"
                                                        src="{{ $gallery->image ? $gallery->image->path : 'http://placehold.co/1024x1024' }}"
                                                        alt="{{ $product->name }}"
                                                        data-image="{{ $gallery->image ? $gallery->image->path : 'http://placehold.co/1024x1024' }}" />
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                </div>
                                <div class="small-image ">
                                    <div class="swiper-container gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide" data-hash="0">
                                                <img loading="lazy"
                                                    src="{{ $product->image ? $product->image->path : 'http://placehold.co/1024x1024' }}"
                                                    alt="{{ $product->name }}"
                                                    data-image="{{ $product->image ? $product->image->path : 'http://placehold.co/1024x1024' }}" />
                                            </div>
                                            @foreach ($product->galleries as $key => $gallery)
                                                <div class="swiper-slide" data-hash="{{ $key + 1 }}">
                                                    <img loading="lazy"
                                                        src="{{ $gallery->image ? $gallery->image->path : 'http://placehold.co/1024x1024' }}"
                                                        alt="{{ $product->name }}"
                                                        data-image="{{ $gallery->image ? $gallery->image->path : 'http://placehold.co/1024x1024' }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="social-media" role="list">
                                <li class="title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19"
                                        viewBox="0 0 20 19" fill="none">
                                        <path
                                            d="M18.334 3.56671C18.334 2.186 17.2147 1.06671 15.834 1.06671C14.4533 1.06671 13.334 2.186 13.334 3.56671C13.334 4.94742 14.4533 6.06671 15.834 6.06671C17.2147 6.06671 18.334 4.94742 18.334 3.56671Z"
                                            stroke="#55585C" stroke-width="1.5" />
                                        <path
                                            d="M6.66699 9.40002C6.66699 8.01931 5.5477 6.90002 4.16699 6.90002C2.78628 6.90002 1.66699 8.01931 1.66699 9.40002C1.66699 10.7807 2.78628 11.9 4.16699 11.9C5.5477 11.9 6.66699 10.7807 6.66699 9.40002Z"
                                            stroke="#55585C" stroke-width="1.5" />
                                        <path
                                            d="M18.334 15.2334C18.334 13.8527 17.2147 12.7334 15.834 12.7334C14.4533 12.7334 13.334 13.8527 13.334 15.2334C13.334 16.6141 14.4533 17.7334 15.834 17.7334C17.2147 17.7334 18.334 16.6141 18.334 15.2334Z"
                                            stroke="#55585C" stroke-width="1.5" />
                                        <path d="M13.3333 3.9834L6.25 7.7334" stroke="#55585C" stroke-width="1.5"
                                            stroke-linecap="round" />
                                        <path d="M13.3333 14.8167L6.25 11.0667" stroke="#55585C" stroke-width="1.5"
                                            stroke-linecap="round" />
                                    </svg>
                                    Chia sẻ
                                </li>
                                <li class="social-media__item social-media__item--facebook">
                                    <a title="Chia sẻ lên Facebook"
                                        href="https://www.facebook.com/sharer.php?u={{ urlencode(route('front.show-product-detail', $product->slug)) }}"
                                        target="_blank" rel="noopener" aria-label="Chia sẻ lên Facebook">
                                        <svg focusable="false" class="icon icon--facebook" viewBox="0 0 30 30">
                                            <path
                                                d="M15 30C6.71572875 30 0 23.2842712 0 15 0 6.71572875 6.71572875 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15zm3.2142857-17.1429611h-2.1428678v-2.1425646c0-.5852979.8203285-1.07160109 1.0714928-1.07160109h1.071375v-2.1428925h-2.1428678c-2.3564786 0-3.2142536 1.98610393-3.2142536 3.21449359v2.1425646h-1.0714822l.0032143 2.1528011 1.0682679-.0099086v7.499969h3.2142536v-7.499969h2.1428678v-2.1428925z"
                                                fill="currentColor" fill-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social-media__item social-media__item--pinterest">
                                    <a title="Chia sẻ lên Pinterest"
                                        href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('front.show-product-detail', $product->slug)) }}&amp;"
                                        target="_blank" rel="noopener" aria-label="Pinterest">
                                        <svg focusable="false" class="icon icon--pinterest" role="presentation"
                                            viewBox="0 0 30 30">
                                            <path
                                                d="M15 30C6.71572875 30 0 23.2842712 0 15 0 6.71572875 6.71572875 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15zm-.4492946-22.49876954c-.3287968.04238918-.6577148.08477836-.9865116.12714793-.619603.15784625-1.2950238.30765013-1.7959124.60980792-1.3367356.80672832-2.26284291 1.74754848-2.88355361 3.27881599-.1001431.247352-.10374313.4870343-.17702448.7625149-.47574032 1.7840923.36779138 3.6310327 1.39120339 4.2696951.1968419.1231267.6448551.3405257.8093833.0511377.0909873-.1603963.0706852-.3734014.1265202-.5593764.036883-.1231267.1532436-.3547666.1263818-.508219-.0455542-.260514-.316041-.4256572-.4299438-.635367-.230748-.4253041-.2421365-.8027267-.3541701-1.3723228.0084116-.0763633.0168405-.1527266.0253733-.2290899.0340445-.6372108.1384107-1.0968422.3287968-1.5502554.5593198-1.3317775 1.4578212-2.07273488 2.9088231-2.5163011.324591-.09899963 1.2400541-.25867013 1.7200175-.1523539.2867042.05078464.5734084.10156927.8600087.1523539 1.0390064.33760307 1.7953931.9602003 2.2007079 1.9316992.252902.6061594.3275507 1.7651044.1517724 2.5415071-.0833199.3679287-.0705641.6832289-.1770418 1.0168107-.3936666 1.2334841-.9709174 2.3763639-2.2765854 2.6942337-.8613761.2093567-1.5070793-.3321303-1.7200175-.8896824-.0589159-.1545509-.1598205-.4285603-.1011297-.6865243.2277711-1.0010987.5562045-1.8969797.8093661-2.8969995.24115-.9528838-.2166421-1.7048063-.9358863-1.8809146-.8949186-.2192233-1.585328.6350139-1.8211644 1.1943903-.1872881.4442919-.3005678 1.2641823-.1517724 1.8557085.0471811.1874265.2666617.689447.2276672.8640842-.1728187.7731269-.3685356 1.6039823-.5818373 2.3635745-.2219729.7906632-.3415527 1.5999416-.5564641 2.3639276-.098793.3507651-.0955738.7263439-.1770244 1.092821v.5337977c-.0739045.3379758-.0194367.9375444.0505042 1.2703809.0449484.2137505-.0261175.4786388.0758948.6357396.0020943.1140055.0159752.1388388.0506254.2031582.3168026-.0095136.7526829-.8673992.9106342-1.118027.3008274-.477913.5797431-.990879.8093833-1.5506281.2069844-.5042174.2391769-1.0621226.4046917-1.60104.1195798-.3894861.2889369-.843272.328918-1.2707535h.0252521c.065614.2342095.3033024.403727.4805692.5334446.5563429.4077482 1.5137774.7873678 2.5547742.5337977 1.1769151-.2868184 2.1141687-.8571599 2.7317812-1.702982.4549537-.6225776.7983583-1.3445472 1.0624066-2.1600633.1297394-.4011574.156982-.8454494.2529193-1.2711066.2405269-1.0661438-.0797199-2.3511383-.3794396-3.0497261-.9078995-2.11694836-2.8374975-3.32410832-5.918897-3.27881604z"
                                                fill="currentColor" fill-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social-media__item social-media__item--twitter">
                                    <a title="Chia sẻ lên Twitter"
                                        href="https://twitter.com/share?url={{ urlencode(route('front.show-product-detail', $product->slug)) }}"
                                        target="_blank" rel="noopener" aria-label="Tweet on Twitter">
                                        <svg focusable="false" class="icon icon--twitter" role="presentation"
                                            viewBox="0 0 30 30">
                                            <path
                                                d="M15 30C6.71572875 30 0 23.2842712 0 15 0 6.71572875 6.71572875 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15zm3.4314771-20.35648929c-.134011.01468929-.2681239.02905715-.4022367.043425-.2602865.05139643-.5083383.11526429-.7319208.20275715-.9352275.36657324-1.5727317 1.05116784-1.86618 2.00016964-.1167278.3774214-.1643635 1.0083696-.0160821 1.3982464-.5276368-.0006268-1.0383364-.0756643-1.4800457-.1737-1.7415129-.3873214-2.8258768-.9100285-4.02996109-1.7609946-.35342035-.2497018-.70016357-.5329286-.981255-.8477679-.09067071-.1012178-.23357785-.1903178-.29762142-.3113357-.00537429-.0025553-.01072822-.0047893-.0161025-.0073446-.13989429.2340643-.27121822.4879125-.35394965.7752857-.32626393 1.1332446.18958607 2.0844643.73998215 2.7026518.16682678.187441.43731214.3036696.60328392.4783178h.01608215c-.12466715.041834-.34181679-.0159589-.45040179-.0360803-.25715143-.0482143-.476235-.0919607-.69177643-.1740215-.11255464-.0482142-.22521107-.09675-.3378675-.1449642-.00525214 1.251691.69448393 2.0653071 1.55247643 2.5503267.27968679.158384.67097143.3713625 1.07780893.391484-.2176789.1657285-1.14873321.0897268-1.47198429.0581143.40392643.9397285 1.02481929 1.5652607 2.09147249 1.9056375.2750861.0874928.6108975.1650857.981255.1593482-.1965482.2107446-.6162514.3825321-.8928439.528766-.57057.3017572-1.2328489.4971697-1.97873466.6450108-.2991075.0590785-.61700464.0469446-.94113107.0941946-.35834678.0520554-.73320321-.02745-1.0537875-.0364018.09657429.053325.19312822.1063286.28958036.1596536.2939775.1615821.60135.3033482.93309.4345875.59738036.2359768 1.23392786.4144661 1.93859037.5725286 1.4209286.3186642 3.4251707.175291 4.6653278-.1740215 3.4539354-.9723053 5.6357529-3.2426035 6.459179-6.586425.1416246-.5754053.162226-1.2283875.1527803-1.9126768.1716718-.1232517.3432215-.2465035.5148729-.3697553.4251996-.3074947.8236703-.7363286 1.118055-1.1591036v-.00765c-.5604729.1583679-1.1506672.4499036-1.8661597.4566054v-.0070232c.1397925-.0495.250515-.1545429.3619908-.2321358.5021089-.3493285.8288003-.8100964 1.0697678-1.39826246-.1366982.06769286-.2734778.13506429-.4101761.20275716-.4218407.1938214-1.1381067.4719375-1.689256.5144143-.6491893-.5345357-1.3289754-.95506074-2.6061215-.93461789z"
                                                fill="currentColor" fill-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 col-xl-6 col-detail">
                        <div class="position-sticky">
                            <div class="product-details">
                                <div class="product-details__productName">
                                    {{ $product->name }}
                                </div>
                                <div class="product-details__productReview">
                                    <div class="sapo-product-reviews-badge" data-id="38240550"></div>
                                </div>
                                <div class="product-details__priceBox">
                                    @if ($product->base_price > 0 && $product->price > 0)
                                        <span class="special-price">
                                            {{ formatCurrency($product->price) }}₫
                                        </span> <!-- Giá Khuyến mại -->
                                        <span class="old-price">
                                            {{ formatCurrency($product->base_price) }}₫
                                        </span> <!-- Giá gốca -->
                                    @elseif ($product->base_price > 0 && $product->price == 0)
                                        <span class="special-price">
                                            {{ formatCurrency($product->base_price) }}₫
                                        </span> <!-- Giá Khuyến mại -->
                                    @elseif ($product->base_price == 0 && $product->price > 0)
                                        <span class="special-price">
                                            {{ formatCurrency($product->price) }}₫
                                        </span> <!-- Giá Khuyến mại -->
                                    @else
                                        <span class="special-price">
                                            Liên hệ
                                        </span>
                                    @endif
                                </div>
                                <div class="product-details__summary">
                                    <div class="flex max-w-full flex-col flex-grow">
                                        <div data-message-model-slug="gpt-4o-mini"
                                            class="min-h-8 text-message flex w-full flex-col items-end gap-2 whitespace-normal break-words [.text-message+&amp;]:mt-5"
                                            dir="auto" data-message-id="70590153-f9bc-4025-991d-be647971961b"
                                            data-message-author-role="assistant">
                                            <div class="flex w-full flex-col gap-1 empty:hidden first:pt-[3px]">
                                                <div class="markdown prose w-full break-words dark:prose-invert light">
                                                    {!! $product->intro !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-unstyled">
                                    <div class="product-status">
                                        <span class="a-title">Tình trạng:</span>
                                        <span class="a-stock status">
                                            {{ $product->status == 1 ? 'Còn hàng' : 'Hết hàng' }}
                                        </span>
                                    </div>
                                    <div class="product-sku">
                                        <span class="a-title">Mã Sku:</span>
                                        <span class="a-content variant-sku">
                                            {{ $product->sku }}
                                        </span>
                                    </div>
                                    <div class="product-vendor">
                                        <span class="a-title">Thương hiệu:</span>
                                        <span class="a-content">
                                            {{ $product->origin }}
                                        </span>
                                    </div>
                                </div>
                                <form id="add-to-cart-form"
                                    class="product-details__productForm">
                                    <div class="product-options">
                                        @if (isset($product->attributes) && count($product->attributes) > 0)
                                            @foreach ($product->attributes as $index => $attribute)
                                                <div class=" swatch" data-option-index="{{ $index }}">
                                                    <div class="swatch-title">{{ $attribute['name'] }}: <span
                                                            class="value-roperties"></span></div>
                                                    <div class="swatch-lists">
                                                        @foreach ($attribute['values'] as $key => $value)
                                                        <div data-value="{{ $value }}" class="swatch-element  has-img ">
                                                            <input id="swatch-{{ $index }}-{{ $key }}-s" type="radio" name="option-{{ $index }}"
                                                                value="{{ $value }}" />
                                                            <label
                                                                class="d-inline-flex align-items-center justify-content-center"
                                                                title="{{ $value }}" for="swatch-{{ $index }}-{{ $key }}-s">
                                                                {{ $value }}
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="product-quantity">
                                        <div class="custom-btn-number d-flex align-items-center">
                                            <label>Số lượng:</label>
                                            <div class="custom clearfix input_number_product">
                                                <button
                                                    onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty) & qty > 1 ) result.value--;return false;"
                                                    class="btn-minus btn-cts" type="button">
                                                    <svg class="icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xlink:href="#iconMinus"></use>
                                                    </svg>
                                                </button>
                                                <input aria-label="Số lượng" type="text" class="qty input-text"
                                                    id="qty" name="quantity" size="4" value="1"
                                                    maxlength="3"
                                                    onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"
                                                    onchange="if(this.value == 0)this.value=1;" />
                                                <button
                                                    onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;"
                                                    class="btn-plus btn-cts" type="button">
                                                    <svg class="icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xlink:href="#iconPlus"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="product-buttons d-flex">
                                            <button type="submit" data-role='addtocart' class="btn-cart add_to_cart" ng-click="addToCartFromProductDetail()">
                                                <span class="text">Thêm vào giỏ</span>
                                            </button>
                                            <button type="button" class="btn-buy-now" data-id="128742280" ng-click="addToCartCheckoutFromProductDetail()"
                                                data-qty="1">
                                                Mua ngay
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="product-notice">
                                </div>
                                <div class="policy-product">
                                    <div class="policy-product__content">
                                        <div class="item">
                                            <div class="icon">
                                                <img loading="lazy" src="/site/images/icon_policy_1.png?1749442635129"
                                                    alt="Giao hàng toán quốc">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    Giao hàng toán quốc:
                                                </div>
                                                <p>
                                                    Thanh toán (COD) khi nhận hàng
                                                </p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="icon">
                                                <img loading="lazy" src="/site/images/icon_policy_2.png?1749442635129"
                                                    alt="Miễn phí giao hàng">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    Miễn phí giao hàng:
                                                </div>
                                                <p>
                                                    Theo chính sách
                                                </p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="icon">
                                                <img loading="lazy" src="/site/images/icon_policy_3.png?1749442635129"
                                                    alt="Đổi trả trong 7 ngày">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    Đổi trả trong 7 ngày:
                                                </div>
                                                <p>
                                                    Kể từ ngày mua hàng
                                                </p>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="icon">
                                                <img loading="lazy" src="/site/images/icon_policy_4.png?1749442635129"
                                                    alt="Hỗ trợ 24/7">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    Hỗ trợ 24/7:
                                                </div>
                                                <p>
                                                    Theo chính sách
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-tab-product">
                <div class="product-tab">
                    <div class="product-tab__nav">
                        <ul class="product-tab__title">
                            <li class="tab-link active" data-tab="#tab-1">
                                <h3>Thông tin sản phẩm</h3>
                            </li>
                            {{-- <li class="tab-link" data-tab="#tab-99">
                                <h3>Đánh giá sản phẩm</h3>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="product-tab__content">
                        <div id="tab-1" class="tab-content active">
                            <div class="rte product_getcontent product-review-content">
                                <div class="ba-text-fpt">
                                    {!! $product->body !!}
                                </div>
                                <div class="show-more d-none">
                                    <div class="btn--view-more">
                                        <span class="more-text">
                                            Xem thêm
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 1024 1024" class="icon" version="1.1">
                                                <path
                                                    d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z"
                                                    fill="#000000" />
                                            </svg>
                                        </span>
                                        <span class="less-text">
                                            Thu gọn
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 1024 1024" class="icon" version="1.1">
                                                <path
                                                    d="M903.232 768l56.768-50.432L512 256l-448 461.568 56.768 50.432L512 364.928z"
                                                    fill="#000000" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="tab-99" class="tab-content content_extab">
                            <div id="sapo-product-reviews" class="sapo-product-reviews" data-id="38240550">
                                <div id="sapo-product-reviews-noitem" style="display: none;">
                                    <div class="content">
                                        <p data-content-text="language.suggest_noitem"></p>
                                        <div class="product-reviews-summary-actions">
                                            <button type="button" class="btn-new-review"
                                                onclick="BPR.newReview(this); return false;"
                                                data-content-str="language.newreview"></button>
                                        </div>
                                        <div id="noitem-bpr-form_" data-id="formId" class="noitem-bpr-form"
                                            style="display:none;">
                                            <div class="sapo-product-reviews-form"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            @if ($productsRelated->count() > 0)
                <div class="product-relate">
                    <h2>
                        <a href="javascript:;" title="Sản phẩm liên quan">Sản phẩm liên quan</a>
                    </h2>
                    <div class="product-relate-swiper swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($productsRelated as $item)
                                <div class="swiper-slide">
                                    @include('site.products.product_item', ['product' => $item])
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                var ch = $('.product_getcontent').height(),
                    smore = $('.show-more');
                if (ch > 850) {
                    $('.ba-text-fpt').addClass('has-height');
                    smore.removeClass('d-none');
                }
            }, 200);
            $('.btn--view-more').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                $this.parents('.tab-content').find('.product_getcontent').toggleClass('expanded');
                $('html, body').animate({
                    scrollTop: $('.product_getcontent').offset().top - 110
                });
                $(this).toggleClass('active');
                return false;
            });
        });






        var selectorWrappers = document.querySelectorAll('.selector-wrapper');
        selectorWrappers.forEach(function(selectorWrapper) {
            selectorWrapper.style.textAlign = 'left';
            selectorWrapper.style.marginBottom = '15px';
        });




        function handleRadioChange(event) {
            var target = event.target;
            console.log(target);
            var optionIndex = target.closest('.swatch').getAttribute('data-option-index');
            var optionValue = target.value;

            var form = target.closest('form');
            var optionSelectors = form.querySelectorAll('.single-option-selector');
            // var targetOptionSelector = optionSelectors[optionIndex];
            // console.log(targetOptionSelector);

            // targetOptionSelector.value = optionValue;
            // targetOptionSelector.dispatchEvent(new Event('change'));

            var valuePropertiesElement = target.closest('.swatch').querySelector('.swatch-title .value-roperties');
            if (valuePropertiesElement) {
                valuePropertiesElement.innerHTML = optionValue;
            }
        }

        var swatchRadios = document.querySelectorAll('.swatch input[type="radio"]');
        swatchRadios.forEach(function(radio) {
            radio.addEventListener('change', handleRadioChange);
        });

        setTimeout(function() {
            // Select all elements with the class 'swatch-element' inside '.swatch'
            var swatchElements = document.querySelectorAll('.swatch .swatch-element');

            swatchElements.forEach(function(element) {
                // Find the closest '.swatch' ancestor
                var swatchElement = element.closest('.swatch');
                if (swatchElement) {
                    // Find the checked radio input within the closest '.swatch'
                    var checkedInput = swatchElement.querySelector('input:checked');
                    // Find the '.header .value-roperties' element within the closest '.swatch'
                    var valuePropertiesElement = swatchElement.querySelector(
                        '.swatch-title .value-roperties');
                    if (checkedInput && valuePropertiesElement) {
                        // Set the inner HTML to the value of the checked input
                        valuePropertiesElement.innerHTML = checkedInput.value;
                    }
                }
            });
        }, 200);
    </script>
    <script>
        function activeTab(obj) {
            var liElements = document.querySelectorAll('.product-tab ul li');
            liElements.forEach(function(li) {
                li.classList.remove('active');
            });
            obj.classList.add('active');
            var id = obj.getAttribute('data-tab');
            var tabContentElements = document.querySelectorAll('.tab-content');
            tabContentElements.forEach(function(tabContent) {
                tabContent.classList.remove('active');
            });
            var activeTabContent = document.querySelector(id);
            if (activeTabContent) {
                activeTabContent.classList.add('active');
            }
        }
        var liElements = document.querySelectorAll('.product-tab ul li');
        liElements.forEach(function(li) {
            li.addEventListener('click', function() {
                activeTab(this);
            });
        });
        $(document).ready(function() {
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 10,
                slidesPerView: 6,
                freeMode: true,
                lazy: true,
                direction: 'vertical',
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                //hashNavigation: true,
                slideToClickedSlide: true,
                navigation: {
                    nextEl: '.gallery-thumbs .swiper-button-next',
                    prevEl: '.gallery-thumbs .swiper-button-prev',
                },
                breakpoints: {
                    300: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                        direction: 'horizontal'
                    },
                    500: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                        direction: 'horizontal'
                    },
                    640: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                        direction: 'horizontal'
                    },
                    768: {
                        slidesPerView: 6,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                    },
                    1199: {
                        slidesPerView: 6,
                        spaceBetween: 10,
                    },
                }
            });
            var galleryTop = new Swiper('.gallery-top', {
                spaceBetween: 0,
                hashNavigation: false,
                thumbs: {
                    swiper: galleryThumbs
                },
                navigation: {
                    nextEl: '.gallery-top .swiper-button-next',
                    prevEl: '.gallery-top .swiper-button-prev',
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var relateSwiper = new Swiper('.product-relate-swiper', {
                slidesPerView: 4,
                spaceBetween: 30,
                slidesPerGroup: 1,
                navigation: {
                    nextEl: '.product-relate-swiper .swiper-button-next',
                    prevEl: '.product-relate-swiper .swiper-button-prev',
                },
                breakpoints: {
                    280: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    },
                    1199: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    }
                }
            });
        });
    </script>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.countdown-content').each(function() {
                const $container = $(this);
                const key = 'countdown_end_time'; // localStorage key
                const timeStr = $container.data('time'); // "HH:MM:SS"
                const timeParts = timeStr.split(':').map(Number);
                const cycleSeconds = timeParts[0] * 3600 + timeParts[1] * 60 + timeParts[2];

                function setNewEndTime() {
                    const newEnd = Date.now() + cycleSeconds * 1000;
                    localStorage.setItem(key, newEnd);
                    return newEnd;
                }

                // Lấy endTime từ localStorage hoặc khởi tạo mới
                let endTime = parseInt(localStorage.getItem(key), 10);
                if (!endTime || isNaN(endTime) || endTime <= Date.now()) {
                    endTime = setNewEndTime();
                }

                function updateDisplay(secondsLeft) {
                    const hrs = String(Math.floor(secondsLeft / 3600)).padStart(2, '0');
                    const mins = String(Math.floor((secondsLeft % 3600) / 60)).padStart(2, '0');
                    const secs = String(secondsLeft % 60).padStart(2, '0');

                    const $numbers = $container.find('.countdown-item-number');
                    $numbers.eq(0).text(hrs);
                    $numbers.eq(1).text(mins);
                    $numbers.eq(2).text(secs);
                }

                updateDisplay(Math.floor((endTime - Date.now()) / 1000)); // Hiển thị ban đầu

                setInterval(function() {
                    const now = Date.now();
                    let remainingSeconds = Math.floor((endTime - now) / 1000);

                    if (remainingSeconds <= 0) {
                        endTime = setNewEndTime(); // Reset lại thời gian mới
                        remainingSeconds = cycleSeconds;
                    }

                    updateDisplay(remainingSeconds);
                }, 1000);
            });
        });

        // Plus number quantiy product detail
        var plusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal)) {
                    jQuery('input[name="quantity"]').val(currentVal + 1);
                } else {
                    jQuery('input[name="quantity"]').val(1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        // Minus number quantiy product detail
        var minusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    jQuery('input[name="quantity"]').val(currentVal - 1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        app.controller('ProductDetailController', function($scope, $http, $interval, cartItemSync, $rootScope, $compile) {
            $scope.product = @json($product);
            $scope.form = {
                quantity: 1
            };

            $scope.selectedAttributes = [];
            jQuery('.product-attribute-values .badge').click(function() {
                if (!jQuery(this).hasClass('active')) {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).addClass('active');
                    if ($scope.selectedAttributes.length > 0 && $scope.selectedAttributes.find(item => item
                            .index == jQuery(this).data('index'))) {
                        $scope.selectedAttributes.find(item => item.index == jQuery(this).data('index'))
                            .value = jQuery(this).data('value');
                    } else {
                        let index = jQuery(this).data('index');
                        $scope.selectedAttributes.push({
                            index: index,
                            name: jQuery(this).data('name'),
                            value: jQuery(this).data('value'),
                        });
                    }
                } else {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).removeClass('active');
                    $scope.selectedAttributes = $scope.selectedAttributes.filter(item => item.index !=
                        jQuery(this).data('index'));
                }
                $scope.$apply();
            });

            $scope.addToCartFromProductDetail = function() {
                let quantity = $('#add-to-cart-form input[name="quantity"]').val();

                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
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
                            toastr.success('Thao tác thành công !')
                            $scope.noti_product = response.noti_product;
                            $scope.$applyAsync();

                            if (window.innerWidth < 768) {
                                $('#popup-cart-mobile').addClass('active');
                            } else {
                                $('#popup-cart-desktop').addClass('active');
                            }
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
            }

            $scope.addToCartCheckoutFromProductDetail = function() {
                let quantity = $('#add-to-cart-form input[name="quantity"]').val();
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
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
                            toastr.success('Thao tác thành công !')
                            window.location.href = "{{ route('cart.checkout') }}";
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endpush
