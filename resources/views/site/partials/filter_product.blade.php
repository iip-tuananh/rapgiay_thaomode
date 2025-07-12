<div class="products-view products-view-grid">
    <div class="row row-fix">
        @foreach ($products as $product)
        <div class="col-6 col-md-4 col-xl-4 col-lg-4 col-fix">
            <div class="item_product_main">
                @include('site.products.product_item', ['product' => $product])
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="pagenav">
    {{$products->links()}}
</div>