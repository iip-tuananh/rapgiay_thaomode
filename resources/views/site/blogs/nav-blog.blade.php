<div class="blog-search">
    <form action="{{ route('front.search') }}" method="get" class="position-relative" role="search">
        <input type="text" name="keyword_blog" placeholder="Tìm kiếm tin" autocomplete="off" />
        <button type="submit" aria-label="Tìm kiếm">
            <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" href="#iconSearch"></use>
            </svg>
        </button>
    </form>
</div>
<div class="blog-advise">
    <h2>
        <a href="javascript:void(0)" title="Bài viết mới nhất">
            Bài viết mới nhất
        </a>
    </h2>
    <div class="list-blog">
        @foreach ($newBlogs as $blog)
        <div class="item-blog  ">
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
                <h3>
                    <a href="{{ route('front.detail-blog', $blog->slug) }}"
                        title="{{ $blog->name }}">{{ $blog->name }}</a>
                </h3>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="blog-cate">
    <h2>
        Danh mục tin tức
    </h2>
    <div class="category-navigation">
        <ul>
            <li class="nav-item  position-relative">
                <a title="Trang chủ" class="nav-link" href="{{ route('front.home-page') }}">Trang chủ</a>
            </li>
            @foreach ($productCategories as $productCategory)
            <li class="nav-item  position-relative">
                <a title="{{ $productCategory->name }}" href="{{ route('front.show-product-category', $productCategory->slug) }}" class="nav-link pr-5">{{ $productCategory->name }}</a>
                @if ($productCategory->childs->count() > 0)
                <i class="open_mnu down_icon"></i>
                <ul class="menu_down" style="display:none;">
                    @foreach ($productCategory->childs as $child)
                    <li class="dropdown-submenu nav-item  position-relative">
                        <a title="{{ $child->name }}" class="nav-link pr-5" href="{{ route('front.show-product-category', $child->slug) }}">{{ $child->name }}</a>
                        @if ($child->childs->count() > 0)
                        <i class="open_mnu down_icon"></i>
                        <ul class="menu_down" style="display:none;">
                            @foreach ($child->childs as $child2)
                            <li class="nav-item">
                                <a title="{{ $child2->name }}" class="nav-link pl-4" href="{{ route('front.show-product-category', $child2->slug) }}">{{ $child2->name }}</a>
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
            @foreach ($categories as $cate)
            <li class="nav-item active position-relative">
                <a title="{{ $cate->name }}" class="nav-link" href="{{ route('front.list-blog', $cate->slug) }}">{{ $cate->name }}</a>
            </li>
            @endforeach
            <li class="nav-item  position-relative">
                <a title="Liên hệ" class="nav-link" href="{{ route('front.contact-us') }}">Liên hệ</a>
            </li>
        </ul>
    </div>
</div>
<script>
    document.querySelectorAll('.open_mnu').forEach(function(menu) {
        menu.addEventListener('click', function() {
            this.classList.toggle('cls_mn');
            const nextElement = this.nextElementSibling;
            if (nextElement) {
                if (nextElement.style.display === 'none' || nextElement.style.display === '') {
                    nextElement.style.display = 'block';
                } else {
                    nextElement.style.display = 'none';
                }
            }
        });
    });
</script>
@if ($tag_search_all->count() > 0)
<div class="blog-tags">
    <h2>
        Từ khóa phổ biến
    </h2>
    <ul>
        @foreach ($tag_search_all as $tag)
        <li><a href="{{ route('front.search', ['tag' => $tag->name]) }}">{{ $tag->name }}</a></li>
        @endforeach
    </ul>
</div>
@endif