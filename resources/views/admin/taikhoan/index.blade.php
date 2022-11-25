@extends('share.master')
@section('title')
    Quản lý Tài khoản Quản Trị
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form id="formCreate">
                    <div class="card-header">
                        <h5>Thêm Mới Tài Khoản Quản Trị</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Email Quản Trị</label>
                                    <input tabindex="1" class="form-control" id="email" name="email" type="text"
                                        placeholder="Nhập vào email của tài khoản quản trị">
                                    <small class="text-danger" id="message_email"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Họ Và Tên</label>
                                    <input tabindex="1" class="form-control" id="full_name" name="full_name" type="text"
                                        placeholder="Nhập vào họ và tên của tài khoản quản trị">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Số Điện Thoại</label>
                                    <input tabindex="1" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                        type="text" placeholder="Nhập vào số điện thoại của tài khoản quản trị">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Mật Khẩu</label>
                                    <input tabindex="1" class="form-control" id="password" name="password"
                                        type="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Nhập Lại Mật Khẩu</label>
                                    <input tabindex="1" class="form-control" id="re_password" name="re_password"
                                        type="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Giới Tính</label>
                                    <select name="gioi_tinh" id="gioi_tinh" class="form-control">
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                        <option value="2">Không xác định</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Quyền Quản Trị</label>
                                    <select name="is_master" id="is_master" class="form-control">
                                        <option value="1">Admin Boss - Trùm</option>
                                        <option value="0">Admin Bình Thường</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="button" id="createAdmin">Tạo Tài Khoản</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Danh sách Tài Khoản Quản Trị</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="danhSachAdmin">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Họ Và Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số Điện Thoại</th>
                                <th scope="col">Loại Admin</th>
                                <th scope="col">Tinh Trạng</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="updateAccount">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật tài khoản</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <input type="text" name="id" id="id" class="form-control" hidden>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email Quản Trị</label>
                                                        <input tabindex="1" class="form-control" id="email_edit"
                                                            name="email" type="text"
                                                            placeholder="Nhập vào email của tài khoản quản trị">
                                                        <small class="text-danger" id="message_email"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Họ Và Tên</label>
                                                        <input tabindex="1" class="form-control" id="full_name_edit"
                                                            name="full_name" type="text"
                                                            placeholder="Nhập vào họ và tên của tài khoản quản trị">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Số Điện Thoại</label>
                                                        <input tabindex="1" class="form-control" id="so_dien_thoai_edit"
                                                            name="so_dien_thoai" type="text"
                                                            placeholder="Nhập vào số điện thoại của tài khoản quản trị">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Mật Khẩu</label>
                                                        <input tabindex="1" class="form-control" id="password_edit"
                                                            name="password" type="password">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nhập Lại Mật Khẩu</label>
                                                        <input tabindex="1" class="form-control" id="re_password_edit"
                                                            name="re_password" type="password">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Giới Tính</label>
                                                        <select name="gioi_tinh" id="gioi_tinh_edit" class="form-control">
                                                            <option value="1">Nam</option>
                                                            <option value="0">Nữ</option>
                                                            <option value="2">Không xác định</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Tình Trạng</label>
                                                        <select name="is_block" id="is_block_edit" class="form-control">
                                                            <option value="1">Đã Khóa</option>
                                                            <option value="0">Hoạt Động</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Quyền Quản Trị</label>
                                                        <select name="is_master" id="is_master_edit" class="form-control">
                                                            <option value="1">Admin Boss - Trùm</option>
                                                            <option value="0">Admin Bình Thường</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-secondary" type="submit">Cập nhật</button>
                                        </div>
                                    </form>
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
        $(document).ready(function() {
            $("#email").blur(function() {
                var payload = {
                    'email': $("#email").val(),
                };
                $.ajax({
                    url: '/admin/account/check-email',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            $("#message_email").html(
                                '<span class="text-primary">Email có thể được sử dụng</span>'
                                );
                        } else {
                            $("#message_email").html(
                                '<span class="text-danger">Email đã tồn tại</span>');
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            $("#createAdmin").click(function() {
                var payload = {
                    'email': $("#email").val(),
                    'full_name': $("#full_name").val(),
                    'so_dien_thoai': $("#so_dien_thoai").val(),
                    'gioi_tinh': $("#gioi_tinh").val(),
                    'is_master': $("#is_master").val(),
                    'password': $("#password").val(),
                    're_password': $("#re_password").val(),
                };
                $.ajax({
                    url: '/admin/account/index',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        toastr.success("Đã thêm mới tài khoản Admin thành công");
                        loadData();
                        $("#formCreate").trigger("reset");
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            loadData();

            function loadData() {
                $.ajax({
                    url: '/admin/account/data',
                    type: 'get',
                    success: function(res) {
                        var content = '';
                        $.each(res.data, function(key, value) {
                            if (value.is_master == 1) {
                                var Loai = "Admin Trùm";
                            } else {
                                var Loai = "Admin Thường"
                            }

                            content += '<tr>';
                            content += '<th scope="col" class="text-center">' + (key + 1) +
                                '</th>';
                            content += '<th>' + value.ho_lot + ' ' + value.ten + '</th>';
                            content += '<th>' + value.email + '</th>';
                            content += '<th>' + value.so_dien_thoai + '</th>';
                            content += '<th>' + Loai + '</th>';
                            content += '<td>';
                            if (value.is_block == 1) {
                                content += '<button class="btn btn-danger">Đã Khóa</button>';
                            } else {
                                content += '<button class="btn btn-primary">Hoạt Động</button>';
                            }
                            content += '</td>';
                            content += '<td>';
                            content += '<button class="btn btn-info edit" data-id="' + value
                                .id +
                                '" data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhật</button>';
                            content += '</td>';
                            content += '</tr>';
                        });
                        $("#danhSachAdmin tbody").html(content);
                    },
                });
            }

            $("body").on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/admin/account/edit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            $("#id").val(res.data.id);
                            $("#email_edit").val(res.data.email);
                            $("#full_name_edit").val(res.data.ho_lot + ' ' + res.data.ten);
                            $("#so_dien_thoai_edit").val(res.data.so_dien_thoai);
                            $("#gioi_tinh_edit").val(res.data.gioi_tinh);
                            $("#is_master_edit").val(res.data.is_master);
                            $("#is_block_edit").val(res.data.is_block);
                        } else {
                            toastr.error("Tài khoản không tồn tại!");
                        }
                    },
                });
            });

            $("#updateAccount").submit(function(e) {
                e.preventDefault();
                window.getFormData = function ($form) {
                    var unindexed_array = $form.serializeArray();
                    var indexed_array = {};
                    console.log(unindexed_array);
                    $.map(unindexed_array, function (n, i) {
                        indexed_array[n["name"]] = n["value"];
                 });

                return indexed_array;
            };
                console.log("Click submit");
                var payload = window.getFormData($(this));
                $.ajax({
                    url: '/admin/account/update',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            loadData();
                            toastr.success('Đã cập nhật tài khoản');
                        } else {
                            toastr.warning(res.message);
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });
        });
    </script>
@endsection
