<footer class="footer">
    <div class="mid-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-12 col-left">
                    <div class="logo-social-footer item-effect">
                        <a href="{{ route('front.home-page') }}" title="{{ $config->web_title }}" class="logo-footer">
                            <img width="173" height="60"
                                src="{{ $config->image ? $config->image->path : 'http://placehold.co/173x60' }}"
                                alt="{{ $config->web_title }}" />
                        </a>
                        <div class="social-footer">
                            <h4>
                                KẾT NỐI
                            </h4>
                            <div class="social-share">
                                <a class="icon-tiktok"
                                    href="{{ $config->tiktok_link }}"
                                    title="Theo dõi TikTok" target="_blank" rel="noreferrer">
                                    <svg>
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xlink:href="#IconTikTok"></use>
                                    </svg>
                                </a>
                                <a class="icon-instagram" href="{{ $config->instagram_link }}"
                                    title="Theo dõi Instagram" target="_blank" rel="noreferrer">
                                    <svg>
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xlink:href="#IconInstagram"></use>
                                    </svg>
                                </a>
                                <a class="icon-facebook" href="{{ $config->facebook_link }}" title="Theo dõi Facebook"
                                    target="_blank" rel="noreferrer">
                                    <svg>
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xlink:href="#IconFacebook"></use>
                                    </svg>
                                </a>
                                <a class="icon-youtube" href="{{ $config->youtube_link }}" title="Theo dõi Youtube"
                                    target="_blank" rel="noreferrer">
                                    <svg>
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xlink:href="#IconYoutube"></use>
                                    </svg>
                                </a>
                                <a class="icon-twitter" href="{{ $config->twitter_link }}" title="Theo dõi Twitter"
                                    target="_blank" rel="noreferrer">
                                    <svg>
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xlink:href="#IconTwitter"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-12 col-right">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 link_list col-footer item-effect">
                            <h4 class="title-menu">
                                {{ $config->short_name_company }}
                            </h4>
                            <div class="contact-footer">
                                <div class="item">
                                    Số ĐKKD {{ $config->tax_code }} cấp ngày {{ $config->tax_date }} tại {{ $config->tax_place }}
                                </div>
                                <div class="item">
                                    <strong>Địa chỉ:</strong>
                                    {{ $config->address_company }}
                                </div>
                                <div class="item">
                                    <strong>Email:</strong>
                                    <a href="mailto:{{ $config->email }}"
                                        title="{{ $config->email }}">{{ $config->email }}</a>
                                </div>
                                <div class="item">
                                    <strong>Hotline:</strong>
                                    <a class="fone" href="tel:{{ str_replace(' ', '', $config->hotline) }}" title="{{ $config->hotline }}">{{ $config->hotline }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 link_list col-footer item-effect">
                            <h4 class="title-menu">
                                VỀ CHÚNG TÔI
                                <span class="Collapsible__Plus"></span>
                            </h4>
                            <div class="list-menu hidden-mobile">
                                <a href="{{ route('front.about-us') }}" title="Giới thiệu">Giới thiệu</a>
                                @foreach ($product_categories as $product_category)
                                    <a href="{{ route('front.show-product-category', $product_category->slug) }}" title="{{ $product_category->name }}">{{ $product_category->name }}</a>
                                @endforeach
                                @foreach ($post_categories as $post_category)
                                    <a href="{{ route('front.list-blog', $post_category->slug) }}" title="{{ $post_category->name }}">{{ $post_category->name }}</a>
                                @endforeach
                                <a href="{{ route('front.contact-us') }}" title="Liên hệ">Liên hệ</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 col-footer item-effect">
                            <div class="module-payment">
                                <h4 class="title-menu">
                                    DỊCH VỤ KHÁCH HÀNG
                                    <span class="Collapsible__Plus"></span>
                                </h4>
                                <div class="list-menu hidden-mobile">
                                    @foreach ($policies as $policy)
                                        <a href="{{ route('front.policy-detail', $policy->slug) }}" title="{{ $policy->title }}">{{ $policy->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright" class="copyright">
        <div class="container">
            <div class="border text-center item-effect">
                © Bản quyền thuộc về {{ $config->web_title }}
            </div>
        </div>
    </div>
</footer>
<div class="social-fixed social-tiktok">
    <a href="{{ $config->tiktok_link }}" title="Liên kết Tiktok Shop">
        <svg>
            <use xmlns:xlink="http://www.w3.org/1999/xlink" href="#IconTikTok"></use>
        </svg>
    </a>
</div>
<div class="social-fixed social-shopee">
    <a href="{{ $config->shopee_link }}" title="Liên kết Shopee Shop">
        <svg>
            <use xmlns:xlink="http://www.w3.org/1999/xlink" href="#IconShopee"></use>
        </svg>
    </a>
</div>
<div class="social-fixed social-mess-facebook">
    <a href="{{ $config->facebook_link }}" title="Liên hệ qua tin nhắn Facebook">
        <svg>
            <use xmlns:xlink="http://www.w3.org/1999/xlink" href="#iconMessFaceBook"></use>
        </svg>
    </a>
</div>
<div class="social-fixed">
    <a href="#" class="backtop" id="scrollToTopBtn" title="Lên đầu trang">
        <svg>
            <use xmlns:xlink="http://www.w3.org/1999/xlink" href="#iconBackTop"></use>
        </svg>
    </a>
</div>