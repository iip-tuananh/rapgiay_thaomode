<form class="variants product-action" data-cart-form data-id="product-actions-{{$product->id}}"
    enctype="multipart/form-data">
    <div class="product-thumbnail">
        <a class="thumb" href="{{route('front.show-product-detail', $product->slug)}}" title="{{$product->name}}">
            <img width="360" height="360" loading="lazy"
                src="{{$product->image ? $product->image->path : 'https://placehold.co/360x360' }}"
                alt="{{$product->name}}">
            <img width="360" height="360" loading="lazy"
                src="{{$product->image ? $product->image->path : 'https://placehold.co/360x360' }}"
                alt="{{$product->name}}" />
        </a>
        <span class="smart">-
            {{round(($product->base_price - $product->price) / $product->base_price * 100)}}%
        </span>
        <div class="list-action-bottom d-lg-block d-none">
            <a title="Xem chi tiết" href="{{route('front.show-product-detail', $product->slug)}}">
                Xem chi tiết
            </a>
        </div>
    </div>
    <div class="product-swatchs">
        <div class="item-swatch colors  {{ $product->image->name }}"
            data-image="{{$product->image ? $product->image->path : 'https://placehold.co/360x360' }}">
            <a href="{{route('front.show-product-detail', $product->slug)}}"
                data-image="{{$product->image ? $product->image->path : 'https://placehold.co/360x360' }}"
                style="background-image: url({{$product->image ? $product->image->path : 'https://placehold.co/360x360' }}); background-size: cover;">
            </a>
        </div>
        @foreach ($product->galleries as $gallery)
        <div class="item-swatch colors  {{ $gallery->image->name }}"
            data-image="{{$gallery->image ? $gallery->image->path : 'https://placehold.co/360x360' }}">
            <a href="{{route('front.show-product-detail', $product->slug)}}"
                data-image="{{$gallery->image ? $gallery->image->path : 'https://placehold.co/360x360' }}"
                style="background-color:#000000; background-image: url({{$gallery->image ? $gallery->image->path : 'https://placehold.co/360x360' }}); background-size: cover;">
            </a>
        </div>
        @endforeach
    </div>
    <div class="product-info">
        <h3 class="product-info__name">
            <a href="{{route('front.show-product-detail', $product->slug)}}" title="{{$product->name}}">
                {{$product->name}}
            </a>
        </h3>
        @if ($product->price > 0 && $product->base_price > 0)
        <div class="product-info__price">
            {{formatCurrency($product->price)}}₫&nbsp;
            <span class="compare-price">{{formatCurrency($product->base_price)}}₫</span>
        </div>
        @elseif ($product->price > 0 && $product->base_price == 0)
        <div class="product-info__price">
            {{formatCurrency($product->price)}}₫
        </div>
        @elseif ($product->price == 0 && $product->base_price > 0)
        <div class="product-info__price">
            {{formatCurrency($product->base_price)}}₫
        </div>
        @else
        <div class="product-info__price">
            Liên hệ
        </div>
        @endif
    </div>
</form>
