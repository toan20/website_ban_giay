<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <title>GS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link type="image/x-icon" href="/assets_trangchu/images/fav-icon.png" rel="icon">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/glass-case.css">
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
		<div class="main" id="main">
			<header class="header transition">
				<div class="container position-r">
					<div class="row">
						<div class="col-lg-2 col-md-4 col-6 align-flax">
				            <div class="navbar-header">
					            <a class="navbar-brand" href="http://127.0.0.1:8000/">
					                <img alt="logo" src="/assets_trangchu/images/logo.png" class="transition">
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
								        	<div class="cart-dropdown header-link-dropdown"id="app">
												<ul  class="cart-list link-dropdown-list">
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
                                                        </template>
													</li>
												</ul>
												<p class="cart-sub-totle">
													<span class="pull-left">Giỏ hàng</span>
													<span class="pull-right"><strong class="price-box">@{{ formatNumber(total()) }}</strong></span>
												</p>
												<div class="clearfix"></div>
												<div class="mt-20">
													<a href="http://127.0.0.1:8000/cart" class="btn">Giỏ hàng</a>
													<a href="http://127.0.0.1:8000/chi-tiet-bill" class="btn btn-color right-side">Đơn hàng </a>
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
									<li><a href="http://127.0.0.1:8000">Trang chủ</a></li>
									


								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="product-detail-main pt-100">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-12">
							<div class="align-center mb-md-30">
					            <ul id="glasscase" class="gc-start">
					                <li><img src="{{$sanPham->hinh_anh}}" alt="product" /></li>
					                <li><img src="{{$sanPham->hinh_anh}}" alt="product" /></li>
					                <li><img src="{{$sanPham->hinh_anh}}" alt="product" /></li>
					                <li><img src="{{$sanPham->hinh_anh}}" alt="product" /></li>
					                <li><img src="{{$sanPham->hinh_anh}}" alt="product" /></li>
					                <li><img src="{{$sanPham->hinh_anh}}" alt="product" /></li>
					            </ul>
					        </div>
						</div>
						<div class="col-lg-7 col-md-6 col-12">
							<div class="product-detail-in">
								<h2 class="product-item-name text-uppercase">{{$sanPham->ten_san_pham}}</h2>
								<div class="price-box">
									<span class="price">{{ number_format($sanPham->don_gia_khuyen_mai, 0) }}</span>
				                    <del class="price old-price">{{ number_format($sanPham->don_gia_ban, 0) }}</del>
				                    <div class="rating-summary-block">
					                    <div class="star-rating">
									      	<input id="star-5" type="radio" name="rating" value="star-5" />
									      	<label for="star-5" title="5 stars">
									        	<i class="active fa fa-star" aria-hidden="true"></i>
									      	</label>
									      	<input id="star-4" type="radio" name="rating" value="star-4" />
									      	<label for="star-4" title="4 stars">
									        	<i class="active fa fa-star" aria-hidden="true"></i>
									      	</label>
									      	<input id="star-3" type="radio" name="rating" value="star-3" />
									      	<label for="star-3" title="3 stars">
									        	<i class="active fa fa-star" aria-hidden="true"></i>
									      	</label>
									      	<input id="star-2" type="radio" name="rating" value="star-2" />
									      	<label for="star-2" title="2 stars">
									       		<i class="active fa fa-star" aria-hidden="true"></i>
									      	</label>
									      	<input id="star-1" type="radio" name="rating" value="star-1" />
									      	<label for="star-1" title="1 star">
									        	<i class="active fa fa-star" aria-hidden="true"></i>
									      	</label>
									    </div>
									    <a href="#product-review" class="scrollTo"><span>1 Đánh giá (s)</span></a>
									</div>
									<div class="product-des">
		                				<p>{{$sanPham->mo_ta_ngan}}</p>
		                			</div>
		                			<ul>
				                        <li><i class="fa fa-check"></i> Sale {{ number_format(($sanPham->don_gia_ban - $sanPham->don_gia_khuyen_mai) / $sanPham->don_gia_ban * 100, 2 )}} %</li>
				                        <li><i class="fa fa-check"></i> Miễn phí vận chuyển cho đơn hàng trên 2 sản phẩm </li>
				                        <li><i class="fa fa-check"></i> 7 ngày đổi trả hàng nhanh chóng </li>
				                    </ul>
				                    <div class="row mt-20">
				                    	<div id="app" class="col-12">
				                        	<div class="table-listing qty">
				                        		<label>Số Lượng:</label>
				                        		<div class="fill-input">
				                        			<button type="button" id="sub" class="sub cou-sub">
				                        				<i class="fa fa-minus" aria-hidden="true"></i>
				                        			</button>
    												<input type="number" id="1" class="input-text qty" value="1" model="value.so_luong" min="1" max="3" />
    												<button type="button" id="add" class="add cou-sub">
    													<i class="fa fa-plus" aria-hidden="true"></i>
    												</button>
				                        		</div>
					                        </div>
					                        <div class="table-listing qty">
				                        		<label>Size:</label>
				                        		<div class="fill-input">
				                        			<select class="selectpicker full">
									                    <option selected="selected" value="#">38</option>
									                    <option value="#">39</option>
									                    <option value="#">40</option>
                                                        <option value="#">41</option>
                                                        <option value="#">42</option>
                                                        <option value="#">43</option>
									               	</select>
				                        		</div>
					                        </div>
					                        {{-- <div class="table-listing qty">
				                        		<label>Color:</label>
				                        		<div class="fill-input">
				                        			<select class="selectpicker full">
									                    <option selected="selected" value="#">Blue</option>
									                    <option value="#">Green</option>
									                    <option value="#">Orange</option>
									                    <option value="#">White</option>
									               	</select>
				                        		</div>
					                        </div> --}}
					                        <div class="product-action">
                                                @if (Auth::guard('agent')->check())
												<ul>
													<li>
														<a class="btn btn-color addToCart" data-id="{{ $sanPham->id}}" >
															<img src="/assets_trangchu/images/shop-bag.png" alt="bag">
                                                            <span>Thêm vào giỏ hàng</span>
														</a>

                                                    </li>
													<li><a href="wishlist.html" class="btn"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
												</ul>
                                                @else
                                                <ul>
													<li>
														<a href="http://127.0.0.1:8000/agent/login" class="btn btn-color" >
															<img src="/assets_trangchu/images/shop-bag.png" alt="bag">
															<span>Thêm vào giỏ hàng</span>
														</a>
													</li>
													<li><a href="wishlist.html" class="btn"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
												</ul>
                                                @endif
											</div>
				                        </div>
				                    </div>
				                </div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="product-detail-tab pt-100" id="product-review">
				<div class="container">
					<div class="product-review">
						<ul id="tabs" class="review-tab nav nav-tabs" role="tablist">
							<li role="presentation" class="tab-link">
								<a href="#description" role="tab" class="active" data-toggle="tab">Mô tả sản phẩm</a>
							</li>
							<li role="presentation" class="tab-link">
								<a href="#review" role="tab" data-toggle="tab">Đánh giá</a>
							</li>
						</ul>
						<div class="product-review-des tab-content">
							<div role="tabpanel" class="product-review-in product-review-des tab-pane fade active show" id="description">
								<h2>Thông tin chi tiết</h2>
								<p>{{$sanPham->mo_ta_chi_tiet}}</p>
							</div>
							<div role="tabpanel" class="product-review-in product-review-com tab-pane fade" id="review">
								<div class="comment-part">
									<h3>03 COMMENTS</h3>
									<ul>
										<li>
											<div class="comment-user">
												<img src="/assets_trangchu/images/comment-img1.jpg" alt="comment-img">
											</div>
											<div class="comment-detail">
												<span class="commenter">
													<span>John Doe</span> (05 Jan 2020)
												</span>
												<p>Lorem ipsum dolor sit amet adipiscing elit labore dolore that sed do eiusmod tempor labore dolore that magna aliqua. Ut enim ad minim veniam, exercitation.</p>
												<a href="#" class="reply-btn btn btn-color small">Reply</a>
											</div>
											<div class="clearfix"></div>
										</li>
										<li>
											<ul>
												<li>
													<div class="comment-user">
														<img src="/assets_trangchu/images/comment-img2.jpg" alt="comment-img">
													</div>
													<div class="comment-detail">
														<span class="commenter">
															<span>John Doe</span> (12 Jan 2020)
														</span>
														<p>Lorem ipsum dolor sit amet adipiscing elit labore dolore that sed do eiusmod tempor labore dolore that magna aliqua. Ut enim ad minim veniam, exercitation.</p>
														<a href="#" class="reply-btn btn btn-color small">Reply</a>
													</div>
													<div class="clearfix"></div>
												</li>
												<li>
													<div class="comment-user">
														<img src="/assets_trangchu/images/comment-img3.jpg" alt="comment-img">
													</div>
													<div class="comment-detail">
														<span class="commenter">
															<span>John Doe</span> (15 Jan 2020)
														</span>
														<p>Lorem ipsum dolor sit amet adipiscing elit labore dolore that sed do eiusmod tempor labore dolore that magna aliqua. Ut enim ad minim veniam, exercitation.</p>
														<a href="#" class="reply-btn btn btn-color small">Reply</a>
													</div>
													<div class="clearfix"></div>
												</li>
											</ul>
										</li>
									</ul>
								</div>
								<div class="leave-comment-part pt-100">
									<h3 class="reviews-head mb-30">Leave A Comment</h3>
									<form class="main-form">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Name" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Subject" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Email" required>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<textarea class="form-control" placeholder="Message" rows="8"></textarea>
												</div>
											</div>
											<div class="col-12">
												<button type="submit" class="btn post-comm">Post Comment</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="featured pt-100">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h2 class="related-title">Các sản phẩm khác</h2>
						</div>
                         <div class="tab-content">
                            @foreach ($menuCha as $key => $value)
                                <div role="tabpanel" class="row tab-pane fade {{ $key == 0 ? 'active show' : ''}}" id="tab_{{$value->id}}">
                                    @foreach ($allSanPham as $key_sp => $value_sp)
                                            <div class="featured-product mb-25">
                                                    <div class="product-img transition mb-15">
                                                        <a href="/san-pham/{{$value_sp->id}}">
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
                                                            <a href="/san-pham/{{$value_sp->id}}" class="quick-popup mfp-iframe">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="product-desc">
                                                        <a href="/san-pham/{{$value_sp->id}}" class="product-name text-uppercase">{{$value_sp->ten_san_pham}}</a>
                                                        <del class="prev-price">{{ number_format($value_sp->don_gia_ban, 0) }}</del>
                                                        <span class="product-pricce">{{ number_format($value_sp->don_gia_khuyen_mai, 0) }}</span>
                                                    </div>
                                            </div>
                                            @if($key_sp > 8)
                                                @break
                                            @endif
                                    @endforeach
                                </div>

                            @endforeach
                        </div>
					</div>
				</div>
			</section>

			{{-- <section class="newsletter pt-100">
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
    @jquery
    @toastr_js
    @toastr_render
		<script src="/assets_trangchu/js/jquery-3.4.1.min.js"></script>
		<script src="/assets_trangchu/js/bootstrap.min.js"></script>
		<script src="/assets_trangchu/js/jquery.magnific-popup.min.js"></script>
		<script src="/assets_trangchu/js/modernizr.js"></script>
		<script src="/assets_trangchu/js/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script> --}}
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> --}}
		<script>
	        $(document).ready( function () {
	            //If your <ul> has the id "glasscase"
	            $('#glasscase').glassCase({
	            	'thumbsPosition': 'bottom',
	            	'widthDisplayPerc' : 100,
	            	isDownloadEnabled: false,
	            });
	        });
	    </script>
        <script>
            $(document).ready(function() {
                $(".addToCart").click(function(){
                    var san_pham_id = $(this).data('id');
                    var payload = {
                        'san_pham_id'   : san_pham_id,
                        'so_luong'      : 1,
                    };
                    axios
                        .post('/add-to-cart', payload)
                        .then((res) => {
                            if(res.data.status) {

                                toastr.success("Đã thêm vào giỏ hàng!");
                            } else {
                                toastr.error("Bạn cần đăng nhập trước!");

                            }
                        })
                        .catch((res) => {
                            var danh_sach_loi = res.response.data.errors;
                            $.each(danh_sach_loi, function(key, value){
                                toastr.error(value[0]);
                            });
                        });
                });
            });
        </script>
        <script>
            new Vue({
                el      :   '#app',
                data    :   {
                    listCart    : [],
                    tong_tien   : 0,
                    san_pham_id : 0,


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

                    updateRow(row) {
                    axios
                        .post('/add-to-cart-update', row)
                        .then((res) => {
                            if(res.status) {
                                // toastr.success("Đã cập nhật giỏ hàng!");
                                alert('Đã cập nhật giỏ hàng')
                                this.loadCart();
                            }
                        });
                    },
                    // so_luong_plus(id){
                    //     axios
                    //     .get('/tangsoluong/' +id)
                    //     .then((res) => {
                    //         if(res.status) {
                    //             alert('bố mày xin nhá')
                    //             this.loadCart();
                    //         }
                    //     });
                    // },
                    total(){
                        var tong_tien =0;
                        this.listCart.forEach((value, key )=>{
                            tong_tien += value.don_gia * value.so_luong;
                        });
                        return tong_tien;
                    },

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
