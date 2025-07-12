@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $short_des }}
@endsection
@section('css')
    <link href="/site/css/breadcrumb.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/sidebar_style.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/collection_style.scss.css?1749442635129" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
    <div class="layout-collection" ng-controller="ProductCategoryController">
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
        <div class="container">
            @if (isset($category->childs) && $category->childs->count() > 0)
                <div class="category-top-swiper swiper-container item-effect">
                    <div class="swiper-wrapper">
                        @foreach ($category->childs as $child)
                            <div class="swiper-slide">
                                <div class="thumb-cate">
                                    <a href="{{ route('front.show-product-category', $child->slug) }}"
                                        title="{{ $child->name }}">
                                        <img width="195" height="195" loading="lazy"
                                            src="{{ $child->image ? $child->image->path : 'http://placehold.co/195x195' }}"
                                            alt="{{ $child->name }}" />
                                    </a>
                                </div>
                                <div class="title">
                                    <a href="{{ route('front.show-product-category', $child->slug) }}"
                                        title="{{ $child->name }}">
                                        {{ $child->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <script>
                    $(document).ready(function() {
                        var swiperCategory = new Swiper('.category-top-swiper', {
                            slidesPerView: 5,
                            loop: false,
                            grabCursor: true,
                            roundLengths: true,
                            slideToClickedSlide: false,
                            spaceBetween: 30,
                            autoplay: {
                                delay: 3000,
                            },
                            navigation: {
                                nextEl: '.category-top-swiper .swiper-button-next',
                                prevEl: '.category-top-swiper .swiper-button-prev',
                            },
                            breakpoints: {
                                300: {
                                    slidesPerView: 2,
                                },
                                500: {
                                    slidesPerView: 2,
                                },
                                640: {
                                    slidesPerView: 3,
                                },
                                768: {
                                    slidesPerView: 4,

                                },
                                991: {
                                    slidesPerView: 4,

                                },
                                1200: {
                                    slidesPerView: 5,

                                }
                            }

                        });
                    });
                </script>
            @endif
            <div class="row">
                <div class="col-right col-lg-9 col-12">
                    <div class="title-page d-md-block d-none">{{ $title }}</div>
                    <div class="filter-container__selected" style="display: none;">
                        <div class="selected-content">
                            <ul class="selected-content__list">
                            </ul>
                        </div>
                    </div>
                    <div class="category-products">
                        <div id="sort-by">
                            <label class="left">Sắp xếp theo</label>
                            <ul class="ul_col">
                                <li>
                                    <span>
                                        Mặc định
                                    </span>
                                    <ul class="content_ul">
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'asc'}"
                                            ng-click="filterSort('asc')">Mặc định</a></li>
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'alpha-asc'}"
                                            ng-click="filterSort('alpha-asc')">A &rarr; Z</a></li>
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'alpha-desc'}"
                                            ng-click="filterSort('alpha-desc')">Z &rarr; A</a></li>
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'price-asc'}"
                                            ng-click="filterSort('price-asc')">Giá tăng dần</a></li>
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'price-desc'}"
                                            ng-click="filterSort('price-desc')">Giá giảm dần</a></li>
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'created-desc'}"
                                            ng-click="filterSort('created-desc')">Hàng mới nhất</a></li>
                                        <li><a href="javascript:;" ng-class="{'active': filter_sort == 'created-asc'}"
                                            ng-click="filterSort('created-asc')">Hàng cũ nhất</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div id="product-list">
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
                        </div>
                    </div>
                </div>
                <div class="col-sidebar col-left col-lg-3 col-12">
                    <div class="position-sticky">
                        @if (isset($category->childs) && $category->childs->count() > 0)
                            <aside class="aside-content aside-cate">
                                <div class="aside-cate__title">
                                    Danh mục sản phẩm
                                </div>
                                <div class="aside-cate__nav">
                                    <ul class="nav">
                                        @foreach ($category->childs as $child)
                                        <li class="nav-item  relative">
                                            <a title="{{ $child->name }}" class="nav-link" href="{{ route('front.show-product-category', $child->slug) }}">{{ $child->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                            <script>
                                var elements = document.querySelectorAll(".open_mnu");

                                elements.forEach(function(element) {
                                    element.addEventListener("click", function() {
                                        if (this.classList.contains("cls_mn")) {
                                            this.classList.remove("cls_mn");
                                        } else {
                                            this.classList.add("cls_mn");
                                        }

                                        var nextElement = this.nextElementSibling;

                                        if (window.getComputedStyle(nextElement).display === "none") {
                                            nextElement.style.display = "block";
                                        } else {
                                            nextElement.style.display = "none";
                                        }
                                    });
                                });
                            </script>
                        @endif
                        <aside class="aside-filter">
                            <div class="filter-container">
                                <div class="filter-container__content">
                                    <div class="filter-item filter-price">
                                        <div class="filter-item__title">Chọn mức giá</div>
                                        <div class="filter-item__content filter-group">
                                            <ul class="filter-list">
                                                <li class="filter-list__item" ng-repeat="item in priceRanges">
                                                    <span>
                                                        <label for="<% item.id %>">
                                                            <input type="checkbox" id="<% item.id %>"
                                                            ng-model="item.checked" ng-change="onChangeFilterPrice()">
                                                            <i class="fa"></i>
                                                            <% item.label %>
                                                        </label>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                        {{-- <script>
                            var Ego = {};
                            var selectedSortby;
                            var tt = 'Thứ tự';
                            var selectedViewData = "data";
                            var filter = new Bizweb.SearchFilter()
                            filter.addValue("collection", "collections", "3616348", "AND");

                            function toggleFilter(e) {
                                _toggleFilter(e);
                                renderFilterdItems();
                                doSearch(1);
                            }

                            function _toggleFilterdqdt(e) {
                                var element = e;
                                var group = 'Khoảng giá';
                                var field = 'price_min';
                                var operator = 'OR';
                                var value = element.getAttribute("data-value");
                                filter.deleteValuedqdt(group, field, value, operator);
                                filter.addValue(group, field, value, operator);
                                renderFilterdItems();
                                doSearch(1);
                            }

                            function _toggleFilter(e) {
                                var element = e;
                                var group = element.getAttribute("data-group");
                                var field = element.getAttribute("data-field");
                                var text = element.getAttribute("data-text");
                                var value = element.value;
                                var operator = element.getAttribute("data-operator");
                                var filterItemId = element.id;

                                if (!element.checked) {
                                    filter.deleteValue(group, field, value, operator);
                                } else {
                                    filter.addValue(group, field, value, operator);
                                }

                                var label = element.closest('label');
                                label.classList.toggle("active", element.checked);
                            }

                            function renderFilterdItems() {
                                var container = document.querySelector(".selected-content ul");
                                container.innerHTML = "";

                                var checkboxes = document.querySelectorAll(".filter-container input[type=checkbox]");
                                checkboxes.forEach(function(checkbox) {
                                    if (checkbox.checked) {
                                        var id = checkbox.id;
                                        var name = checkbox.closest("label").textContent;
                                        addFilteredItem(name, id);
                                    }
                                });

                                var selectedCheckboxes = document.querySelectorAll(".filter-item__content input[type=checkbox]:checked");
                                if (selectedCheckboxes.length > 0)
                                    document.querySelector(".filter-container__selected").style.display = "block";
                                else
                                    document.querySelector(".filter-container__selected").style.display = "none";
                            }

                            function addFilteredItem(name, id) {
                                var filteredItemTemplate =
                                    "<li class='selected-content__list__item' for='{3}'><a href='javascript:void(0)' onclick=\"{0}\">{1} <svg><use xmlns:xlink='http://www.w3.org/1999/xlink' href='#IconClose'></use></svg></a></li>";
                                filteredItemTemplate = filteredItemTemplate.replace("{0}", "removeFilteredItem('" + id + "')");
                                filteredItemTemplate = filteredItemTemplate.replace("{1}", name);
                                filteredItemTemplate = filteredItemTemplate.replace("{3}", id);

                                var container = document.querySelector(".selected-content ul");
                                container.insertAdjacentHTML("beforeend", filteredItemTemplate);

                                // Always append the clear all link at the end
                                var clearAllLink =
                                    "<li class='selected-content__list__item'><a href='javascript:void(0)' onclick='clearAllFiltered()' class='filter-container__clear-all selected-header__clearall' title='Xóa tất cả'>Xóa tất cả <svg><use xmlns:xlink='http://www.w3.org/1999/xlink' href='#IconClose'></use></svg></a></li>";

                                // Remove existing clear all link if it exists
                                var existingClearAll = container.querySelector(".filter-container__clear-all");
                                if (existingClearAll) {
                                    existingClearAll.parentElement.remove(); // Remove the <li> containing the link
                                }

                                // Add the clear all link as the last item in the list
                                container.insertAdjacentHTML("beforeend", clearAllLink);
                            }

                            function removeFilteredItem(id) {
                                var filterCheckbox = document.querySelector(".filter-container #" + id);
                                if (filterCheckbox) {
                                    filterCheckbox.click();
                                }
                            }

                            function filterItemInList(object) {
                                var q = object.value.toLowerCase();
                                var listItems = object.parentElement.nextElementSibling.querySelectorAll('li');
                                listItems.forEach(function(item) {
                                    item.style.display = "block";
                                    if (q.length > 0) {
                                        var label = item.querySelector('label');
                                        if (label && label.getAttribute("data-filter").indexOf(q) == -1) {
                                            item.style.display = "none";
                                        }
                                    }
                                });
                            }

                            function clearAllFiltered() {
                                filter = new Bizweb.SearchFilter();

                                filter.addValue("collection", "collections", "3616348", "AND");


                                var selectedContentList = document.querySelector(".selected-content ul");
                                selectedContentList.innerHTML = "";

                                var checkboxes = document.querySelectorAll(".filter-container input[type=checkbox]");
                                checkboxes.forEach(function(checkbox) {
                                    checkbox.checked = false;
                                });

                                var filterContainerSelected = document.querySelector(".filter-container__selected");
                                filterContainerSelected.style.display = "none";

                                doSearch(1);
                            }

                            function doSearch(page, options) {
                                if (!options) options = {};
                                //NProgress.start();
                                var asideMiniProductsListFilter = document.querySelector('.aside.aside-mini-products-list.filter');
                                if (asideMiniProductsListFilter) {
                                    asideMiniProductsListFilter.classList.remove('active');
                                }
                                //awe_showPopup('.loading');
                                filter.search({
                                    view: selectedViewData,
                                    page: page,
                                    sortby: selectedSortby,
                                    success: function(html) {
                                        var parser = new DOMParser();
                                        var doc = parser.parseFromString(html, 'text/html');
                                        var categoryProductsHtml = doc.querySelector('.category-products').innerHTML;
                                        document.querySelector(".category-products").innerHTML = categoryProductsHtml;
                                        pushCurrentFilterState({
                                            sortby: selectedSortby,
                                            page: page
                                        });
                                        resizeImages('.image_thumb');
                                        lazyLoadImages(theme.settings.lazyload);



                                        /*
                                        document.querySelector('.category-products').scrollIntoView({
                                            behavior: 'smooth'
                                        });
                                        */

                                        resortby(selectedSortby);
                                        document.querySelectorAll('.add_to_cart').forEach(function(button) {
                                            button.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                var form = button.closest('form');
                                                var formData = new FormData(form);
                                                var data = new URLSearchParams(formData).toString();

                                                fetch('/cart/add.js', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded'
                                                        },
                                                        body: data
                                                    })
                                                    .then(response => response.json())
                                                    .then(lineItem => {
                                                        ajaxCart.load();
                                                        if (window.innerWidth <= 767) {
                                                            document.querySelectorAll(
                                                                '.popup-cart-mobile, .backdrop__body-backdrop___1rvky'
                                                            ).forEach(function(el) {
                                                                el.classList.add('active');
                                                            });
                                                        } else {
                                                            document.querySelectorAll(
                                                                '.popup-cart-desktop, .backdrop__body-backdrop___1rvky'
                                                            ).forEach(function(el) {
                                                                el.classList.add('active');
                                                            });
                                                        }

                                                        AddCartMobile(lineItem);
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                    });
                                            });
                                        });
                                        document.querySelectorAll('.favorite-link').forEach(link => link.addEventListener('click',
                                            toggleFavorite));
                                        updateWishlist();
                                        setupSwatchHover();
                                        document.querySelectorAll('.btn-compare').forEach(button => button.addEventListener('click',
                                            toggleComparison));
                                        if (window.BPR !== undefined) {
                                            window.BPR.initDomEls();
                                            window.BPR.loadBadges();
                                        }
                                    }
                                });
                            }

                            function sortby(sort) {
                                var sortCateLeftItems = document.querySelectorAll('.sort-cate-left li');
                                sortCateLeftItems.forEach(function(item) {
                                    item.classList.remove('active');
                                });

                                switch (sort) {
                                    case "price-asc":
                                        selectedSortby = "price_min:asc";
                                        break;
                                    case "price-desc":
                                        selectedSortby = "price_min:desc";
                                        break;
                                    case "alpha-asc":
                                        selectedSortby = "name:asc";
                                        break;
                                    case "alpha-default":
                                        selectedSortby = "name:default";
                                        break;
                                    case "alpha-desc":
                                        selectedSortby = "name:desc";
                                        break;
                                    case "created-desc":
                                        selectedSortby = "created_on:desc";
                                        break;
                                    case "created-asc":
                                        selectedSortby = "created_on:asc";
                                        break;
                                    default:
                                        selectedSortby = "";
                                        break;
                                }

                                doSearch(1);
                            }

                            function resortby(sort) {
                                var tt;
                                switch (sort) {
                                    case "price_min:asc":
                                        tt = "Giá tăng dần";
                                        var priceAscItem = document.querySelector('.sort-cate-left .price-asc');
                                        if (priceAscItem) {
                                            priceAscItem.classList.add("active");
                                        }
                                        break;
                                    case "price_min:desc":
                                        tt = "Giá giảm dần";
                                        var priceDescItem = document.querySelector('.sort-cate-left .price-desc');
                                        if (priceDescItem) {
                                            priceDescItem.classList.add("active");
                                        }
                                        break;
                                    case "name:asc":
                                        tt = "A → Z";
                                        var alphaAscItem = document.querySelector('.sort-cate-left .alpha-asc');
                                        if (alphaAscItem) {
                                            alphaAscItem.classList.add("active");
                                        }
                                        break;
                                    case "name:default":
                                        tt = "Mặc định";
                                        var alphaDefaultItem = document.querySelector('.sort-cate-left .alpha-default');
                                        if (alphaDefaultItem) {
                                            alphaDefaultItem.classList.add("active");
                                        }
                                        break;
                                    case "name:desc":
                                        tt = "Z → A";
                                        var alphaDescItem = document.querySelector('.sort-cate-left .alpha-desc');
                                        if (alphaDescItem) {
                                            alphaDescItem.classList.add("active");
                                        }
                                        break;
                                    case "created_on:desc":
                                        tt = "Hàng mới nhất";
                                        var positionDescItem = document.querySelector('.sort-cate-left .position-desc');
                                        if (positionDescItem) {
                                            positionDescItem.classList.add("active");
                                        }
                                        break;
                                    case "created_on:asc":
                                        tt = "Hàng cũ nhất";
                                        break;
                                    default:
                                        tt = "Mặc định";
                                        var defaultItem = document.querySelector('.sort-cate-left .default');
                                        if (defaultItem) {
                                            defaultItem.classList.add("active");
                                        }
                                        break;
                                }
                                var sortBySpan = document.querySelector('#sort-by > ul > li > span');
                                if (sortBySpan) {
                                    sortBySpan.innerHTML = tt;
                                } else {
                                    console.error("Element not found for selector: #sort-by > ul > li > span");
                                }
                            }

                            function _selectSortby(sort) {
                                resortby(sort);
                                switch (sort) {
                                    case "price-asc":
                                        selectedSortby = "price_min:asc";
                                        break;
                                    case "price-desc":
                                        selectedSortby = "price_min:desc";
                                        break;
                                    case "alpha-asc":
                                        selectedSortby = "name:asc";
                                        break;
                                    case "alpha-default":
                                        selectedSortby = "name:default";
                                        break;
                                    case "alpha-desc":
                                        selectedSortby = "name:desc";
                                        break;
                                    case "created-desc":
                                        selectedSortby = "created_on:desc";
                                        break;
                                    case "created-asc":
                                        selectedSortby = "created_on:asc";
                                        break;
                                    default:
                                        selectedSortby = sort;
                                        break;
                                }
                            }

                            function toggleCheckbox(id) {
                                var checkbox = document.querySelector(id);
                                if (checkbox) {
                                    checkbox.click();
                                }
                            }

                            function pushCurrentFilterState(options) {
                                if (!options) options = {};
                                var url = filter.buildSearchUrl(options);
                                var queryString = url.slice(url.indexOf('?'));
                                if (selectedViewData == 'data_list') {
                                    queryString = queryString + '&view=list';
                                } else {
                                    queryString = queryString + '&view=grid';
                                }
                                pushState(queryString);
                            }

                            function pushState(url) {
                                window.history.pushState({
                                    turbolinks: true,
                                    url: url
                                }, null, url);
                            }

                            function switchView(view) {
                                switch (view) {
                                    case "list":
                                        selectedViewData = "data_list";
                                        break;
                                    default:
                                        selectedViewData = "data";
                                        break;
                                }
                                var url = window.location.href;
                                var page = getParameter(url, "page");
                                if (page != '' && page != null) {
                                    doSearch(page);
                                } else {
                                    doSearch(1);
                                }
                            }

                            function selectFilterByCurrentQuery() {
                                //awe_lazyloadImage();
                                lazyLoadImages(theme.settings.lazyload);
                                var isFilter = false;
                                var url = window.location.href;
                                var queryString = decodeURI(window.location.search);
                                var filters = queryString.match(/\(.*?\)/g);
                                var page = 0;
                                if (queryString) {
                                    isFilter = true;

                                    function urlParam(name) {
                                        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
                                        return results[1] || 0;
                                    }
                                    page = urlParam('page');
                                }
                                if (filters && filters.length > 0) {
                                    filters.forEach(function(item) {
                                        item = item.replace(/\(\(/g, "(");
                                        var element = document.querySelector(".filter-item__content input[value='" + item + "']");
                                        if (element) {
                                            element.checked = true;
                                            _toggleFilter(element);
                                        }
                                    });
                                    isFilter = true;
                                }
                                var sortOrder = getParameter(url, "sortby");
                                if (sortOrder) {
                                    _selectSortby(sortOrder);
                                }
                                if (isFilter) {
                                    doSearch(page);
                                    renderFilterdItems();
                                }
                            }

                            function getParameter(url, name) {
                                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                                    results = regex.exec(url);
                                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
                            }

                            document.addEventListener('DOMContentLoaded', function() {
                                window.addEventListener('popstate', function() {
                                    location.reload(true);
                                });
                                selectFilterByCurrentQuery();

                                var showAdminBarButton = document.getElementById('show-admin-bar');
                                if (showAdminBarButton) {
                                    showAdminBarButton.addEventListener('click', function(e) {
                                        var asideMiniProductsListFilter = document.querySelector(
                                            '.aside.aside-mini-products-list.filter');
                                        if (asideMiniProductsListFilter) {
                                            asideMiniProductsListFilter.classList.toggle('active');
                                        }
                                    });
                                }

                                var selectedHeaderTitle = document.querySelector('.selected-header-title');
                                if (selectedHeaderTitle) {
                                    selectedHeaderTitle.addEventListener('click', function(e) {
                                        var asideMiniProductsListFilter = document.querySelector(
                                            '.aside.aside-mini-products-list.filter');
                                        if (asideMiniProductsListFilter) {
                                            asideMiniProductsListFilter.classList.toggle('active');
                                        }
                                    });
                                }




                            });

                            document.querySelectorAll('.filter-item__title').forEach(function(title) {
                                title.addEventListener('click', function() {

                                    // Thêm class 'active' vào phần tử filter-item của phần tử được click
                                    this.closest('.filter-item').classList.toggle('active');
                                });
                            });

                            // Lấy tất cả các phần tử filter-item-toggle
                            var toggleItems = document.querySelectorAll('.filter-item-toggle');

                            toggleItems.forEach(function(toggle) {
                                toggle.addEventListener('click', function() {
                                    // Tương tự như toggleClass('show')
                                    this.classList.toggle('show');

                                    // Tìm các phần tử overflow-item trong cùng một phần tử cha
                                    var overflowItems = this.parentElement.querySelectorAll('.overflow-item');
                                    for (var i = 0; i < overflowItems.length; i++) {
                                        // Tương tự như toggleClass('show')
                                        overflowItems[i].classList.toggle('show');
                                    }

                                    // Thay đổi văn bản
                                    var text;
                                    if (!this.classList.contains('show')) {
                                        text =
                                            'Xem thêm <svg stroke-width="0" viewBox="0 0 512 512" color="#0B74E5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"></path></svg>';
                                    } else {
                                        text =
                                            'Thu gọn <svg stroke-width="0" viewBox="0 0 512 512" color="#0B74E5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256 217.9L383 345c9.4 9.4 24.6 9.4 33.9 0 9.4-9.4 9.3-24.6 0-34L273 167c-9.1-9.1-23.7-9.3-33.1-.7L95 310.9c-4.7 4.7-7 10.9-7 17s2.3 12.3 7 17c9.4 9.4 24.6 9.4 33.9 0l127.1-127z"></path></svg>';
                                    }
                                    this.innerHTML = text;
                                });
                            });
                        </script> --}}
                    </div>
                </div>
            </div>
            <div id="open-filters" class="open-filters d-lg-none d-xl-none">
                <i class="fa"></i>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        app.controller('ProductCategoryController', function($scope, $http) {
            $scope.category = @json($category ?? null);
            $scope.filter_sort = 'asc';
            $scope.filterSort = function(sort) {
                $scope.filter_sort = sort;
                $scope.filter();
            }

            $scope.filter_price = [];

            $scope.priceRanges = [{
                    id: 'price13',
                    value: '0:200000',
                    label: 'Dưới 200k',
                    checked: false
                },
                {
                    id: 'price14',
                    value: '200000:350000',
                    label: 'Từ 200k đến 350k',
                    checked: false
                },
                {
                    id: 'price15',
                    value: '350000:500000',
                    label: 'Từ 350k đến 500k',
                    checked: false
                },
                {
                    id: 'price16',
                    value: '500000:800000',
                    label: 'Từ 500k đến 800k',
                    checked: false
                },
                {
                    id: 'price17',
                    value: '800000:1000000',
                    label: 'Từ 800k đến 1 triệu',
                    checked: false
                },
                {
                    id: 'price18',
                    value: '1000000:100000000',
                    label: 'Trên 1 triệu',
                    checked: false
                }
            ];

            $scope.onChangeFilterPrice = function() {
                console.log(123);

                $scope.filter_price = $scope.priceRanges
                    .filter(function(item) {
                        return item.checked;
                    })
                    .map(function(item) {
                        return item.value;
                    });

                $scope.filter();
            };

            $scope.filter = function() {
                $.ajax({
                    url: '{{ route('front.filter-product') }}',
                    type: 'GET',
                    data: {
                        sort: $scope.filter_sort,
                        category: $scope.category.id,
                        cate_slug: $scope.category.slug,
                        price: $scope.filter_price
                    },
                    success: function(response) {
                        $('#product-list').html(response.html);
                    },
                    error: function(response) {
                        console.log(response);
                    },
                    complete: function() {}
                });
            }

            $scope.filterCategory = function(slug) {
                url = '{{ route('front.show-product-category', ['categorySlug' => ':categorySlug']) }}'
                    .replace(
                        ':categorySlug', slug);
                window.location.href = url;
            }
        });
    </script>
@endpush
