<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>GS SHop</title>
	<!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link type="image/x-icon" href="/assets_trangchu/images/fav-icon.png" rel="icon">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/shoes.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/responsive.css">
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
								<h1 class="page-banner-title text-uppercase">Kiểm tra thanh toán</h1>
							</div>
							<div class="col-xl-6 col-lg-6 col-12">
								<ul class="right-side">
									<li><a href="http://127.0.0.1:8000/">Trang Chủ</a></li>
									<li><a href="http://127.0.0.1:8000/cart">Giỏ hàng</a></li>
									<li>Đơn hàng</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="checkout pt-100">
				<div class="container" id="app">
						<div class="row">
							<div class="col-lg-8 col-12">
								<div class="billing-details">
									<h2 class="checkout-title mb-30">Thông tin người nhận</h2>
									<div class="checkout-form">
										<div class="row">
											<div class="col-12">
											  	<div class="form-group">
											    	<label  class="form-label">Họ và tên</label>
											    	<input v-model ="dataNguoiNhan.ten_nguoi_nhan" type="text" class="form-control" required>
											  	</div>
											</div>
											<div class="col-12">
											  	<div class="form-group">
											    	<label class="form-label">Email</label>
											    	<input  v-model="dataNguoiNhan.email_nguoi_nhan" type="text" class="form-control">
											  	</div>
											</div>
											<div class="col-12">
											  	<div class="form-group">
											    	<label  class="form-label">Số điện thoại</label>
											    	<input v-model="dataNguoiNhan.sdt_nguoi_nhan" type="text" class="form-control">
											  	</div>
											</div>
											<div class="col-12">
											  	<div class="form-group">
											    	<label  class="form-label">Địa chỉ người nhận</label>
											    	<input v-model="dataNguoiNhan.dia_chi_nguoi_nhan" type="text" class="form-control" required>
											  	</div>
											</div>
										</div>
									</div>
									{{-- <div class="shiping-detail">
										<div class="row">
											<div class="col-lg-12 col-12">
												<h2 class="checkout-title mb-30">Shipping Details</h2>
												<div class="checkout-form">
													<div class="check-box">
														<span>
												            <input type="checkbox" class="checkbox" id="ship" name="Ship to a different address?">
												            <label for="ship">Ship to a different address?</label>
												        </span>
											        </div>
											    </div>
											    <h3 class="checkout-sub">Order Notes</h3>
											    <div class="order-note">
											       	<p class="order-note-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a</p>
											    </div>
											</div>
										</div>
									</div> --}}
								</div>
							</div>
							<div  class="col-lg-4 col-12">
								<div class="your-order">
									<h2 class="checkout-title mb-30">Sản phẩm của bạn</h2>
									<div  class="seller">
                                        <template v-for="(value, key) in listCart">
										<div  class="seller-box align-flax w-100" v-if= "value.agent_id == {{$id_agent}}">
											<div class="seller-img">
												<a href="product-detail.html" class="display-b">
													<img v-bind:src="value.hinh_anh" alt="shoes" class="transition">
												</a>
											</div>
											<div class="seller-contain pl-15">
												<a href="product-detail.html" class="product-name text-uppercase">@{{ value.ten_san_pham }}</a>
												<span class="product-pricce">@{{ formatNumber(value.don_gia * value.so_luong) }}</span>
												<div class="checkout-qty">
							                        <label>Số lượng </label>
							                        <span class="info-deta" >@{{value.so_luong}}</span>
									            </div>
											</div>

										</div>
                                        <div  class="seller-box align-flax w-100" v-else>
                                        </div>
									</div>
                                    </template>
									<div  class="subtotal-main" style="padding-right: 20px">
                                        <div class="m-4 d-flex">
                                            <fieldset class="border p-3 mr-2 col-6" style="
                                                display: flex;
                                                justify-content: flex-start;">
                                               <legend class="small text-dark fw-bold" style="font-weight: 600;font-size: 15px;display:flex;justify-content: center">Phương thức thanh toán</legend>
                                               <div class="form-group row" style="padding: 10px">
                                                 <p><input type="radio"  v-model="dataNguoiNhan.loai_thanh_toan" value=1 > Chuyển khoản</p>
                                                 <p><input type="radio"  v-model="dataNguoiNhan.loai_thanh_toan" value=2 > Khi nhận hàng</p>
                                               </div>
                                             </fieldset>
                                             <fieldset class="border p-3 ml-3 col-6" >
                                                <legend class="small text-dark fw-bold" style="font-weight: 600;font-size: 15px;display:flex;justify-content: center">Phương thức giao hàng</legend>
                                                <div class="form-group row" style="padding: 10px">
                                                  <p><input type="radio"   v-model="dataNguoiNhan.phi_van_chuyen" value=70000> Giao hàng nhanh</p>
                                                  <p><input type="radio"   v-model="dataNguoiNhan.phi_van_chuyen" value=35000> Giao hàng tiết kiệm</p>
                                                  <p><input type="radio"   v-model="dataNguoiNhan.phi_van_chuyen"  value=50000> Giao hàng thường</p>
                                                </div>
                                             </fieldset>
                                         </div>
										<div class="shiping-type" >
											<div class="row">
												<div class="col-6">
													<div class="radio-btn">

                                                        <input class="col-6" for="express"> Phí vận chuyển</label>
												    </div>
												</div>
                                                <div class="col-6 text-right">
													<span>@{{formatNumber(dataNguoiNhan.phi_van_chuyen)}}</span>
												</div>
											</div>
										</div>

                                        <div class="shiping-type">
											<div class="row">
												<div class="col-6">
													<div class="radio-btn">
                                                        <input class="col-6" >Tổng tiền</label>
												    </div>
												</div>
												<div class="col-6 text-right">
													<span>@{{formatNumber(tongtien())}}</span>
												</div>
											</div>
										</div>
                                        <div class="shiping-type">
											<div class="row">
												<div class="col-6">
													<div class="radio-btn">
                                                        <input class="col-6" >Chi phí được giảm</label>
												    </div>
												</div>
												<div class="col-6 text-right">
													<span>@{{ formatNumber(totalduocgiam()) }}</span>
												</div>
											</div>
										</div>
										<div class="total-all">
											<div class="total-border">
												<div class="row">
													<div class="col-6">
														<label>Tổng thanh toán</label>
													</div>
													<div class="col-6 text-right">
														<span style="    font-size: 20px;
                                                        font-weight: 700;
                                                        color: red;">@{{ formatNumber(total())}}</span>
													</div>
												</div>
											</div>
										</div>

									</div>
									<button  v-on:click ="createBill()" class="btn">Đặt hàng</button>
								</div>
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
		<script src="/assets_trangchu/js/jquery-3.4.1.min.js"></script>
		<script src="/assets_trangchu/js/custom.js"></script>
       
        <script>
            new Vue({
                el      :   '#app',
                data    :   {
                    listCart    : [],
                    tong_tien   : 0,
                    arrayBill    : [],
                    sanPham : [],
                    tongsotien: 0,
                    tien_ship : 0,
                    dataNguoiNhan:{
                        ten_nguoi_nhan: '',
                        sdt_nguoi_nhan: '',
                        email_nguoi_nhan: '',
                        dia_chi_nguoi_nhan:'',
                        loai_thanh_toan:'',
                        phi_van_chuyen:'',
                    }
                },
                created() {
                    this.loadCart();
                    this.csc();
                },
                methods :   {
                    loadCart() {
                        axios
                            .get('/cart/data')
                            .then((res) => {
                                this.listCart = res.data.data;
                            });
                    },
                    loadGiaSanPham() {
                        axios
                            .get('/admin/san-pham/data')
                            .then((res) => {
                                this.sanPham = res.data.listSanPham;
                            });
                    },
                    csc() {
                        axios
                            .get('/chi-tiet-bill/data')
                            .then((res) => {
                                this.arrayBill = res.data.dataBillGate
                            });
                    },
                    total(){
                        var tong_tien =0;
                        this.listCart.forEach((value, key )=>{
                            tong_tien += (value.don_gia * value.so_luong) -(-(this.dataNguoiNhan.phi_van_chuyen));

                        });
                        return tong_tien;
                    },
                    totalduocgiam(){
                        var tiengiam =0;
                        this.listCart.forEach((value, key )=>{
                            tiengiam += value.tien_duoc_giam * value.so_luong;
                        });
                        return tiengiam;
                    },
                    tongtien(){
                        var tongsotien =0;
                        this.listCart.forEach((value, key )=>{
                            tongsotien += value.tong_tien_san_pham * value.so_luong;
                        });
                        return tongsotien;
                    },
                    // tienship(){
                    //     var tien_ship =0;
                    //     this.listCart.forEach((value, key )=>{
                    //         if( value.don_gia  <=  value.don_gia_khuyen_mai ) {
                    //              tien_ship = 100000;
                    //         } else {
                    //              tien_ship = 0;
                    //         }
                    //     });
                    //     return tien_ship;
                    // },
                    formatNumber(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                    },
                    updateRow(row) {
                    axios
                        .post('/cart-update', row)
                        .then((res) => {
                            if(res.status) {
                                toastr.success("Đã cập nhật đơn hàng!");
                                // alert('Đã cập nhật giỏ hàng')
                                this.loadCart();
                            }
                        });
                    },
                    createBill(){
                        axios
                            .post('/create-bill' , this.dataNguoiNhan)
                            .then((res)=>{
                                if(res.data.status){
                                    // console.log(res.data.status);
                                    alert('Đã tạo đơn hàng thành công!')
                                }else if(!res.data.status){
                                    // toastr.error("Có lỗi xảy ra!");
                                    alert('Đơn hàng trống')
                                }else{
                                    // toastr.warning("Giỏ hàng rỗng!");
                                    alert('Bạn chưa đăng nhập')
                                }
                            })
                            .catch((res) => {
                            var danh_sach_loi = res.response.data.errors;
                            $.each(danh_sach_loi, function(key, value){
                                // toastr.error(value[0]);
                                alert(value[0])
                            });
                        });
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

