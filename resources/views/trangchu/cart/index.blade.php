
{{-- @extends('master') --}}
{{-- @section('content') --}}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/shoes.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/responsive.css">
    {{-- <script src="/assets_homepage/js/vendor/modernizr-3.5.0.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
	</head>
	<body >
		<!-- Start preloader -->
		{{-- <div id="preloader"></div> --}}
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
							                <a href="http://127.0.0.1:8000">Trang Chủ</a>
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
							            <li>
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
								        	<a href="http://127.0.0.1:8000/agent/logout"><i class="fas fa-right-from-bracket" aria-hidden="true"></i></a>
								        </div>
						        	</li>
                                    @else
						        	<li>
						        		<div class="login-head">
								        	<a href="http://127.0.0.1:8000/agent/login"><i class="fas fa-user" aria-hidden="true"></i></a>
								        </div>
						        	</li>
                                    @endif

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
								<h1 class="page-banner-title text-uppercase">Giỏ hàng</h1>
							</div>
							<div class="col-xl-6 col-lg-6 col-12">
								<ul class="right-side">
									<li><a href="http://127.0.0.1:8000">Trang Chủ</a></li>
									<li>Giỏ hàng</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id ="app" class="pt-100">
				<div  class="container">
					<div class="wishlist-table">
						<div class="responsive-table">
							<table class="table border text-center">
								<thead>
									<tr>
										<th>Tên Sản Phẩm</th>
                                        {{-- <th>Size</th> --}}
										<th>Đơn Giá</th>
										<th>Số lượng</th>
										<th>Tổng Phụ</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    <template v-for="(value, key) in listCart" >
									<tr>
										<td class="text-left">
											<div class="seller-box align-flax w-100">
												<div class="seller-img">
													{{-- <a href="/san-pham/{{$value->slug_san_pham}}-post{{ $value->id }}" class="display-b"> --}}
														<img v-bind:src="value.hinh_anh" alt="shoes" class="transition">
													</a>
												</div>
												<div class="seller-contain pl-15">
													<a  class="product-name text-uppercase">@{{ value.ten_san_pham }}</a>
												</div>
											</div>
										</td>

										<td><span class="price">@{{ formatNumber(value.don_gia) }}</span></td>
										<td>
                                            <input type="number" v-on:change="updateRow(value)" v-model="value.so_luong" >
										</td>
										<td><span class="price">@{{ formatNumber(value.don_gia * value.so_luong) }}</span></td>
										<td>
											<ul >
												<i v-on:click="deleteRow(value)" style="color: red" class="fas fa-trash-o fa-lg" aria-hidden="true"></i>
											</ul>
										</td>
									</tr>
                                    </template>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="share-wishlist shoping-con">
									<a href="http://127.0.0.1:8000/" class="btn"><i class="fa fa-angle-left"></i>Tiếp tục mua hàng</a>
								</div>
							</div>
							{{-- <div class="col-md-6">
								<div class="share-wishlist">
									<a href="#" class="btn">Update Cart</a>
								</div>
							</div> --}}
						</div>
						<div class="estimate">
							<div class="row">
								{{-- <div class="col-md-6">
									<h2 class="reviews-head pb-20">Estimate shipping and tax</h2>
									<form class="main-form">
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<select class="form-control">
								                        <option selected="" value="">Select Country</option>
								                        <option value="1">India</option>
								                        <option value="2">China</option>
								                        <option value="3">Pakistan</option>
								                    </select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<select class="form-control">
								                        <option selected="" value="">Select State/Province</option>
								                        <option value="1">---</option>
								                    </select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<select class="form-control">
								                        <option selected="" value="">Select City</option>
								                        <option value="1">---</option>
								                    </select>
												</div>
											</div>
										</div>
									</form>
								</div> --}}
								<div class="col-md-6">
									<div class="cart-total-table">
										<div class="responsive-table">
											<table class="table border">
												<thead>
													<tr>
														<th colspan="2">Chi phí giỏ hàng</th>
													</tr>
												</thead>
												<tbody>

								                    	<tr>
								                      	<td class="payable"><b>Tổng tiền thanh toán</b></td>
								                      	<td>
								                        	<div class="price-box">
								                          		<span class="price">@{{formatNumber(total()) }}</span>
								                        	</div>
								                      	</td>
								                    </tr>
								                </tbody>
											</table>
										</div>
										<div class="share-wishlist" >
											    <a  href="http://127.0.0.1:8000/chi-tiet-bill" class="btn btn-color">Đơn hàng <i class="fa fa-angle-right"></i></a>
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
								<a href="http://127.0.0.1:8000"><img src="/assets_trangchu/images/logo.png" alt="logo"></a>
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
		<script src="/assets_trangchu/js/custom.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @jquery
        @toastr_js
        @toastr_render
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
                    updateRow(row) {
                    axios
                        .post('/add-to-cart-update', row)
                        .then((res) => {
                            if(res.status) {
                                toastr.success("Đã cập nhật giỏ hàng!");
                                // alert('Đã cập nhật giỏ hàng')
                                this.loadCart();
                            }
                        });
                    },
                    deleteRow(row) {
                    axios
                        .post('/remove-cart', row)
                        .then((res) => {
                            // toastr.success("Đã cập nhật giỏ hàng!");
                            alert('Đã cập nhật giỏ hàng')
                            this.loadCart();
                        });
                    },
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

	</body>
</html>

