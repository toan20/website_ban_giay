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
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/shoes.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/responsive.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"  />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @css
	</head>
	<body>

		<!-- Start preloader -->
		<div id="preloader"></div>
		<!-- End preloader -->

		<!-- Search Screen start -->
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
					            <a class="navbar-brand" href="index.html">
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
							            <li>
							                <a href="contact.html">Contact</a>
							            </li>
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
						        	<li>
						        		<div class="login-head">
								        	<a href="login.html"><i class="fa fa-user-o" aria-hidden="true"></i></a>
								        </div>
						        	</li>
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

			<section class="page-banner">
				<div class="container">
					<div class="page-banner-in">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-12">
								<h1 class="page-banner-title text-uppercase">REGISTER</h1>
							</div>
							<div class="col-xl-6 col-lg-6 col-12">
								<ul class="right-side">
									<li><a href="http://127.0.0.1:8000">Home</a></li>
									<li>Register</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="login pt-100">
				<div class="container">
					<div class="billing-details">
						<h2 class="checkout-title text-uppercase text-center mb-30">CREATE ACCOUNT</h2>
						<form class="checkout-form">
							<div class="form-group">
								<label class="form-label">First Name</label>
								<input type="text" class="form-control" placeholder="Name"id="ho_va_ten" required>
							</div>
							<div class="form-group">
								<label class="form-label">Phone</label>
								<input type="phone" class="form-control" placeholder="Phone"id="so_dien_thoai" required>
							</div>
							<div class="form-group">
								<label class="form-label">Email address</label>
								<input type="email" class="form-control" placeholder="Email Address" id="email"required>
							</div>
							<div class="form-group">
								<label class="form-label">Password</label>
								<input type="password" class="form-control" placeholder="Enter your Password" id="password"required>
							</div>
							<div class="form-group">
								<label class="form-label">Re-enter Password</label>
								<input type="password" class="form-control" placeholder="Re-enter Password"id="re_password" required>
							</div>
							<div class="form-group">
								<label class="form-label">Địa chỉ</label>
								<input type="text" class="form-control" placeholder="dia chi"id="dia_chi" required>
							</div>
							<div class="login-btn-g">
								<div class="row">

							        <div class="col-7">
                                        <button name="submit" type="submit" id="register"class="btn btn-color right-side">Sign up</button>
							        </div>
							    </div>
					        </div>
					        <div class="new-account text-center mt-20">
					        	<span>Already have an account with us</span>
				                <a class="link" title="Create New Account" href="http://127.0.0.1:8000/agent/login">Login Here</a>
				            </div>
						</form>
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
								<li><img src="images/cont-1.png" alt="img"><span>28 Green Tower, Street Name <br>New York City, USA</span></li>
								<li><img src="images/cont-2.png" alt="img"><a href="tel:+911234567890">+ 91 123 456 789 0</a></li>
								<li><img src="images/cont-3.png" alt="img"><a href="mailto:xpoge@example.com">xpoge@example.com</a></li>
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
		<script src="/assets_trangchu/js/custom.js"></script>
	</body>
	@jquery
    @toastr_js
    @toastr_render
    {{-- <script src="/vendor/laravel-filemanager/js/lfm.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#register").click(function(e) {
                var payload = {
                    'ho_va_ten'     : $("#ho_va_ten").val(),
                    'so_dien_thoai' : $("#so_dien_thoai").val(),
                    'email'         : $("#email").val(),
                    'password'      : $("#password").val(),
                    're_password'   : $("#re_password").val(),
                    'dia_chi'       : $("#dia_chi").val(),

                };

                console.log(payload);

                $.ajax({
                    url     :   '/agent/register',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        // $("#messeger").append('<div class="alert alert-success " role="alert"> Vui lòng kiểm tra Email để kích hoạt tài khoản</div>');
                        if(res.status){
                            console.log(res.status);
                            toastr.success("Bạn đã đăng ký thành công");
                            alert('chúng tôi đã gửi cho email bạn đăng kí để xác minh tài khoản? vui lòng kiểm tra email?')
                            //alert('ok nha')
                            setTimeout(function(){
                                $(location).attr('href','http://127.0.0.1:8000/agent/login');
                            }, 500);
                        }
                        // $("#messeger").append('<div class="alert alert-success " role="alert"> Vui lòng kiểm tra Email để kích hoạt tài khoản</div>');
                        // if(res.status){
                        //     console.log(res.status);
                        //     toastr.success("Bạn đã đăng kí tài khoản thành công !!!");
                        //     setTimeout(function(){
                        //         $(location).attr('href','http://127.0.0.1:8000/agent/login');;
                        //     }, 2000);
                        // }
                    },
                    error   :   function(res) {
                        var danh_sach_loi = res.responseJSON.errors;
                        $.each(danh_sach_loi, function(key, value){
                            toastr.error(value[0]);
                            // alert(value[0])
                        });
                    },
                });
            });
        });
    </script>

</html>
