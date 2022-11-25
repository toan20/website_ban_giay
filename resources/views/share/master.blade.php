<!DOCTYPE html>
<html lang="en">

<head>
    @include("share.header")
</head>

<body>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('share.top')
        <div class="page-body-wrapper">
            @include('share.menu')
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>@yield('title')</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row second-chart-list third-news-update">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('share.foot')
        </div>
    </div>
    @include('share.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script src="/js/app.js"></script>
    @yield('js')
</body>

</html>
