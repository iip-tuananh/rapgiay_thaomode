@extends('site.layouts.master')
@section('title')
    {{ $blog_title }}
@endsection
@section('description')
    {{ strip_tags($blog->intro) }}
@endsection
@section('image')
    {{ $blog->image->path }}
@endsection

@section('css')
    <link href="/site/css/breadcrumb.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/blog_article_style.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/sidebar_style.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <style>
        .text-limit-3-line {
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="layout-article" itemscope itemtype="https://schema.org/Article">
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
                        <a href="{{ route('front.list-blog', $category->slug) }}"><span>{{ $category->name }}</span></a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="#fff"
                                d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                            </path>
                        </svg>
                    </li>
                    <li><strong><span>{{ $blog_title }}</span></strong></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <article class="article-main">
                        <div class="article-details">
                            <div class="article-title"><a
                                    href="{{ route('front.detail-blog', $blog->slug) }}">{{ $blog_title }}</a></div>
                            <div class="time-post">
                                <span class="icon posted">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.4"
                                            d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                    </svg>
                                    {{ $blog->created_at->format('d/m/Y') }}
                                </span>
                                <span class="author">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.4"
                                            d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    By Admin
                                </span>
                            </div>
                            <div class="rte" data-content>
                                <div class="toc-wrapper">
                                    <div class="toc-title open bold">Nội dung bài viết</div>
                                    <div class="js-toc"></div>
                                </div>
                                <div class="js-toc-content">
                                    {!! $blog->body !!}
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 col-12 sidebar-blog">
                    @include('site.blogs.nav-blog', [
                        'categories' => $categories,
                        'productCategories' => $productCategories,
                        'newBlogs' => $newBlogs,
                    ])
                </div>
            </div>
        </div>
    </div>
    <div class="article-lq">
        <div class="container">
            <div class="aside-title">
                <a href="javascript:void(0)" title=">Bài viết liên quan">Bài viết liên quan</a>
            </div>
            <div class="relate-swiper swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($other_blogs as $other_blog)
                        <div class="swiper-slide">
                            <div class="item-blog  ">
                                <div class="block-thumb">
                                    <a class="thumb-blog" href="{{ route('front.detail-blog', $other_blog->slug) }}"
                                        title="{{ $other_blog->name }}">
                                        <img loading="lazy"
                                            src="{{ $other_blog->image ? $other_blog->image->path : 'http://placehold.co/600x400' }}"
                                            alt="{{ $other_blog->name }}">
                                    </a>
                                </div>
                                <div class="block-info">
                                    <div class="time-post">
                                        <span class="posted">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.4"
                                                    d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                            </svg>
                                            {{ $other_blog->created_at->format('d/m/Y') }}
                                        </span>
                                        <span class="author">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.4"
                                                    d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            By Admin
                                        </span>
                                    </div>
                                    <h3>
                                        <a href="{{ route('front.detail-blog', $other_blog->slug) }}"
                                            title="{{ $other_blog->name }}">{{ $other_blog->name }}</a>
                                    </h3>
                                    <div class="article-content">
                                        {!! $other_blog->intro !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
    <div id="fixed-toc" class="fixed-toc">
        <button class="btn toc-toggle-btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M61.77 401l17.5-20.15a19.92 19.92 0 0 0 5.07-14.19v-3.31C84.34 356 80.5 352 73 352H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h22.83a157.41 157.41 0 0 0-11 12.31l-5.61 7c-4 5.07-5.25 10.13-2.8 14.88l1.05 1.93c3 5.76 6.29 7.88 12.25 7.88h4.73c10.33 0 15.94 2.44 15.94 9.09 0 4.72-4.2 8.22-14.36 8.22a41.54 41.54 0 0 1-15.47-3.12c-6.49-3.88-11.74-3.5-15.6 3.12l-5.59 9.31c-3.72 6.13-3.19 11.72 2.63 15.94 7.71 4.69 20.38 9.44 37 9.44 34.16 0 48.5-22.75 48.5-44.12-.03-14.38-9.12-29.76-28.73-34.88zM496 224H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM16 160h64a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H64V40a8 8 0 0 0-8-8H32a8 8 0 0 0-7.14 4.42l-8 16A8 8 0 0 0 24 64h8v64H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8zm-3.91 160H80a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H41.32c3.29-10.29 48.34-18.68 48.34-56.44 0-29.06-25-39.56-44.47-39.56-21.36 0-33.8 10-40.46 18.75-4.37 5.59-3 10.84 2.8 15.37l8.58 6.88c5.61 4.56 11 2.47 16.12-2.44a13.44 13.44 0 0 1 9.46-3.84c3.33 0 9.28 1.56 9.28 8.75C51 248.19 0 257.31 0 304.59v4C0 316 5.08 320 12.09 320z" />
            </svg>
        </button>
        <div class="fixed-toc-content">
            <div class="toc-title mb-2 open font-weight-bold">Nội dung bài viết</div>
            <span class="toc-toggle-btn toc-toggle-btn position-absolute">
                <svg class="icon" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip99)">
                        <path
                            d="M0.620965 12C0.462896 12 0.304826 11.9399 0.184729 11.8189C-0.0563681 11.5778 -0.0563681 11.1869 0.184729 10.9458L10.9497 0.180823C11.1908 -0.0602744 11.5817 -0.0602744 11.8228 0.180823C12.0639 0.421921 12.0639 0.8128 11.8228 1.05405L1.05795 11.8189C0.936954 11.9392 0.778884 12 0.620965 12Z"
                            fill="#8C9196" />
                        <path
                            d="M11.3867 12C11.2287 12 11.0707 11.9399 10.9505 11.8189L0.184729 1.05405C-0.0563681 0.8128 -0.0563681 0.421921 0.184729 0.180823C0.425827 -0.0602744 0.816706 -0.0602744 1.05795 0.180823L11.8228 10.9458C12.0639 11.1869 12.0639 11.5778 11.8228 11.8189C11.7018 11.9392 11.5439 12 11.3867 12Z"
                            fill="#8C9196" />
                    </g>
                    <defs>
                        <clipPath id="clip99">
                            <rect width="12" height="12" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </span>
            <div class="js-toc-bottom">
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tocbot/4.4.2/tocbot.min.js" type="text/javascript"></script>
    <script>
        if ($('[data-content]').html().includes('h2') || $('[data-content]').html().includes('h3') || $('[data-content]')
            .html().includes('h4')) {
            $('.toc-wrapper').show();
            const tocHeadings = "h1,h2,h3,h4";

            function toSlug(string) {
                return string.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-$/, '').replace(/^-/, '');
            }
            $('.js-toc-content :header').each(function() {
                let heading = $(this)
                heading.attr('id', toSlug(heading.text()))
            })
            tocbot.init({
                tocSelector: '.js-toc',
                contentSelector: '.js-toc-content',
                headingSelector: tocHeadings,
                hasInnerContainers: true,
                isCollapsedClass: 'is-collapsedd',
                collapsibleClass: 'is-collapsibled',
                activeListItemClass: '',
                activeLinkClass: 'is-active-link',
                collapseDepth: 8,
                headingsOffset: 85,
                scrollSmoothOffset: -85,
                scrollSmooth: true
            })

            $('.toc-title').click(function() {
                $(this).toggleClass('open')
                $('.js-toc').slideToggle()
            })
            $('.fixed-toc-content').append($('.js-toc').html())
            $('.toc-list-item').length ? $('.toc-title').addClass('active') : $('.fixed-toc').remove()
            $('.toc-toggle-btn').click(function() {
                $(this).parents('.fixed-toc').toggleClass('open')
            })
            let observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $('.fixed-toc').removeClass('open').hide()
                    } else {
                        $('.fixed-toc').show()
                    }
                });
            }, {
                threshold: 0,
            });
            document.querySelectorAll('.toc-wrapper').forEach(div => {
                observer.observe(div)
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var swiper = new Swiper('.relate-swiper', {
                slidesPerView: 3,
                spaceBetween: 20,
                grabCursor: false,
                navigation: {
                    nextEl: '.article-lq .swiper-button-next',
                    prevEl: '.article-lq .swiper-button-prev',
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                        touchRatio: 1,
                        loop: false,
                    },
                    991: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                        touchRatio: 1,
                        loop: false,
                    },
                    767: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                        touchRatio: 1,
                        loop: false,
                    },
                    480: {
                        slidesPerGroup: 1,
                        spaceBetween: 0,
                        touchRatio: 1,
                        loop: false,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                        touchRatio: 1,
                        loop: false,
                    }
                }
            });



            var productArticleSwiper = new Swiper('.product-article-swiper .swiper-container', {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: false,
                grabCursor: true,
                roundLengths: true,
                slideToClickedSlide: false,
                navigation: {
                    nextEl: '.product-article-swiper .swiper-button-next',
                    prevEl: '.product-article-swiper .swiper-button-prev',
                },
                autoplay: false,
                breakpoints: {
                    300: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    500: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    991: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>
@endsection

@push('script')
@endpush
