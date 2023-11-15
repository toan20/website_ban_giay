<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">

    <title>GS Shop</title>



    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link type="image/x-icon" href="/assets_trangchu/images/fav-icon.png" rel="icon">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/shoes.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- JavaScript Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
</head>

<body>
    <div class="main" id="main">
        <header class="header transition">
            <div class="container position-r">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-6 align-flax">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="http://127.0.0.1:8000">
                                <img alt="log" src="/assets_trangchu/images/logo.png" class="transition ">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-8 col-6 position-i">
                        <div class="menu-left transition">
                            <div class="menu">
                                <ul>
                                    <li>
                                        <a href="http://127.0.0.1:8000">Trang Chủ</a>
                                    </li>
                                    @foreach ($menuCha as $key => $value_cha)
                                        <li class="dropdown">
                                            <span class="opener plus"></span>
                                            <a
                                                href="/danh-muc/{{ $value_cha->slug_danh_muc }}-post{{ $value_cha->id }}">{{ $value_cha->ten_danh_muc }}</a>
                                            <div class="megamenu">
                                                <div class="megamenu-inner">
                                                    <ul>
                                                        @foreach ($menuCon as $value_con)
                                                            @if ($value_con->id_danh_muc_cha == $value_cha->id)
                                                                <li><a
                                                                        href="/danh-muc/{{ $value_con->slug_danh_muc }}-post{{ $value_con->id }}">{{ $value_con->ten_danh_muc }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="search-right">
                            <div class="menu-toggle"><span></span></div>
                            <div class="search-menu">
                                <form action="/search" method="post">
                                    @csrf
                                    <input type="text" name="search" id="searchSanPham" class="search-input"
                                        placeholder="Tên sản phẩm">
                                    <input type="submit" name="submit" class="search-btn">
                                    <div class="search-button-i transition">
                                        <img src="/assets_trangchu/images/search.png" class="position-r transition"
                                            alt="search">
                                    </div>
                                </form>
                            </div>

                            <ul class="login-cart" style="display: flex">
                                @if (Auth::guard('agent')->check())
                                    <li>
                                        <div class="login-head">
                                            <a href="/agent/logout"><i class="fas fa-right-from-bracket"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <div class="login-head">
                                            <a href="http://127.0.0.1:8000/agent/login"><i class="fa fa-user-o"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <div class="cart-menu">
                                        <div class="cart-icon position-r">
                                            <img src="/assets_trangchu/images/car-icon-w.png"
                                                class="position-r transition" alt="cart">
                                        </div>
                                        <div class="cart-dropdown header-link-dropdown">
                                            <ul id="app" class="cart-list link-dropdown-list">
                                                <li>
                                                    <template v-for="(value, key) in listCart">
                                                        <a href="javascript:void(0)" class="close-cart"><i
                                                                class="fa fa-times-circle"></i></a>
                                                        <figure>
                                                            <a href="" class="pull-left">
                                                                <img alt="product" v-bind:src="value.hinh_anh">
                                                            </a>
                                                            <figcaption>
                                                                <span>
                                                                    <a href="">@{{ value.ten_san_pham }}</a>
                                                                </span>
                                                                <p class="cart-price">@{{ formatNumber(value.don_gia) }}</p>
                                                                <div class="product-qty">
                                                                    <label>Số Lượng</label>
                                                                    <div class="custom-qty">
                                                                        <input type="text" name="qty"
                                                                            maxlength="8"
                                                                            v-on:change="updateRow(value)"
                                                                            v-model="value.so_luong" title="Qty"
                                                                            class="input-text qty" disabled>
                                                                    </div>
                                                                </div>
                                                            </figcaption>
                                                        </figure>
                                                </li>
                                            </ul>
                                            </template>
                                            <p id="app" class="cart-sub-totle">
                                                <span class="pull-left">Tổng tiền </span>
                                                <span class="pull-right"><strong
                                                        class="price-box">@{{ formatNumber(total()) }}</strong></span>
                                            </p>
                                            </template>

                                            <div class="clearfix"></div>
                                            <div class="mt-20">
                                                <a href="http://127.0.0.1:8000/cart" class="btn">Giỏ hàng</a>
                                                <a href="http://127.0.0.1:8000/chi-tiet-bill"
                                                    class="btn btn-color right-side">Đơn Hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                @if (Auth::guard('agent')->check())
                                    <li>
                                        <div class="cart-menu">
                                            <div class="cart-icon position-r">
                                                <i class="fa-solid fa-circle-info fa-lg"
                                                    style="    font-size: 27px;
                                                font-weight: 800;
                                                padding-top: 24px;"></i>
                                            </div>
                                            <div class="cart-dropdown header-link-dropdown">
                                                <p class="cart-sub-totle" style="display:flex;flex-direction: column">
                                                    <span class="pull-left">
                                                        {{ Auth::guard('agent')->user()->ho_va_ten }} </span>
                                                    <span class="pull-left">Số điện thoại:
                                                        {{ Auth::guard('agent')->user()->so_dien_thoai }} </span>
                                                    <span class="pull-left"><a target="_blank"
                                                            href="/updateIF/{{ Auth::guard('agent')->id() }}"
                                                            class="btn">Thay đổi thông tin</a> </span>
                                                </p>
                                                <p class="mt-5">
                                                <div class="alert alert-info">
                                                    <p>Update Avatar</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <input id="img" class="form-control"
                                                                    type="text"
                                                                    placeholder="upload your img here!">
                                                                <input type="button" id="lfm"class="btn-info lfm"
                                                                    data-input="img" data-preview="img_view"
                                                                    value="Upload">
                                                            </div>
                                                            <img id="img_view"
                                                                style="margin-top:15px;max-height:200px;width:100px;border-radius: 50%">
                                                        </div>
                                                    </div>
                                                </div>
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="home-banner">
            <div class="container">
                <div class="home-slider owl-carousel">
                    <div class="banner-bg align-flax">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 align-flax "style="height:400px">
                                    @if (isset($config->slide_1) && Str::length($config->slide_1) > 0)
                                        <div class="banner-img">
                                            <img src="{{ $config->slide_1 }}" data-thumb="{{ $config->slide_1 }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 align-flax">
                                    <div class="banner-heading w-100">
                                        <label class="banner-top">Get UP To <span>40%</span> Off</label>
                                        <h2 class="banner-title">men <span>shoes</span></h2>
                                        <p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                            Donec odio. Quisque volutpat mattis eros.</p>
                                        <a href="/danh-muc/{{ $value_cha->slug_danh_muc }}-post{{ $value_cha->id }}"
                                            class="btn">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-bg align-flax">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 align-flax "style="height:300px">
                                    @if (isset($config->slide_2) && Str::length($config->slide_2) > 0)
                                        <div class="banner-img">
                                            <img src="{{ $config->slide_2 }}" data-thumb="{{ $config->slide_2 }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 align-flax">
                                    <div class="banner-heading w-100">
                                        <label class="banner-top">Get UP To <span>40%</span> Off</label>
                                        <h2 class="banner-title">season <span>sale</span></h2>
                                        <p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                            Donec odio. Quisque volutpat mattis eros.</p>
                                        <a href="" class="btn">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-bg align-flax">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 align-flax "style="height:300px">
                                    @if (isset($config->slide_3) && Str::length($config->slide_3) > 0)
                                        <div class="banner-img">
                                            <img src="{{ $config->slide_3 }}" data-thumb="{{ $config->slide_3 }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 align-flax">
                                    <div class="banner-heading w-100">
                                        <label class="banner-top">Get UP To <span>40%</span> Off</label>
                                        <h2 class="banner-title">season <span>sale</span></h2>
                                        <p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                            Donec odio. Quisque volutpat mattis eros.</p>
                                        <a href="" class="btn">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="featured pt-100">
            <div class="container">
                <div class="row mb-25">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="hading">
                            <h2 class="hading-title">Sản Phẩm <span>Nổi Bật</span></h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <ul id="tabs"
                            class="product-isotop filters-product text-right text-uppercase nav nav-tabs"
                            role="tablist">
                            @foreach ($menuCha as $key => $value)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" role="tab"
                                        data-toggle="tab"
                                        href="#tab_{{ $value->id }}">{{ $value->ten_danh_muc }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    @foreach ($menuCha as $key => $value)
                        <div role="tabpanel" class="row tab-pane fade {{ $key == 0 ? 'active show' : '' }}"
                            id="tab_{{ $value->id }}">
                            @foreach ($allSanPham as $key_sp => $value_sp)
                                @if (in_array($value_sp->danh_muc_id, explode(',', $value->tmp)))
                                    <div class="featured-product mb-25">
                                        <div class="product-img transition mb-15">
                                            <a
                                                href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}">
                                                <img src="{{ $value_sp->hinh_anh }}" class="transition">
                                            </a>
                                            <div class="new-label">
                                                <span
                                                    class="text-uppercase">{{ number_format((($value_sp->don_gia_ban - $value_sp->don_gia_khuyen_mai) / $value_sp->don_gia_ban) * 100, 2) }}<span
                                                        class="symbol-percent">%</span>
                                            </div>
                                            @if ($value_sp->don_gia_khuyen_mai > 0)
                                                <li>
                                                    <div class="sale-label">
                                                        <span class="text-uppercase">sale</span>
                                                    </div>
                                                </li>
                                            @else
                                            @endif
                                            <div class="product-details-btn text-uppercase text-center transition">
                                                <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                                    class="quick-popup mfp-iframe">Quick View</a>
                                            </div>
                                        </div>
                                        <div class="product-desc">
                                            <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                                class="product-name text-uppercase">{{ $value_sp->ten_san_pham }}</a>
                                            <del
                                                class="prev-price">{{ number_format($value_sp->don_gia_ban, 0) }}</del>
                                            <span
                                                class="product-pricce">{{ number_format($value_sp->don_gia_khuyen_mai, 0) }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if ($key_sp > 15)
                        @break
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="offer-banner pt-70">
        <div class="container">
            <div class="offer-bg bg text-center ptb-120">
                {{-- <label class="banner-top text-uppercase">Sale <span>OFF 50%</span></label>
						<h1 class="banner-title text-uppercase"><span>Mùa Đông</span> Năng Động</h1>
						<p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
						<a href="" class="btn">Shop now</a> --}}
            </div>
        </div>
    </section>
    <section class="best-seller pt-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="hading pb-20">
                                <h2 class="hading-title">Giảm giá<span> cao nhất</span></h2>
                            </div>
                            <div class="seller">
                                @foreach ($allSanPham as $key_sp => $value_sp)
                                    @if ($value_sp->don_gia_khuyen_mai < $value_sp->don_gia_ban / 1.8)
                                        <div class="seller-box align-flax w-100 pb-20">
                                            <div class="seller-img">
                                                <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                                    class="display-b">
                                                    <img src="{{ $value_sp->hinh_anh }}" alt="shoes"
                                                        class="transition">
                                                </a>
                                            </div>
                                            <div class="seller-contain pl-15">
                                                <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                                    class="product-name text-uppercase">{{ $value_sp->ten_san_pham }}</a>
                                                <span
                                                    class="product-pricce">{{ number_format($value_sp->don_gia_khuyen_mai, 0) }}
                                                    đ</span>
                                            </div>
                                        </div>
                                        @if ($key_sp > 8)
                                        @break
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="hading pb-20">
                            <h2 class="hading-title">Mua <span>Nhiều nhất</span></h2>
                        </div>
                        <div class="seller">
                            @foreach ($allSanPham as $key_sp => $value_sp)
                                @if ($value_sp->don_gia_khuyen_mai > $value_sp->don_gia_ban / 1.8)
                                    <div class="seller-box align-flax w-100 pb-20">

                                        <div class="seller-img">
                                            <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                                class="display-b">
                                                <img src="{{ $value_sp->hinh_anh }}" alt="shoes"
                                                    class="transition">
                                            </a>
                                        </div>
                                        <div class="seller-contain pl-15">
                                            <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                                class="product-name text-uppercase">{{ $value_sp->ten_san_pham }}</a>
                                            <span
                                                class="product-pricce">{{ number_format($value_sp->don_gia_khuyen_mai, 0) }}
                                                đ</span>
                                        </div>
                                    </div>
                                    @if ($key_sp > 4)
                                    @break
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="offer-week">
                <div class="row align-flax">
                    @foreach ($allSanPham as $key_sp => $value_sp)
                        @if ($value_sp->don_gia_khuyen_mai < $value_sp->don_gia_ban / 2)

                            <div class="col-xl-5 col-lg-5 col-md-5">
                                <div class="week-img transition">
                                    <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                        class="display-b">
                                        <img src="{{ $value_sp->hinh_anh }}" class="w-100"
                                            alt="shoes">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7">
                                <div class="week-contain">
                                    <h2 class="week-head text-uppercase pb-15">Sự kiện trong tuần</h2>
                                    <p class="week-sub">Sản phẩm duy nhất giảm giá hơn 50%</p>
                                    <a href="/san-pham/{{ $value_sp->slug_san_pham }}-post{{ $value_sp->id }}"
                                        class="product-name text-uppercase">{{ $value_sp->ten_san_pham }}</a>
                                    <div class="star-rating pb-10">
                                        <input id="star-5" type="radio" name="rating"
                                            value="star-5" />
                                        <label for="star-5" title="5 stars" class="transition">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-4" type="radio" name="rating"
                                            value="star-4" checked />
                                        <label for="star-4" title="4 stars" class="transition">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-3" type="radio" name="rating"
                                            value="star-3" />
                                        <label for="star-3" title="3 stars" class="transition">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-2" type="radio" name="rating"
                                            value="star-2" />
                                        <label for="star-2" title="2 stars" class="transition">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-1" type="radio" name="rating"
                                            value="star-1" />
                                        <label for="star-1" title="1 star" class="transition">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="price-d pb-25">
                                        <label
                                            class="price-r pr-30">{{ number_format($value_sp->don_gia_ban) }}
                                            đ</label>
                                        <label
                                            class="product-pricce">{{ number_format($value_sp->don_gia_khuyen_mai) }}
                                            đ</label>
                                    </div>
                                    @if ($key_sp > 1)
                                    @break
                                @endif
                    @endif
                @endforeach
                <ul class="countdown text-uppercase">
                    <li class="text-center">
                        <span id="days" class="counter-timer display-b text-center">07</span>
                        <label class="day-name">days</label>
                    </li>
                    <li class="text-center">
                        <span id="hours" class="counter-timer display-b text-center">10</span>
                        <label class="day-name">hour</label>
                    </li>
                    <li class="text-center">
                        <span id="minutes" class="counter-timer display-b text-center">25</span>
                        <label class="day-name">min</label>
                    </li>
                    <li class="text-center">
                        <span id="seconds" class="counter-timer display-b text-center">60</span>
                        <label class="day-name">sec</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>

{{-- <section class="team pt-100">
				<div class="container">
					<div class="team-inner owl-carousel">
						<div class="team-slide text-center">
							<div class="team-img position-r">
								<img src="/assets_trangchu/images/team-1.jpg" alt="team">
								<span class="quote-c"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
							</div>
							<div class="team-desc">
								<p class="member-detail">make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was make a type specimen book. It has survived not only five centuries.</p>
								<h3 class="member-name text-uppercase">john Doe</h3>
							</div>
						</div>
						<div class="team-slide text-center">
							<div class="team-img position-r">
								<img src="/assets_trangchu/images/team-1.jpg" alt="team">
								<span class="quote-c"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
							</div>
							<div class="team-desc">
								<p class="member-detail">make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was make a type specimen book. It has survived not only five centuries.</p>
								<h3 class="member-name text-uppercase">john Doe</h3>
							</div>
						</div>
						<div class="team-slide text-center">
							<div class="team-img position-r">
								<img src="/assets_trangchu/images/team-1.jpg" alt="team">
								<span class="quote-c"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
							</div>
							<div class="team-desc">
								<p class="member-detail">make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was make a type specimen book. It has survived not only five centuries.</p>
								<h3 class="member-name text-uppercase">john Doe</h3>
							</div>
						</div>
					</div>
				</div>
			</section> --}}

{{-- <section class="latest-blog pt-100">
				<div class="container">
					<div class="latest-blog-inner">
						<div class="hading pb-20">
							<h2 class="hading-title">latest<span>blog</span></h2>
						</div>
						<div class="latest-blog-salid owl-carousel">
							<div class="row align-flax pr-30">
								<div class="col-xl-5 col-lg-5 col-md-5">
									<div class="latest-blog-img">
										<a href="blog-detail.html" class="display-b">
											<img src="/assets_trangchu/images/blog-1.jpg" alt="blog">
										</a>
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7">
									<div class="lat-blog-desc">
										<a href="blog-detail.html" class="lat-blog-title text-uppercase">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
										<p class="lat-blog-date text-uppercase"><span>john doe</span> - APRIL 18, 2015 AT 5.00 PM</p>
										<p class="lat-blog-detail">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even</p>
										<a href="blog-detail.html" class="btn-2">Read More</a>
									</div>
								</div>
							</div>
							<div class="row align-flax pr-30">
								<div class="col-xl-5 col-lg-5 col-md-5">
									<div class="latest-blog-img">
										<a href="blog-detail.html" class="display-b">
											<img src="/assets_trangchu/images/blog-2.jpg" alt="blog">
										</a>
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7">
									<div class="lat-blog-desc">
										<a href="blog-detail.html" class="lat-blog-title text-uppercase">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
										<p class="lat-blog-date text-uppercase"><span>john doe</span> - APRIL 18, 2015 AT 5.00 PM</p>
										<p class="lat-blog-detail">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even</p>
										<a href="blog-detail.html" class="btn-2">Read More</a>
									</div>
								</div>
							</div>
							<div class="row align-flax pr-30">
								<div class="col-xl-5 col-lg-5 col-md-5">
									<div class="latest-blog-img">
										<a href="blog-detail.html" class="display-b">
											<img src="/assets_trangchu/images/blog-1.jpg" alt="blog">
										</a>
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7">
									<div class="lat-blog-desc">
										<a href="blog-detail.html" class="lat-blog-title text-uppercase">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
										<p class="lat-blog-date text-uppercase"><span>john doe</span> - APRIL 18, 2015 AT 5.00 PM</p>
										<p class="lat-blog-detail">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even</p>
										<a href="blog-detail.html" class="btn-2">Read More</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section> --}}

<div class="brand pt-100">
<div class="container">
<div class="brand-salider owl-carousel">
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-1.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-2.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-3.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-4.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-5.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-6.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-1.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-2.jpg" alt="brand"
            class="transition"></a>
</div>
<div class="brand-box text-center">
    <a href="#"><img src="/assets_trangchu/images/brand-4.jpg" alt="brand"
            class="transition"></a>
</div>
</div>
</div>
</div>

{{-- <section class="newsletter pt-100">
				<div class="container">
					<div class="newsletter-inner text-center ptb-100">
						<h2 class="newsletter-title">Đăng ký để nhận thông báo</h2>
						<p class="newsletter-sub">Nhận thông báo mới nhất | Đăng ký miễn phí</p>
						<form>
						  <div class="form-group">
						    <input type="email" class="form-control" placeholder="Your email address" required>
						  </div>
						  <button type="submit" class="form-btn text-uppercase">
							<span href="http://127.0.0.1:8000/agent/dangky"class="sub-r">Subscribe</span>
							<i class="fa fa-send icon-r"></i>
						</button>
						</form>
					</div>
				</div>
			</section> --}}

<div class="top-scrolling">
<a href="#main" class="scrollTo"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<footer class="footer pt-100">
<div class="container">
<div class="footer-inner">
<div class="footer-box">
    <div class="footer-logo">
        <a href="index.html"><img src="/assets_trangchu/images/logo.png" alt="logo"></a>
    </div>
    <p class="footer-desc">Lorem ipsum dolor sit amet, consectetur adipi-scing elit. In purus sem,
        consectetur sed aliquam vel, hendrerit in elit. Nunc interdum dolor at quam pulvinar sodales.
        Nunc venenatis egestas mi ac fermentum.</p>
</div>
<div class="footer-box footer-static">
    <span class="opener plus"></span>
    <h2 class="footer-title text-uppercase">Our company</h2>
    <ul class="footer-block-contant">
        <li><a href="#">My Account</a></li>
        <li><a href="#">Order History</a></li>
        <li><a href="wishlist.html">Wish List</a></li>
        <li><a href="#">Newsletter</a></li>
        <li><a href="#">Site Map</a></li>
        <li><a href="#">Gift Certificates</a></li>
    </ul>
</div>
<div class="footer-box footer-static">
    <span class="opener plus"></span>
    <h2 class="footer-title text-uppercase">Information</h2>
    <ul class="footer-block-contant">
        <li><a href="about.html">About Us</a></li>
        <li><a href="#">Delivery Information</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms & Conditions</a></li>
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="#">Brands</a></li>
    </ul>
</div>
<div class="footer-box footer-static m-0">
    <span class="opener plus"></span>
    <h2 class="footer-title text-uppercase">Your Account</h2>
    <ul class="footer-block-contant">
        <li><a href="#">Running Shoes</a></li>
        <li><a href="#">Football Shoes</a></li>
        <li><a href="#">Basketball Shoes</a></li>
        <li><a href="#">Volleyball Shoes</a></li>
        <li><a href="#">Trainee Shoes</a></li>
    </ul>
</div>
<div class="footer-box footer-contact footer-static m-0">
    <span class="opener plus"></span>
    <h2 class="footer-title text-uppercase">Contact us</h2>
    <ul class="footer-block-contant">
        <li><img src="/assets_trangchu/images/cont-1.png" alt="img"><span>28 Green Tower, Street
                Name <br>New York City, USA</span></li>
        <li><img src="/assets_trangchu/images/cont-2.png" alt="img"><a
                href="tel:+911234567890">+ 8453908607</a></li>
        <li><img src="/assets_trangchu/images/cont-3.png" alt="img"><a
                href="mailto:xpoge@example.com">congking34200.py@gmail.com</a></li>
    </ul>
</div>
</div>
<div class="copy-right mt-100">
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12">
        <p class="copyright-text">&#169;GS SHop all Rights Reserverd theme by <a
                href="https://templatescoder.com/" target="_blank">TemplatesCoder</a></p>
    </div>
    {{-- <div class="col-xl-6 col-lg-6 col-md-12">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
								</ul>
							</div> --}}
</div>
</div>
</div>
</footer>
</div>

<script src="/assets_trangchu/js/jquery-3.4.1.min.js"></script>
<script src="/assets_trangchu/js/bootstrap.min.js"></script>
{{-- <script src="/assets_trangchu/js/jquery.magnific-popup.min.js"></script> --}}
<script src="/assets_trangchu/js/owl.carousel.min.js"></script>
<script src="/assets_trangchu/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
<script>
    /* ------------ Newslater-popup JS Start ------------- */
    $(window).on('load', function() {
        setTimeout(function() {
            mfp = $.magnificPopup.instance;
            if (!mfp.isOpen) {
                jQuery.magnificPopup.open({
                    items: {
                        src: '#newslater-popup'
                    },
                    type: 'inline'
                }, 0);
            }
        }, 10000)
    });

</script>
<script>
    new Vue({
        el: '#app',
        data: {
            listCart: [],
            tong_tien: 0,
        },
        created() {
            this.loadCart();
        },
        methods: {
            loadCart() {
                axios
                    .get('/cart/data')
                    .then((res) => {
                        this.listCart = res.data.data;
                    });
            },
            formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            },
            total() {
                var tong_tien = 0;
                this.listCart.forEach((value, key) => {
                    tong_tien += value.don_gia * value.so_luong;
                });
                return tong_tien;
            }
        },

    });
</script>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        $("#saveAvatar").click(function(e) {
            e.preventDefault();

            var avatar = $("#img").val();

            var avatarData = {
                'img': img,
            };

            $.ajax({
                url: '/img/',
                type: 'post',
                data: avatarData,
                success: function(res) {
                    if (res.status) {
                        toastr.success('up avatar done!');
                    }
                },
                error: function(res) {
                    var errros = res.responseJSON.errors;
                    $.each(errros, function(key, value) {
                        toastr.error(value[0]);
                    });
                }
            });
        });
        $("#searchSanPham").keyup(function() {
            var search = $("#searchSanPham").val();
            console.log(search);

        });

    })
</script>
@endsection
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/63a31c59b0d6371309d581e1/1gkqidg5f';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>

</html>
