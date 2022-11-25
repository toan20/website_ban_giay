<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets_admin/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/assets_admin/css/vendors/icofont.css">
    <!-- Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets_admin/css/style.css">
    <link id="color" rel="stylesheet" href="/assets_admin/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets_admin/css/responsive.css">
    <script src="/assets_admin/js/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap js-->
        <script src="/assets_admin/js/bootstrap/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="login-main">
        <div style="text-align: center" class="row">
            <div class="col-md-4"></div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Sign in to account</h4>
                        <p>Enter your email & password to login</p>
                    </div>
                    <div class="card-body">
                        <form class="theme-form" autocomplete="off">

                            <div class="form-group">
                                <label class="col-form-label">Email or Phone</label>
                                <input autocomplete="off" class="form-control" id="username" name="user_name" type="email" required="" placeholder="Nhập vào email hoặc số điện thoại">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input autocomplete="off" class="form-control" type="password" name="password" required="" id="password"
                                        placeholder="Nhập vào nhập khẩu">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Remember password</label>
                                </div>
                                <button class="btn btn-primary btn-block w-100" type="button" id="login">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</body>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".show-hide").click(function(){
            console.log(123);
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                 x.type = "password";
             }
        })
        $("#login").click(function() {
            var payload = {
                'username'  :   $("#username").val(),
                'password'  :   $("#password").val(),
            };
            $.ajax({
                url     :   '/admin/login',
                type    :   'post',
                data    :   payload,
                success :   function(res) {
                    if(res.status) {
                        window.location.href = "http://127.0.0.1:8000/admin/danh-muc/index";
                    } else {
                        toastr.error('Đăng nhập thất bại!');
                    }
                },
                error   :   function(res) {
                    var listError = res.responseJSON.errors;
                    $.each(listError, function(key, value) {
                        toastr.error(value[0]);
                    });
                },
            });
        })

    })
</script>

</html>
