@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection

@section('css')
    <link href="/site/css/breadcrumb.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/page.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
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
                <li><strong><span>{{ $title }}</span></strong></li>
            </ul>
        </div>
    </div>
    <section class="page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="page__title">{{ $title }}</h1>
                    <div class="page__content rte">
                        {!! $content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
