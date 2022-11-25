<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>Xpoge</title>

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
	</head>
	<body>

		{{-- <!-- Search Screen start -->
		<div class="sidebar-search-wrap">
		    <div class="sidebar-table-container">
			    <div class="sidebar-align-container">
			        <div class="search-closer right-side"></div>
			        <div class="search-container">
			          <form method="get" id="search-form">
			            <input type="text" id="s" class="search-input" name="s" placeholder="Search text">
			          </form>
			          <span>Search and Press Enter</span>
			        </div>
			    </div>
		    </div>
		</div>
		<!-- Search Screen end --> --}}
{{--
		<div id="newslater-popup" class="mfp-hide white-popup-block open align-center">
			<div class="nl-popup-main">
			    <div class="nl-popup-inner">
				    <div class="newsletter-inner">
				    	<div class="row">
				    		<div class="col-md-6"></div>
				    		<div class="col-md-6">
				    			<div class="mtb-30 text-center">
							        <h2 class="main_title">Subscribe Emails</h2>
							        <span class="sub-title mb-30">Sign up & get 10% off</span>
							        <form>
							        	<input type="email" placeholder="Email Here..." required>
							        	<button class="btn-color big-width btn" title="Subscribe">Subscribe</button>
							        </form>
							        <div class="check-box mt-30">
										<span>
			                            	<input type="checkbox" class="checkbox" id="different-address" name="Ship to a different address?">
			                            	<label for="different-address">Don`t show this popup again</label>
			                            </span>
		                            </div>
	                            </div>
					        </div>
				        </div>
				    </div>
			    </div>
			</div>
		</div> --}}

		<div class="main" id="main">
			<header class="header transition">
				<div class="container position-r">
					<div class="row">
						<div class="col-lg-2 col-md-4 col-6 align-flax">
				            <div class="navbar-header">
					            <a class="navbar-brand" href="index.html">
					                <img alt="log" src="/assets_trangchu/images/logo.png" class="transition">
					            </a>
				            </div>
					    </div>
					    <div class="col-lg-10 col-md-8 col-6 position-i">
					       	<div class="menu-left transition">
						        <div class="menu" >
						            <ul>
							            <li>
							                <a href="http://127.0.0.1:8000">Home</a>
							            </li>
                                        @foreach ($menuCha as $key=>$value_cha)
                                        <li class="dropdown">
							            	<span class="opener plus"></span>
							                <a href="shop.html">{{$value_cha->ten_danh_muc}}</a>
							                <div class="megamenu">
							                	<div class="megamenu-inner">
							                		<ul>
                                                        @foreach ( $menuCon as $value_con )
                                                        @if ($value_con->id_danh_muc_cha==$value_cha->id)
                                                        <li><a href="about.html">{{$value_con->ten_danh_muc}}</a></li>
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
						        	<input type="text" name="search" class="search-input" placeholder="Search text">
						        	<input type="submit" name="submit" class="search-btn">
						        	<div class="search-button-i transition">
						        		<img src="/assets_trangchu/images/search.png" class="position-r transition" alt="search">
						        	</div>
						        </div>
						        <ul class="login-cart">
                                    @if (Auth::guard('agent')->check())
                                    {{-- <li>
						        		<div class="login-head">
								        	<a href="http://127.0.0.1:8000/agent/login"><i class="fa fa-lock" aria-hidden="true"></i> {{Auth::guard('admin')->user()->ho_va_ten}}</a>
								        </div>
						        	</li> --}}
                                    @else
                                    <li>
						        		<div class="login-head">
								        	<a href="http://127.0.0.1:8000/agent/login"><i class="fa fa-user-o" aria-hidden="true"></i></a>
								        </div>
						        	</li>
                                    @endif

						        	<li>
						        		<div class="cart-menu">
								        	<div class="cart-icon position-r">
								        		<img src="/assets_trangchu/images/car-icon-w.png" class="position-r transition" alt="cart">
								        	</div>
								        	<div class="cart-dropdown header-link-dropdown">
												<ul class="cart-list link-dropdown-list">
													<li>
													  	<a href="javascript:void(0)" class="close-cart"><i class="fa fa-times-circle"></i></a>
													    <figure>
													    	<a href="product-detail.html" class="pull-left">
													    		<img alt="product" src="/assets_trangchu/images/product-1.jpg">
													    	</a>
													      	<figcaption>
													      		<span>
													      			<a href="product-detail.html">Men's Full Sleeves Collar Shirt</a>
													      		</span>
													        	<p class="cart-price">$14.99</p>
													        	<div class="product-qty">
													          		<label>Qty:</label>
													          		<div class="custom-qty">
													            		<input type="text" name="qty" maxlength="8" value="1" title="Qty" class="input-text qty" disabled>
													          		</div>
													        	</div>
													      	</figcaption>
													    </figure>
													</li>
													<li>
														<a class="close-cart"><i class="fa fa-times-circle"></i></a>
													    <figure>
													    	<a href="product-detail.html" class="pull-left">
													    		<img alt="product" src="/assets_trangchu/images/product-2.jpg">
													    	</a>
													      	<figcaption>
													      		<span>
													      			<a href="product-detail.html">Women's Cape Jacket</a>
													      		</span>
													        	<p class="cart-price">$14.99</p>
													        	<div class="product-qty">
													          		<label>Qty:</label>
													          		<div class="custom-qty">
													            		<input type="text" name="qty" maxlength="8" value="1" title="Qty" class="input-text qty" disabled>
													          		</div>
													        	</div>
													      	</figcaption>
													    </figure>
													</li>
												</ul>
												<p class="cart-sub-totle">
													<span class="pull-left">Cart Subtotal</span>
													<span class="pull-right"><strong class="price-box">$29.98</strong></span>
												</p>
												<div class="clearfix"></div>
												<div class="mt-20">
													<a href="cart.html" class="btn">Cart</a>
													<a href="checkout.html" class="btn btn-color right-side">Checkout</a>
												</div>
											</div>
								        </div>
						        	</li>
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
									<div class="col-xl-6 col-lg-6 col-md-6 align-flax "style="height:400px" >
                                            @if (isset($config->slide_1 ) && Str::length($config->slide_1) > 0)
                                                <div class="banner-img">
                                                    <img src="{{$config->slide_1}}"
                                                    data-thumb="{{$config ->slide_1}}"> </div>
                                            @endif
                                    </div>
									<div class="col-xl-6 col-lg-6 col-md-6 align-flax">
										<div class="banner-heading w-100">
											<label class="banner-top">Get UP To <span>40%</span> Off</label>
											<h2 class="banner-title">men <span>shoes</span></h2>
											<p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</p>
											<a href="product-detail.html" class="btn">Shop now</a>
										</div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="banner-bg align-flax">
							<div class="w-100">
								<div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 align-flax "style="height:300px" >
                                            @if (isset($config->slide_2 ) && Str::length($config->slide_2) > 0)
                                                <div class="banner-img">
                                                    <img src="{{$config->slide_2}}"
                                                    data-thumb="{{$config ->slide_2}}"> </div>
                                            @endif
                                    </div>
									<div class="col-xl-6 col-lg-6 col-md-6 align-flax">
										<div class="banner-heading w-100">
											<label class="banner-top">Get UP To <span>40%</span> Off</label>
											<h2 class="banner-title">season <span>sale</span></h2>
											<p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</p>
											<a href="product-detail.html" class="btn">Shop now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="banner-bg align-flax">
							<div class="w-100">
								<div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 align-flax "style="height:300px" >
                                            @if (isset($config->slide_3 ) && Str::length($config->slide_3) > 0)
                                                <div class="banner-img">
                                                    <img src="{{$config->slide_3}}"
                                                    data-thumb="{{$config ->slide_3}}"> </div>
                                            @endif
                                    </div>
									<div class="col-xl-6 col-lg-6 col-md-6 align-flax">
										<div class="banner-heading w-100">
											<label class="banner-top">Get UP To <span>40%</span> Off</label>
											<h2 class="banner-title">season <span>sale</span></h2>
											<p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</p>
											<a href="product-detail.html" class="btn">Shop now</a>
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
								<h2 class="hading-title">FEATURED <span>PRODUCTS</span></h2>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6">
							<ul id="tabs" class="product-isotop filters-product text-right text-uppercase nav nav-tabs" role="tablist">
                                    @foreach ($menuCha as $key => $value)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#{{$value->id}}">{{ $value->ten_danh_muc }}</a>
                                    </li>
                                    @endforeach
							</ul>
						</div>
					</div>
					<div class="tab-content">
                        @foreach ($menuCha as $key => $value)
                            <div role="tabpanel" class=" {{ $key == 0 ? 'active show' : '' }}" id="{{$value->id}}">
                            @foreach ($allSanPham as $key_sp => $value_sp)
                            @if(in_array($value_sp->danh_muc_id, explode(",", $value->tmp)))
                                <div class="featured-product mb-25">
                                    <div class="product-img transition mb-15">
                                        <a href="product-detail.html">
                                            <img src="{{ $value_sp->hinh_anh }}"  class="transition">
                                        </a>
                                        <div class="new-label">
                                            <span class="text-uppercase">{{ number_format(($value_sp->don_gia_ban - $value_sp->don_gia_khuyen_mai) / $value_sp->don_gia_ban * 100, 2 )}}<span class="symbol-percent">%</span>
                                        </div>
                                        @if ($value_sp->don_gia_khuyen_mai >0)
                                            <li>
                                                <div class="sale-label">
                                                    <span class="text-uppercase">sale</span>
                                                </div>
                                            </li>
                                        @else
                                        @endif
                                        <div class="product-details-btn text-uppercase text-center transition">
                                            <a href="product-quick-view.html" class="quick-popup mfp-iframe">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-desc">
                                        <a href="product-detail.html" class="product-name text-uppercase">{{$value_sp->ten_san_pham}}</a>
                                        <del class="prev-price">{{ number_format($value_sp->don_gia_ban, 0) }}</del>
                                        <span class="product-pricce">{{ number_format($value_sp->don_gia_khuyen_mai, 0) }}</span>
                                    </div>
                                </div>
                            @endif
                            @endforeach
					</div>
                    @endforeach
				</div>
			</section>

			<section class="offer-banner pt-70">
				<div class="container">
					<div class="offer-bg bg text-center ptb-120">
						<label class="banner-top text-uppercase">PROMOTION SALE <span>OFF 50%</span></label>
						<h1 class="banner-title text-uppercase"><span>the</span> summer</h1>
						<p class="banner-sub">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
						<a href="product-detail.html" class="btn">Shop now</a>
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
										<h2 class="hading-title">best <span>seller</span></h2>
									</div>
									<div class="seller">
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-1.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">men's harpoon 2 eye boot</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-7.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">BUSCIPIT AT MAGNA</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-3.jpg" alt="shoes" class="transition">
											</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">AENEAN SAGITTIS</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-1.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">men's harpoon 2 eye boot</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6">
									<div class="hading pb-20">
										<h2 class="hading-title">top <span>seller</span></h2>
									</div>
									<div class="seller">
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-4.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">ALIQUAM LOBORTIS EST</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-10.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">ELEIFEND ARCU</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-2.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">AENEAN EU TRISTIQUE</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
										<div class="seller-box align-flax w-100 pb-20">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img src="/assets_trangchu/images/product-6.jpg" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">BLIQUAM LOBORTIS</a>
												<span class="product-pricce">$478.00</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-12 col-md-12">
							<div class="offer-week">
								<div class="row align-flax">
									<div class="col-xl-5 col-lg-5 col-md-5">
										<div class="week-img transition">
											<a href="product-detail.html" class="display-b">
												<img src="/assets_trangchu/images/week-sale.jpg" class="w-100" alt="shoes">
											</a>
										</div>
									</div>
									<div class="col-xl-7 col-lg-7 col-md-7">
										<div class="week-contain">
											<h2 class="week-head text-uppercase pb-15">offer of the week</h2>
											<p class="week-sub">Welcome to Xpoge shoes Store 20% off</p>
											<div class="star-rating pb-10">
										      	<input id="star-5" type="radio" name="rating" value="star-5" />
										      	<label for="star-5" title="5 stars" class="transition">
										        	<i class="active fa fa-star" aria-hidden="true"></i>
										      	</label>
										      	<input id="star-4" type="radio" name="rating" value="star-4" checked/>
										      	<label for="star-4" title="4 stars" class="transition">
										        	<i class="active fa fa-star" aria-hidden="true"></i>
										      	</label>
										      	<input id="star-3" type="radio" name="rating" value="star-3" />
										      	<label for="star-3" title="3 stars" class="transition">
										        	<i class="active fa fa-star" aria-hidden="true"></i>
										      	</label>
										      	<input id="star-2" type="radio" name="rating" value="star-2" />
										      	<label for="star-2" title="2 stars" class="transition">
										        	<i class="active fa fa-star" aria-hidden="true"></i>
										      	</label>
										      	<input id="star-1" type="radio" name="rating" value="star-1" />
										      	<label for="star-1" title="1 star" class="transition">
										        	<i class="active fa fa-star" aria-hidden="true"></i>
										      	</label>
										    </div>
											<div class="price-d pb-25">
												<label class="price-r pr-30">$478.00</label>
												<label class="price-o">$378.00</label>
											</div>
											<ul class="countdown text-uppercase">
												<li class="text-center">
													<span id="days" class="counter-timer display-b text-center">08</span>
													<label class="day-name">days</label>
												</li>
												<li class="text-center">
													<span id="hours" class="counter-timer display-b text-center">16</span>
													<label class="day-name">hour</label>
												</li>
												<li class="text-center">
													<span id="minutes" class="counter-timer display-b text-center">36</span>
													<label class="day-name">min</label>
												</li>
												<li class="text-center">
													<span id="seconds" class="counter-timer display-b text-center">45</span>
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

			<section class="team pt-100">
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
			</section>

			<section class="latest-blog pt-100">
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
			</section>

			<div class="brand pt-100">
				<div class="container">
					<div class="brand-salider owl-carousel">
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-1.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-2.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-3.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-4.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-5.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-6.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-1.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-2.jpg" alt="brand" class="transition"></a>
						</div>
						<div class="brand-box text-center">
							<a href="#"><img src="/assets_trangchu/images/brand-4.jpg" alt="brand" class="transition"></a>
						</div>
					</div>
				</div>
			</div>

			<section class="newsletter pt-100">
				<div class="container">
					<div class="newsletter-inner text-center ptb-100">
						<h2 class="newsletter-title">Sign up for Newsletter</h2>
						<p class="newsletter-sub">Wants to get latest updates! sign up for Free</p>
						<form>
						  <div class="form-group">
						    <input type="email" class="form-control" placeholder="Your email address" required>
						  </div>
						  <button type="submit" class="form-btn text-uppercase">
							<span class="sub-r">Subscribe</span>
							<i class="fa fa-send icon-r"></i>
						</button>
						</form>
					</div>
				</div>
			</section>

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
							<p class="footer-desc">Lorem ipsum dolor sit amet, consectetur adipi-scing elit. In purus sem, consectetur sed aliquam vel, hendrerit in elit. Nunc interdum dolor at quam pulvinar sodales. Nunc venenatis egestas mi ac fermentum.</p>
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
								<li><img src="/assets_trangchu/images/cont-1.png" alt="img"><span>28 Green Tower, Street Name <br>New York City, USA</span></li>
								<li><img src="/assets_trangchu/images/cont-2.png" alt="img"><a href="tel:+911234567890">+ 91 123 456 789 0</a></li>
								<li><img src="/assets_trangchu/images/cont-3.png" alt="img"><a href="mailto:xpoge@example.com">xpoge@example.com</a></li>
							</ul>
						</div>
					</div>
					<div class="copy-right mt-100">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-12">
								<p class="copyright-text">&#169; Xpoge all Rights Reserverd theme by <a href="https://templatescoder.com/" target="_blank">TemplatesCoder</a></p>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-12">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<script src="/assets_trangchu/js/jquery-3.4.1.min.js"></script>
		<script src="/assets_trangchu/js/bootstrap.min.js"></script>
		<script src="/assets_trangchu/js/jquery.magnific-popup.min.js"></script>
		<script src="/assets_trangchu/js/owl.carousel.min.js"></script>
		<script src="/assets_trangchu/js/custom.js"></script>
		<script>
			/* ------------ Newslater-popup JS Start ------------- */
				$(window).on('load', function(){
					setTimeout(function(){
						mfp = $.magnificPopup.instance;
						if(!mfp.isOpen) {
						    jQuery.magnificPopup.open({
						    	items: {src: '#newslater-popup'},type: 'inline'
						    }, 0);
						}
					},10000)
				});
		    /* ------------ Newslater-popup JS End ------------- */
		</script>
	</body>

</html>
