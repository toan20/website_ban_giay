@extends("share.master")
@section('title')
    Quản lý danh mục
@endsection
@section("content")
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Thêm Mới Danh Mục Sản Phẩm</h5>
            </div>
            <form class="form theme-form">
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $key => $value)
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert"><i data-feather="thumbs-down"></i>
                            <p> {{ $value }}.</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach

                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Mã Danh Mục</label>
                                <input class="form-control" id="ma_danh_muc" name="ma_danh_muc" type="text"
                                    placeholder="Nhập vào mã danh mục sản phẩm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Tên Danh Mục</label>
                                <input class="form-control" id="ten_danh_muc" name="ten_danh_muc" type="text"
                                    placeholder="Nhập vào tên danh mục sản phẩm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Slug Danh Mục</label>
                                <input class="form-control" id="slug_danh_muc" name="slug_danh_muc" type="text"
                                    placeholder="Nhập vào slug danh mục sản phẩm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Danh Mục Cha</label>
                                <select name="id_danh_muc_cha" id="id_danh_muc_cha" class="form-control">
                                    <option value=0>Root</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Tình Trạng</label>
                                <select name="is_open" id="is_open" class="form-control">
                                    <option value=1>Hiển Thị</option>
                                    <option value=0>Tạm Tắt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="createDanhMuc" class="btn btn-primary" type="button">Submit</button>
                    <input class="btn btn-light" type="reset" value="Cancel">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Danh Sách Danh Mục Sản Phẩm</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="danhSachDanhMuc">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Mã Danh Mục</th>
                            <th scope="col">Tên Danh Mục</th>
                            <th scope="col">Danh Mục Cha</th>
                            <th scope="col">Tình Trạng</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Danh Mục</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="id_danh_muc_edit" hidden>
                                <div class="mb-3">
                                    <label class="form-label">Mã Danh Mục</label>
                                    <input class="form-control" id="ma_danh_muc_edit" name="ma_danh_muc" type="text"
                                        placeholder="Nhập vào mã danh mục sản phẩm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên Danh Mục</label>
                                    <input class="form-control" id="ten_danh_muc_edit" name="ten_danh_muc" type="text"
                                        placeholder="Nhập vào tên danh mục sản phẩm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug Danh Mục</label>
                                    <input class="form-control" id="slug_danh_muc_edit" name="slug_danh_muc" type="text"
                                        placeholder="Nhập vào slug danh mục sản phẩm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh Mục Cha</label>
                                    <select name="id_danh_muc_cha" id="id_danh_muc_cha_edit" class="form-control">
                                        <option value=0>Root</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tình Trạng</label>
                                    <select name="is_open" id="is_open_edit" class="form-control">
                                        <option value=1>Hiển Thị</option>
                                        <option value=0>Tạm Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                              <button id="updateDanhMuc" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cập Nhật Danh Mục</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Xóa Danh Mục</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="id_danh_muc_delete" hidden>
                                <div class="alert alert-secondary" role="alert">
                                    <h4 class="alert-heading">Xóa Danh Mục!</h4>
                                    <p>Bạn có chắc chắn muốn xóa danh mục sản phẩm này không?.</p>
                                    <hr>
                                    <p class="mb-0"><i>Lưu ý: Hành động không thể khôi phục lại</i>.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                              <button id="deleteDanhMuc" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Xóa Danh Mục</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $("#createDanhMuc").click(function() {
                console.log("Đã click vào nút Danh mục");
                var danhMuc = {
                    'ma_danh_muc'       :   $("#ma_danh_muc").val(),
                    'ten_danh_muc'      :   $("#ten_danh_muc").val(),
                    'slug_danh_muc'     :   $("#slug_danh_muc").val(),
                    'id_danh_muc_cha'   :   $("#id_danh_muc_cha").val(),
                    'is_open'           :   $("#is_open").val(),
                };


                $.ajax({
                    url     :   '/admin/danh-muc/index',
                    type    :   'post',
                    data    :   danhMuc,
                    success :  function(res) {
                        if(res.status) {
                            toastr.success('Đã thêm mới danh mục thành công!');
                            loadListDanhMuc();
                        }
                    },
                    error   :   function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            $("#updateDanhMuc").click(function() {
                console.log("Đã click vào nút Danh mục");
                var danhMuc = {
                    'id'                :   $("#id_danh_muc_edit").val(),
                    'ma_danh_muc'       :   $("#ma_danh_muc_edit").val(),
                    'ten_danh_muc'      :   $("#ten_danh_muc_edit").val(),
                    'slug_danh_muc'     :   $("#slug_danh_muc_edit").val(),
                    'id_danh_muc_cha'   :   $("#id_danh_muc_cha_edit").val(),
                    'is_open'           :   $("#is_open_edit").val(),
                };

                $.ajax({
                    url     :   '/admin/danh-muc/update',
                    type    :   'post',
                    data    :   danhMuc,
                    success :   function(res) {
                        toastr.success("Đã cập nhật danh mục thành công!");
                        loadListDanhMuc();
                    },
                    error   :   function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            loadListDanhMuc();

            $('body').on('click','.doiTrangThai',function(){
                var danh_muc_id = $(this).data('id');
                $.ajax({
                    url     :   '/admin/danh-muc/update-status/' + danh_muc_id,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            toastr.success("Đã cập nhật danh mục!");
                            loadListDanhMuc();
                        } else {
                            toastr.error("Có lỗi không mong muốn xảy ra!");
                        }
                    },
                });
            });

            $("body").on('click', '.edit', function(){
                var id_danh_muc = $(this).data('id');
                console.log("Cần update danh mục có id: " + id_danh_muc);
                $.ajax({
                    url     :       '/admin/danh-muc/edit/' + id_danh_muc,
                    typoe   :       'get',
                    success :       function(res) {
                        if(res.status) {
                            $("#id_danh_muc_edit").val(res.data.id);
                            $("#ma_danh_muc_edit").val(res.data.ma_danh_muc);
                            $("#ten_danh_muc_edit").val(res.data.ten_danh_muc);
                            $("#slug_danh_muc_edit").val(res.data.slug_danh_muc);
                            $("#is_open_edit").val(res.data.is_open);
                            $("#id_danh_muc_cha_edit").val(res.data.id_danh_muc_cha);
                        } else {
                            toastr.error('Có lỗi xảy ra!');
                        }
                    }
                });
            });

            $("#deleteDanhMuc").click(function() {
                var id = $("#id_danh_muc_delete").val();
                $.ajax({
                    url     :   '/admin/danh-muc/destroy/' + id,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            toastr.success("Đã xóa danh mục thành công!");
                            loadListDanhMuc();
                        } else {
                            toastr.error("Danh mục không tồn tại!");
                        }
                    },
                });
            });

            $("body").on('click', '.delete', function(){
                var id_danh_muc = $(this).data('id');
                $("#id_danh_muc_delete").val(id_danh_muc);
            });

            function loadDanhMucCha(listDanhMucCha)
            {
                var html_danh_muc_cha = "<option value=0>Root</option>";
                $.each(listDanhMucCha, function(key, value) {
                    html_danh_muc_cha = html_danh_muc_cha + '<option value='+ value.id +'>' + value.ten_danh_muc + '</option>';
                });
                $("#id_danh_muc_cha").html(html_danh_muc_cha);
                $("#id_danh_muc_cha_edit").html(html_danh_muc_cha);
            }

            function loadListDanhMuc()
            {
                $.ajax({
                    url     :   '/admin/danh-muc/get-data',
                    type    :   'get',
                    success :   function(res) {
                        viewTable(res.data);
                        loadDanhMucCha(res.dataCha);
                    },
                });
            }

            function viewTable(listDanhMuc)
            {
                var content = '';
                $.each(listDanhMuc, function(key, value) {
                    content += createRow(value, key + 1);
                });
                $("#danhSachDanhMuc tbody").html(content);
            }

            function createRow(danhMuc, stt)
            {
                var content = '';

                content += '<tr class="align-middle">';
                content += '<th scope="row" class="text-center">' + stt + '</th>';
                content += '<td>' + danhMuc.ma_danh_muc + '</td>';
                content += '<td>' + danhMuc.ten_danh_muc + '</td>';
                content += '<td>' + danhMuc.id_danh_muc_cha + '</td>';
                content += '<td class="text-center">';
                if(danhMuc.is_open) {
                    content += '<button class="btn btn-primary doiTrangThai" data-id="'+ danhMuc.id + '"> Hiển Thị';
                } else {
                    content += '<button class="btn btn-danger doiTrangThai" data-id="'+ danhMuc.id + '"> Tạm Tắt';
                }
                content += '</button>';
                content += '</td>';
                content += '<td class="text-center">';
                content += '<button class="btn btn-info edit" data-id="'+ danhMuc.id + '" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>';
                content += '<button class="btn btn-danger delete" data-id="'+ danhMuc.id + '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
                content += '</td>';
                content += '</tr>';

                return content;
            }
        });
</script>
@endsection
