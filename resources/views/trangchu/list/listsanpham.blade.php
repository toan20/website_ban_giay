
<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>GS Shop</title>
	<!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link type="image/x-icon" href="/assets_trangchu//assets_trangchu/images/fav-icon.png" rel="icon">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/shoes.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
	</head>
	<body>
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
		<!-- Search Screen end -->

		<div class="main" id="main">
			<header class="header transition">
				<div class="container position-r">
					<div class="row">
						<div class="col-lg-2 col-md-4 col-6 align-flax">
				            <div class="navbar-header">
					            <a class="navbar-brand" href="http://127.0.0.1:8000">
					                <img alt="logo" src="/assets_trangchu/images/logo.png" class="transition">
					            </a>
				            </div>
					    </div>
					    <div class="col-lg-10 col-md-8 col-6 position-i">
					       	<div class="menu-left transition">
						        <div class="menu" >
						            <ul>
							            <li>
							                <a href="http://127.0.0.1:8000">Trang chủ</a>
							            </li>
							            @foreach ($menuCha as $key=>$value_cha)
                                        <li class="dropdown">
							            	<span class="opener plus"></span>
							                <a href="/danh-muc/{{$value_cha->slug_danh_muc}}-post{{ $value_cha->id }}">{{$value_cha->ten_danh_muc}}</a>
							                <div class="megamenu">
							                	<div class="megamenu-inner">
							                		<ul>
                                                        @foreach ( $menuCon as $value_con )
                                                        @if ($value_con->id_danh_muc_cha==$value_cha->id)
                                                        <li><a href="/danh-muc/{{$value_con->slug_danh_muc}}-post{{ $value_con->id }}">{{$value_con->ten_danh_muc}}</a></li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
							                	</div>
							                </div>
							            </li>
                                        @endforeach
							                <a href="contact.html">Contact</a>
							            </li>
						            </ul>
						        </div>
					        </div>
					        <div class="search-right">
					        	<div class="menu-toggle"><span></span></div>
					        	<div class="search-menu">
                                    <form action="/search" method="post">
                                        @csrf
                                        <input type="text" name="search" id="searchSanPham" class="search-input" placeholder="Tên sản phẩm">
                                        <input type="submit" name="submit" class="search-btn">
                                        <div class="search-button-i transition">
                                            <img src="/assets_trangchu/images/search.png" class="position-r transition" alt="search">
                                        </div>
                                    </form>
						        </div>
						        <ul class="login-cart">
						        	@if (Auth::guard('agent')->check())
                                    <li>
						        		<div class="login-head">
								        	<a href="/agent/logout"><i class="fas fa-right-from-bracket" aria-hidden="true"></i></a>
								        </div>
						        	</li>
                                    @else
						        	<li>
						        		<div class="login-head">
								        	<a href="/agent/login"><i class="fas fa-user" aria-hidden="true"></i></a>
								        </div>
						        	</li>
                                    @endif
						        	<li>
						        		<div class="cart-menu">
								        	<div class="cart-icon position-r">
								        		<img src="/assets_trangchu/images/car-icon-w.png" class="position-r transition" alt="cart">
								        	</div>
								        	<div class="cart-dropdown header-link-dropdown">
												<ul id="app" class="cart-list link-dropdown-list">
													<li>
                                                        <template v-for="(value, key) in listCart" >
													  	<a href="javascript:void(0)" class="close-cart"><i class="fa fa-times-circle"></i></a>
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
													            		<input type="text" name="qty" maxlength="8" v-on:change="updateRow(value)" v-model="value.so_luong" title="Qty" class="input-text qty" disabled>
													          		</div>
													        	</div>
													      	</figcaption>
													    </figure>
													</li>
												</ul>
                                                </template>
												<p id="app" class="cart-sub-totle">
													<span class="pull-left">Giỏ hàng của bạn</span>
													<span class="pull-right"><strong class="price-box">@{{ formatNumber(total()) }}</strong></span>
												</p>
                                                </template>

												<div class="clearfix"></div>
												<div class="mt-20">
													<a href="http://127.0.0.1:8000/cart" class="btn">Giỏ hàng</a>
													<a href="http://127.0.0.1:8000/chi-tiet-bill" class="btn btn-color right-side">Đơn hàng</a>
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

			<section class="page-banner">
				<div class="container">
					<div class="page-banner-in">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-12">
								<h1 class="page-banner-title text-uppercase">Shop</h1>
							</div>
							<div class="col-xl-6 col-lg-6 col-12">
								<ul class="right-side">
									<li><a href="http://127.0.0.1:8000">Trang Chủ</a></li>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="product-list">
				<div class="container">
					<div class="row pt-100">
						<div class="col-xl-3 col-lg-4 col-12">
							<div class="sidebar">
								<div class="sidebar-default mb-30">
									<div class="category-content">
										<h2 class="cat-title text-uppercase">Các Sản Phẩm Khác</h2>
										<ul class="category category-drop-down">
                                            @foreach ($menuCha as $key=>$value_cha)
											<li>
												<span class="opener plus"></span>
												<a href="/danh-muc/{{$value_cha->slug_danh_muc}}-post{{ $value_cha->id }}">{{$value_cha->ten_danh_muc}}</a>
												<ul class="category-sub">
                                                    @foreach ( $menuCon as $value_con )
                                                    @if ($value_con->id_danh_muc_cha==$value_cha->id)
													<li><a href="/danh-muc/{{$value_con->slug_danh_muc}}-post{{ $value_con->id }}">{{$value_con->ten_danh_muc}}</a></li>
                                                    @endif
                                                    @endforeach
												</ul>
											</li>
                                             @endforeach
										</ul>
									</div>
								</div>
								{{-- <div class="sidebar-default mb-30">
									<div class="category-content">
										<h2 class="cat-title text-uppercase">Filter By</h2>
										<a class="btn small btn-filter" href="#">
											<i class="fa fa-close"></i><span>Clear all</span>
										</a>
									</div>
									<div class="category-content filter-by">
										<h2 class="cat-title text-uppercase">Categories</h2>
										<ul class="category">
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Tops" name="Tops">
													<label for="Tops">Tops (08)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Dresses" name="Dresses">
													<label for="Dresses">Dresses (10)</label>
												</div>
											</li>
										</ul>
									</div>
									<div class="category-content filter-by">
										<h2 class="cat-title text-uppercase">Size</h2>
										<ul class="category">
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="s1" name="s">
													<label for="s1">S</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="m" name="m">
													<label for="m">M</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="l" name="l">
													<label for="l">L</label>
												</div>
											</li>
										</ul>
									</div>
									<div class="category-content filter-by">
										<h2 class="cat-title text-uppercase">Color</h2>
										<ul class="category">
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Beige" name="Beige">
													<label for="Beige" class="beige">Beige (1)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="White" name="White">
													<label for="White" class="white">White (2)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Black" name="Black">
													<label for="Black" class="black">Black (2)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Orange" name="Orange">
													<label for="Orange" class="orange">Orange (3)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Blue" name="Blue">
													<label for="Blue" class="blue">Blue (2)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Green" name="Green">
													<label for="Green" class="green">Green (1)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Yellow" name="Yellow">
													<label for="Yellow" class="yellow">Yellow (3)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Pink" name="Pink">
													<label for="Pink" class="pink">Pink (1)</label>
												</div>
											</li>
										</ul>
									</div>
									<div class="category-content filter-by">
										<h2 class="cat-title text-uppercase">Styles</h2>
										<ul class="category">
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Casual" name="Casual">
													<label for="Casual">Casual (9)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Dressy" name="Dressy">
													<label for="Dressy">Dressy (1)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Girly" name="Girly">
													<label for="Girly">Girly (3)</label>
												</div>
											</li>
										</ul>
									</div>
									<div class="category-content filter-by">
										<h2 class="cat-title text-uppercase">Compositions</h2>
										<ul class="category">
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Cotton" name="Cotton">
													<label for="Cotton">Cotton (8)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="Viscose" name="Viscose">
													<label for="Viscose">Viscose (1)</label>
												</div>
											</li>
										</ul>
									</div>
									<div class="category-content filter-by">
										<h2 class="cat-title text-uppercase">Price</h2>
										<ul class="category">
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_1" name="Cotton">
													<label for="price_1">$68.00 - $72.00 (2)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_2" name="Cotton">
													<label for="price_2">$86.00 - $89.00 (1)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_3" name="Cotton">
													<label for="price_3">$99.00 - $103.00 (3)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_4" name="Cotton">
													<label for="price_4">$104.00 - $108.00 (2)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_5" name="Cotton">
													<label for="price_5">$109.00 - $113.00 (1)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_6" name="Cotton">
													<label for="price_6">$126.00 - $135.00 (2)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_7" name="Cotton">
													<label for="price_7">$209.00 - $217.00 (3)</label>
												</div>
											</li>
											<li>
												<div class="check-box">
													<input type="checkbox" class="checkbox" id="price_8" name="Cotton">
													<label for="price_8">$309.00 - $321.00 (1)</label>
												</div>
											</li>
										</ul>
									</div>
								</div> --}}
								{{-- <div class="sidebar-default">
									<div class="category-content">
										<h2 class="cat-title latest-prod text-uppercase">Sản Phẩm Mới Nhất</h2>
										<div class="seller">
                                            @foreach ($sanPham as $key => $value)
											<div class="seller-box align-flax w-100 pb-10">
												<div class="seller-img">
													<a href="/san-pham/{{$value->slug_san_pham}}-post{{ $value->id }}" class="display-b">
														<img src="{{ $value->hinh_anh }}" alt="shoes" class="transition">
													</a>
												</div>
												<div class="seller-contain pl-15">
													<a href="/san-pham/{{$value->slug_san_pham}}-post{{ $value->id }}" class="product-name text-uppercase">{{ $value->ten_san_pham }}</a>
													<span class="product-pricce">{{ number_format($value->don_gia_khuyen_mai, 0) }} đ</span>
												</div>
											</div>
                                            @if($key > 5)
                                                @break
                                            @endif
                                            @endforeach
										</div>
									</div>
								</div> --}}
							</div>
						</div>
						<div class="col-xl-9 col-lg-8 col-12">
							<div class="shorting mb-30">
						        <div class="row align-flax">
						            <div class="col-xl-6 col-lg-5 col-md-6 mb-r-15">
						                <div class="view">
						                  	<div class="list-types grid active">
						                  		<a href="shop.html">
						                    		<div class="grid-icon list-types-icon">
						                    			<i class="fa fa-th-large transition" aria-hidden="true"></i>
						                    		</div>
						                    	</a>
						                    </div>
						                  	<div class="list-types list">
						                  		<a href="shop-list.html">
						                    		<div class="list-icon list-types-icon">
						                    			<i class="fa fa-bars transition" aria-hidden="true"></i>
						                    		</div>
						                    	</a>
						                    </div>
						                </div>
						                <div class="short-by"> <span>Product Compare (0)</span>
						                </div>
						            </div>
						            <div class="col-xl-6 col-lg-7 col-md-6 text-right text-left-md">
						                <div class="show-item">
						                	<span class="ml-0">Sort By:</span>
						                  	<div class="select-item">
						                    	<select class="m-w-130">
						                      		<option value="" selected="selected">Default sorting</option>
						                      		<option value="">Sort by popularity</option>
						                      		<option value="">Sort by average rating</option>
						                    	</select>
						                  	</div>
						                </div>
						                <div class="show-item float-right-md">
						                	<span>Show</span>
						                  	<div class="select-item">
						                    	<select>
						                      		<option value="" selected="selected">15</option>
						                      		<option value="">12</option>
						                      		<option value="">6</option>
						                    	</select>
						                  	</div>
						                </div>
						            </div>
						        </div>
						   	</div>
							<div class="featured">
								<div class="row">
                                    @foreach ($sanPham as $key => $value)
									<div class="featured-product mb-25">
										<div class="product-img transition mb-15">
											<a href="/san-pham/{{$value->slug_san_pham}}-post{{ $value->id }}">
												<img src="{{ $value->hinh_anh }}" alt="product" class="transition">
											</a>
											<div class="new-label">
												<span class="text-uppercase">New</span>
											</div>
                                            @if ($value->don_gia_khuyen_mai >0)
                                                <li>
                                                    <div class="sale-label">
                                                        <span class="text-uppercase">sale</span>
                                                    </div>
                                                </li>
                                            @else
                                            @endif
											<div class="product-details-btn text-uppercase text-center transition">
												<a href="/san-pham/{{$value->id}}" class="quick-popup">Quick View</a>
											</div>
										</div>
										<div class="product-desc">
											<a href="product-detail.html" class="product-name text-uppercase">{{ $value->ten_san_pham }}</a>
											<del class="prev-price">{{ number_format($value->don_gia_ban, 0) }} đ</del>
                                            <span class="product-pricce">{{ number_format($value->don_gia_khuyen_mai, 0) }} đ</span>
										</div>
									</div>
                                    @endforeach
								</div>
							</div>
							<div class="shorting pagination-1 mt-20">
						        <div class="row">
						            <div class="col-lg-6 col-md-6">
						                <div class="pagination-bar">
					                      	<ul>
					                        	<li class="active"><a href="#">1</a></li>
					                        	<li><a href="#">2</a></li>
					                        	<li><a href="#">3</a></li>
					                        	<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
					                      	</ul>
					                    	</div>
						              	</div>
						            <div class="col-lg-6 col-md-6">
						                <div class="show-item right-side float-none-md">
						                	<span class="float-none-md d-block">Showing 1 to 15 of 15 (1 Pages)</span>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
				</div>
			</section>

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
		<script src="/assets_trangchu/js/jquery.magnific-popup.min.js"></script>
		<script src="/assets_trangchu/js/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            new Vue({
                el      :   '#app',
                data    :   {
                    listCart    : [],
                    tong_tien   : 0,
                },
                created() {
                    this.loadCart();
                },
                methods :   {
                    loadCart() {
                        axios
                            .get('/cart/data')
                            .then((res) => {
                                this.listCart = res.data.data;
                            });
                    },
                    formatNumber(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                    },
                    total(){
                        var tong_tien =0;
                        this.listCart.forEach((value, key )=>{
                            tong_tien += value.don_gia * value.so_luong;
                        });
                        return tong_tien;
                    }
                },

            });
        </script>
    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
                $("#searchSanPham").keyup(function()
                {
                    var search = $("#searchSanPham").val();
                    console.log(search);

                });

            })
        </script>
    @endsection
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63a31c59b0d6371309d581e1/1gkqidg5f';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
    <!--End of Tawk.to Script-->
	</body>

</html>
