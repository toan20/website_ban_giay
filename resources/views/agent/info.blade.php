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
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/shoes.css">
    <link rel="stylesheet" type="text/css" href="/assets_trangchu/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .billing-details {
            border: 1px solid;
            padding: 30px;
            border-radius: 20px;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 20px;
        }



        .form-group input {
            border-radius: 20px;
        }
    </style>
    @css
</head>

<body>
    <!-- Start preloader -->
    <!-- <div id="preloader"></div> -->
    <!-- End preloader -->
    <!-- Search Screen start -->
    <div class="sidebar-search-wrap">
        <div class="sidebar-table-container">
            <div class="sidebar-align-container">
                <div class="search-closer right-side"></div>
                <div class="search-container">
                    <form method="get" id="search-form">
                        <input type="text" id="s" class="search-input" name="s"
                            placeholder="Search text">
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
                            <div class="menu">
                                <ul>
                                    <li>
                                        <a href="http://127.0.0.1:8000">Trang Chủ</a>
                                    </li>
                                    @foreach ($menuCha as $key => $value_cha)
                                        <li class="dropdown">
                                            <span class="opener plus"></span>
                                            <a href="/danh-muc/{{ $value_cha->slug_danh_muc }}-post{{ $value_cha->id }}">{{ $value_cha->ten_danh_muc }}</a>
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
                                    <input type="text" name="search" id="searchSanPham" class="search-input"
                                        placeholder="Tên sản phẩm">
                                    <input type="submit" name="submit" class="search-btn">
                                    <div class="search-button-i transition">
                                        <img src="/assets_trangchu/images/search.png" class="position-r transition"
                                            alt="search">
                                    </div>
                                </form>
                            </div>
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
                            <h1 class="page-banner-title text-uppercase">Thay đổi thông tin khách hàng</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container" id="app" style="height:700px;overflow-y: scroll;padding:20px;border:1px solid">
            <section class="login pt-100">
                <div class="billing-details">

                    <input type="text" v-model="newinfo.id" hidden>
                    <h2 class="checkout-title text-uppercase text-center mb-30" >Thay đổi thông tin
                    </h2>
                    <div class="form-group">
                        <label class="form-label">Email của bạn</label>
                        <input type="text" v-model="newinfo.email" class="form-control"
                        placeholder="Nhập email mới" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Số điện thoại của bạn</label>
                        <input type="text" v-model="newinfo.so_dien_thoai" class="form-control"
                            placeholder="Nhập số điện thoại mới" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Họ và tên </label>
                        <input type="text" v-model="newinfo.ho_va_ten" class="form-control"
                            placeholder="Nhập Họ và tên mới" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Thành Phố</label>
                        <input type="text" v-model="newinfo.thanh_pho" class="form-control"
                            placeholder="Nhập vào thành phố mới" required>
                    </div>
                    <div class="login-btn-g mt-5"
                        style="border-top:1px solid rgb(244, 227, 227);padding-top:20px;border-bottom:none">
                        <div class="row" style="display: flex;justify-content: flex-end">
                            <div class="col">
                                <button v-on:click="createNewin4()" name="submit" type="submit" id="login"
                                    class="btn btn-color right-side">Lưu</button>
                                @if (Auth::guard('agent')->check())
                                <button   class="btn btn-color right-side mr-2" type="submit" v-on:click="showIn4({{Auth::guard('agent')->id()}})"> edit </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{--
                <span>@{{v.ho_va_ten}} </span>
                <span>@{{v.email}} </span>
                <span>@{{v.so_dien_thoai}} </span>
                </template> --}}
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
                        <p class="footer-desc">Lorem ipsum dolor sit amet, consectetur adipi-scing elit. In purus sem,
                            consectetur sed aliquam vel, hendrerit in elit. Nunc interdum dolor at quam pulvinar
                            sodales. Nunc venenatis egestas mi ac fermentum.</p>
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
                            <li><img src="/assets_trangchu/images/cont-1.png" alt="img"><span>28 Green Tower,
                                    Street Name <br>New York City, USA</span></li>
                            <li><img src="/assets_trangchu/images/cont-2.png" alt="img"><a
                                    href="tel:+911234567890">+ 91 123 456 789 0</a></li>
                            <li><img src="/assets_trangchu/images/cont-3.png" alt="img"><a
                                    href="mailto:xpoge@example.com">xpoge@example.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="copy-right mt-100">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <p class="copyright-text">&#169; Xpoge all Rights Reserverd theme by <a
                                    href="https://templatescoder.com/" target="_blank">TemplatesCoder</a></p>
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
    new Vue({
        el: '#app',
        data: {
            newinfo: {
                id: 0,
                email: '',
                thanh_pho: '',
                so_dien_thoai: '',
                ho_va_ten: '',
            },
        },
        methods: {
            createNewin4() {
                axios
                    .post('/updateIF', this.newinfo)
                    .then((res) => {
                        if (res.data.status) {
                            alert('Xác nhận thay đổi ?');
                            this.showIn4()
                        }
                    });
            },
            showIn4(id) {
                axios
                    .get('/showin4/' + id)
                    .then((res) => {
                        if(res.data.stt){
                         this.newinfo = res.data.data
                        }
                    });
            },

        },

    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        $("#searchSanPham").keyup(function() {
            var search = $("#searchSanPham").val();
            console.log(search);

        });

    })
</script>
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

</html>
