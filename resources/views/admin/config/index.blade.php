@extends('share.master')
@section('title')
    <h3>Quản Lý Slide</h3>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card" style="height: auto">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-colored-form-control">Thêm mới danh mục</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="/admin/cau-hinh" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label>Silde 1</label>
                                    <div class="input-group">
                                        <input id="hinh_anh" name="slide_1" class="form-control" type="text" value="{{ (isset($config->slide_1) && Str::length($config->slide_1) > 0) ? $config->slide_1 : ''}}">
                                        <input type="button" class="btn-info lfm" data-input="hinh_anh" data-preview="holder" value="Upload">
                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ (isset($config->slide_1) && Str::length($config->slide_1) > 0) ? $config->slide_1 : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label>Silde 2</label>
                                    <div class="input-group">
                                        <input id="hinh_anh" name="slide_2" class="form-control" type="text" value="{{ (isset($config->slide_2) && Str::length($config->slide_2) > 0) ? $config->slide_2 : ''}}">
                                        <input type="button" class="btn-info lfm" data-input="hinh_anh" data-preview="holder" value="Upload">
                                    </div>
                                    <img id="holder1" style="margin-top:15px;max-height:100px;" src="{{ (isset($config->slide_2) && Str::length($config->slide_2) > 0) ? $config->slide_2 : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label>Silde 3</label>
                                    <div class="input-group">
                                        <input id="hinh_anh" name="slide_3" class="form-control" type="text" value="{{ (isset($config->slide_3) && Str::length($config->slide_3) > 0) ? $config->slide_3 : ''}}">
                                        <input type="button" class="btn-info lfm" data-input="hinh_anh" data-preview="holder" value="Upload">
                                    </div>
                                    <img id="holder2" style="margin-top:35px;max-height:300px;" src="{{ (isset($config->slide_3) && Str::length($config->slide_3) > 0) ? $config->slide_3 : ''}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="submit" class="btn btn-primary">
                                Cập Nhật Cấu Hình
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    $('.lfm').filemanager('image');
</script>
@endsection
