@extends('share.master')
@section('title')
    Quản lý sản phẩm
@endsection
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Mã Sản Phẩm</label>
                        <input tabindex="1" class="form-control" id="ma_san_pham" name="ma_san_pham" type="text"
                            placeholder="Nhập vào mã sản phẩm">
                            <small class="text-danger" id="message_ma_san_pham"><i></i></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tên Sản Phẩm</label>
                        <input tabindex="2" class="form-control" id="ten_san_pham" name="ten_san_pham" type="text"
                            placeholder="Nhập vào tên sản phẩm">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Slug Sản Phẩm</label>
                        <input class="form-control" id="slug_san_pham" name="slug_san_pham" type="text"
                            placeholder="Nhập vào slug sản phẩm">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Hiển Thị</label>
                        <select name="is_open" id="is_open" class="form-control">
                            <option value=1>Hiển Thị</option>
                            <option value=0>Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Giá Bán</label>
                        <input tabindex="3" class="form-control" id="don_gia_ban" name="don_gia_ban" type="number"
                            placeholder="Nhập vào giá bán sản phẩm">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Giá Khuyến Mãi</label>
                        <input tabindex="4" class="form-control" id="don_gia_khuyen_mai" name="don_gia_khuyen_mai" type="number"
                            placeholder="Nhập vào giá khuyến mãi sản phẩm">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Hình Ảnh</label>
                        <div class="input-group">
                            <input  id="hinh_anh" class="form-control"  type="text"  name="file_name">
                            {{-- <input type="text" class="form-control" id="hinh_anh" > --}}
                         </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Danh Mục</label>
                        <select tabindex="6" name="danh_muc_id" id="danh_muc_id" class="form-control">
                            <option value=0>Hiển Thị</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label">Mô Tả Ngắn</label>
                    <textarea tabindex="7" class="form-control" id="mo_ta_ngan" name="mo_ta_ngan" cols="30" rows="10" placeholder="Nhập vào mô tả ngắn sản phẩm"></textarea>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Mô Tả Chi Tiết</label>
                    <textarea tabindex="8" class="form-control" id="mo_ta_chi_tiet" name="mo_ta_chi_tiet" cols="30" rows="10" placeholder="Nhập vào mô tả chi tiết sản phẩm"></textarea>
                </div>
            </div>
            <div class="card-footer text-end">
                <button id="createSanPham" class="btn btn-primary" type="button" disabled>Thêm Mới Sản Phẩm</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <h5>Danh Sách Sản Phẩm</h5>
        </div>
        <div class="card-body">
            <table  class="table table-bordered" id="danhSachDanhMuc">
                <thead style="">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Mã Sản Phẩm</th>
                        <th scope="col">Tên Sản Phẩm</th>
                        <th scope="col">Danh Mục</th>
                        <th scope="col">Giá Bán</th>
                        <th scope="col">Giá Khuyến Mãi</th>
                        <th scope="col">Hình Ảnh</th>
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
                          <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Sản Phẩm</h5>
                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="id_san_pham_edit" hidden>
                            <div class="mb-3">
                                <label class="form-label">Mã Sản Phẩm</label>
                                <input class="form-control" id="ma_san_pham_edit" name="ma_san_pham" type="text"
                                    placeholder="Nhập vào mã Sản Phẩm sản phẩm">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên Sản Phẩm</label>
                                <input class="form-control" id="ten_san_pham_edit" name="ten_san_pham" type="text"
                                    placeholder="Nhập vào tên Sản Phẩm sản phẩm">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug Sản Phẩm</label>
                                <input class="form-control" id="slug_san_pham_edit" name="slug_san_pham" type="text"
                                    placeholder="Nhập vào slug danh mục sản phẩm">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tình Trạng</label>
                                <select name="is_open" id="is_open_edit" class="form-control">
                                    <option value=1>Hiển Thị</option>
                                    <option value=0>Tạm Tắt</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá bán</label>
                                <input class="form-control" id="don_gia_ban_edit" name="don_gia_ban" type="text"
                                    placeholder="Nhập vào Giá  sản phẩm">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá Khuyến Mãi</label>
                                <input class="form-control" id="don_gia_khuyen_mai_edit" name="don_gia_khuyen_mai" type="text"
                                    placeholder="Nhập vào giá khuyến mãi">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type = "" class="form-control" id="hinh_anh_edit" name="hinh_anh" type="text"
                                    placeholder="Nhập vào hình ảnh sản phẩm">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Danh Mục</label>
                                <select name="danh_muc_id" id="danh_muc_id_edit" class="form-control">
                                    <option value=0>Root</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả ngắn</label>
                                <input class="form-control" id="mo_ta_ngan_edit" name="mo_ta_ngan" type="text"
                                    placeholder="Nhập vào mô tả ngắn">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả chi tiết</label>
                                <input class="form-control" id="mo_ta_chi_tiet_edit" name="mo_ta_chi_tiet" type="text"
                                    placeholder="Nhập vào mô tả chi tiết">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                          <button id="updateSanPham" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Update Sản Phẩm</button>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xóa Sản Phẩm</h5>
                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="id_san_pham_delete" hidden>
                            <div class="alert alert-secondary" role="alert">
                                <h4 class="alert-heading">Xóa Sản Phẩm!</h4>
                                <p>Bạn có chắc chắn muốn xóa sản phẩm sản phẩm này không?.</p>
                                <hr>
                                <p class="mb-0"><i>Lưu ý: Hành động không thể khôi phục lại</i>.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                          <button id="deleteSanPham" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Xóa Sản Phẩm</button>
                        </div>
                      </div>
                    </div>
                </div>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('mo_ta_chi_tiet');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function formatNumber(number)
            {
                return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
            }
            function converToSlug(str) {
                str = str.toLowerCase();

                str = str
                    .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                    .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

                // Thay ký tự đĐ
                str = str.replace(/[đĐ]/g, 'd');

                // Xóa ký tự đặc biệt
                str = str.replace(/([^0-9a-z-\s])/g, '');

                // Xóa khoảng trắng thay bằng ký tự -
                str = str.replace(/(\s+)/g, '-');

                // Xóa ký tự - liên tiếp
                str = str.replace(/-+/g, '-');

                // xóa phần dư - ở đầu & cuối
                str = str.replace(/^-+|-+$/g, '');

                // return
                return str;
            };
            $("#ten_san_pham").keyup(function(){
                var ten_san_pham  = $("#ten_san_pham").val();
                var slug = converToSlug(ten_san_pham);
                $("#slug_san_pham").val(slug);
            });

            $("#createSanPham").click(function() {
                var payload = {
                    'ma_san_pham'         : $('#ma_san_pham').val(),
                    'ten_san_pham'        : $('#ten_san_pham').val(),
                    'slug_san_pham'       : $('#slug_san_pham').val(),
                    'is_open'             : $('#is_open').val(),
                    'don_gia_ban'         : $('#don_gia_ban').val(),
                    'don_gia_khuyen_mai'  : $('#don_gia_khuyen_mai').val(),
                    'danh_muc_id'         : $('#danh_muc_id').val(),
                    'hinh_anh'            : $('#hinh_anh').val(),
                    'mo_ta_ngan'          : $('#mo_ta_ngan').val(),
                    'mo_ta_chi_tiet'      : CKEDITOR.instances['mo_ta_chi_tiet'].getData(),
                };
                console.log(payload);
                $.ajax({
                    url     :   '/admin/san-pham/index',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        toastr.success('Đã thêm mới sản phẩm thành công!');
                        loadTable();
                    },
                    error   : function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            loadDanhMuc();
            loadTable();

            function loadDanhMuc()
            {
                $.ajax({
                    url     :   '/admin/danh-muc/get-data',
                    type    :   'get',
                    success :   function(res) {
                        var contentDanhMuc = '';
                        $.each(res.data, function(key, value) {
                            contentDanhMuc += '<option value='+ value.id +'>' + value.ten_danh_muc +'</option>'
                        });
                        $("#danh_muc_id").html(contentDanhMuc);
                        $("#danh_muc_id_edit").html(contentDanhMuc);
                    },
                });
            }

            $("#ma_san_pham").blur(function() {
                var payload = {
                    'ma_san_pham'   : $("#ma_san_pham").val(),
                };
                $.ajax({
                    url     :   '/admin/san-pham/check-product-id',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        if(res.status) {
                            $("#message_ma_san_pham").text("Mã sản phẩm đã tồn tại!");
                            $("#ma_san_pham").removeClass("border border-primary");
                            $("#ma_san_pham").addClass("border border-danger");
                            $("#createSanPham").prop('disabled', true);
                        } else {
                            $("#message_ma_san_pham").text("Mã sản phẩm có thể tạo!");
                            $("#message_ma_san_pham").addClass("text-primary")
                            $("#message_ma_san_pham").removeClass("text-danger");
                            $("#ma_san_pham").removeClass("border border-danger");
                            $("#ma_san_pham").addClass("border border-primary");
                            $("#createSanPham").prop('disabled', false);
                        }
                    },
                    error   : function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            function loadTable() {
                $.ajax({
                    url     :   '/admin/san-pham/data',
                    type    :   'get',
                    success :   function(res) {
                        var listSanPham = res.listSanPham;
                        var contentTable = '';
                        $.each(listSanPham, function(key, value) {
                            contentTable += '<tr class="align-middle">';
                            contentTable += '<th class="text-center">'+ (key + 1) +'</th>';
                            contentTable += '<td class="text-nowrap">'+ value.ma_san_pham +'</td>';
                            contentTable += '<td class="text-nowrap">'+ value.ten_san_pham +'</td>';
                            contentTable += '<td class="text-nowrap">'+ value.ten_danh_muc +'</td>';
                            contentTable += '<td class="text-nowrap">'+ formatNumber(value.don_gia_ban) +'</td>';
                            contentTable += '<td class="text-nowrap">'+ formatNumber(value.don_gia_khuyen_mai) +'</td>';
                            contentTable += '<td class="text-nowrap">';
                            contentTable += '<img  style ="width: 80px" src="'+ value.hinh_anh +'">';
                            contentTable += '</td>';
                            contentTable += '<td class="text-nowrap text-center">';
                            if(value.is_open == 1) {
                                contentTable += '<button class="btn btn-primary doiTrangThai" data-id="'+ value.id + '"> Hiển Thị';
                            } else {
                                contentTable += '<button class="btn btn-danger doiTrangThai" data-id="'+ value.id + '"> Tạm Tắt';
                            }
                            contentTable += '</td>';
                            contentTable += '<td class="text-nowrap text-center">';
                            contentTable += '<button class="btn btn-info edit" data-id="'+ value.id + '" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>';
                            contentTable += '<button class="btn btn-danger delete" data-id="'+ value.id + '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
                            contentTable += '</td>';
                            contentTable += '</tr>';
                        });
                        $("#danhSachDanhMuc tbody").html(contentTable);
                    },
                });
            }
            $('body').on('click','.doiTrangThai',function(){
                var san_pham_id = $(this).data('id');
                $.ajax({
                    url     :   '/admin/san-pham/update-status/' + san_pham_id,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            toastr.success("Đã cập nhật sản phẩm!");
                            loadTable();
                        } else {
                            toastr.error("Có lỗi không mong muốn xảy ra!");
                        }
                    },
                });
            });
            $("#deleteSanPham").click(function() {
                var id = $("#id_san_pham_delete").val();
                $.ajax({
                    url     :   '/admin/san-pham/destroy/' + id,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            toastr.success("Đã xóa sản phẩm thành công!");
                            loadTable();
                        } else {
                            toastr.error("Sản phẩm không tồn tại!");
                        }
                    },
                });
            });
            $("body").on('click', '.delete', function(){
                var id_san_pham = $(this).data('id');
                $("#id_san_pham_delete").val(id_san_pham);
            });
            $("body").on('click', '.edit', function(){
                var id_san_pham = $(this).data('id');
                $.ajax({
                    url     :       '/admin/san-pham/edit/' + id_san_pham,
                    typoe   :       'get',
                    success :       function(res) {
                        if(res.status) {
                            $("#id_san_pham_edit").val(res.data.id);
                            $("#ma_san_pham_edit").val(res.data.ma_san_pham);
                            $("#ten_san_pham_edit").val(res.data.ten_san_pham);
                            $("#slug_san_pham_edit").val(res.data.slug_san_pham);
                            $("#is_open_edit").val(res.data.is_open);
                            $("#id_san_pham_cha_edit").val(res.data.id_san_pham_cha);
                            $("#don_gia_ban_edit").val(res.data.don_gia_ban);
                            $("#don_gia_khuyen_mai_edit").val(res.data.don_gia_khuyen_mai);
                            $("#hinh_anh_edit").val(res.data.hinh_anh);
                            $("#danh_muc_id_edit").val(res.data.danh_muc_id);
                            $('#mo_ta_ngan_edit').val(res.data.mo_ta_ngan);
                            $('#mo_ta_chi_tiet_edit').val(res.data.mo_ta_chi_tiet);
                        }
                    }
                });
            });
            $("#updateSanPham").click(function() {
                var sanPham = {
                    'id'                  :   $("#id_san_pham_edit").val(),
                    'ma_san_pham'         :   $("#ma_san_pham_edit").val(),
                    'ten_san_pham'        :   $("#ten_san_pham_edit").val(),
                    'slug_san_pham'       :   $("#slug_san_pham_edit").val(),
                    'danh_muc_id'         :   $("#danh_muc_id_edit").val(),
                    'is_open'             :   $("#is_open_edit").val(),
                    'don_gia_ban'         :   $('#don_gia_ban_edit').val(),
                    'don_gia_khuyen_mai'  :   $('#don_gia_khuyen_mai_edit').val(),
                    'hinh_anh'            :   $('#hinh_anh_edit').val(),
                    'mo_ta_ngan'          :   $('#mo_ta_ngan_edit').val(),
                    'mo_ta_chi_tiet'      :   $('#mo_ta_chi_tiet_edit').val(),
                };

                $.ajax({
                    url     :   '/admin/san-pham/update',
                    type    :   'post',
                    data    :   sanPham,
                    success :   function(res) {
                        toastr.success("Đã cập nhật sản phẩm thành công!");
                        loadTable()
                    },
                    error   :   function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });
            loadTable();
        });
    </script>
@endsection
