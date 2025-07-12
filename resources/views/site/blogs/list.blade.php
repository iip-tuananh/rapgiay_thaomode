@extends('site.layouts.master')
@section('title')
    {{ $cate_title }}
@endsection
@section('description')
    {{ $cate_des ?? '' }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
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
    <div class="layout-blog" itemscope itemtype="https://schema.org/Blog">
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
                    <li><strong><span>{{ $cate_title }}</span></strong></li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="block-blog">
                        <div class="list-blogs">
                            @foreach ($blogs as $blog)
                            <div class="item-blog  item-effect">
                                <div class="block-thumb">
                                    <a class="thumb-blog"
                                        href="{{ route('front.detail-blog', $blog->slug) }}"
                                        title="{{ $blog->name }}">
                                        <img loading="lazy"
                                            src="{{ $blog->image ? $blog->image->path : 'http://placehold.co/600x400' }}"
                                            alt="{{ $blog->name }}">
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
                                            {{ $blog->created_at->format('d/m/Y') }}
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
                                        <a href="{{ route('front.detail-blog', $blog->slug) }}"
                                            title="{{ $blog->name }}">{{ $blog->name }}</a>
                                    </h3>
                                    <div class="article-content">
                                        {!! $blog->intro !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="pagenav">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 sidebar-blog">
                    @include('site.blogs.nav-blog', ['categories' => $categories, 'productCategories' => $productCategories, 'newBlogs' => $newBlogs])
                </div>
            </div>
        </div>
    </div>
    <div class="ab-module-article-mostview"></div>
@endsection

@push('script')
@endpush
