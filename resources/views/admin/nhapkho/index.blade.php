@extends('share.master')
@section('title')
Quản lý nhập kho
@endsection
@section('content')
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="input-group mb-3">
                    <input class="form-control auto" type="text" id="searchSanPham">
                    <span class="input-group-text">
                        <i class="icofont icofont-ui-zoom-in"></i>
                    </span>

                </div>
            </div>
            <div class="card-body">

                <table class="table table-bordered" id="danhSachSanPham">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Chi Tiết Hóa Đơn Nhập Hàng</h5>
                <span>Tổng tiền hàng: <span id="tongTien" class="text-danger font-weight-bold"></span></span>
                <span>Tổng số sản phẩm: <span id="tongSanPham" class="text-danger font-weight-bold"></span> sản phẩm</span>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="listNhapKho">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Mã Sản Phẩm</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Đơn Giá</th>
                            <th scope="col">Thành Tiền</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary" type="button" id="taoHoaDonNhap">Nhập Kho Hàng</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            $("#taoHoaDonNhap").click(function() {
                $.ajax({
                    url: '/admin/hoa-don-nhap-kho/create',
                    type: 'GET',
                    success: function (res) {
                        if(res.status) {
                            toastr.success("Đã tạo hóa đơn thành công!");
                            loadNhapKho();
                        } else {
                            toastr.error(res.message);
                            loadNhapKho();
                        }
                    },
                });
            });

            loadSanPham();
            function formatNumber(number)
            {
                return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
            }
            function loadSanPham() {
                $.ajax({
                    url: '/admin/san-pham/data',
                    type: 'GET',
                    success: function (res) {
                        console.log(res.listSanPham);
                        viewSanPham(res.listSanPham);
                    },
                });
            }

            function toVietNam(num) {
                var t = [
                        "không",
                        "một",
                        "hai",
                        "ba",
                        "bốn",
                        "năm",
                        "sáu",
                        "bảy",
                        "tám",
                        "chín",
                    ],
                    r = function (r, n) {
                        var o = "",
                            a = Math.floor(r / 10),
                            e = r % 10;
                        return (
                            a > 1
                                ? ((o = " " + t[a] + " mươi"), 1 == e && (o += " mốt"))
                                : 1 == a
                                ? ((o = " mười"), 1 == e && (o += " một"))
                                : n && e > 0 && (o = " lẻ"),
                            5 == e && a >= 1
                                ? (o += " lăm")
                                : 4 == e && a >= 1
                                ? (o += " tư")
                                : (e > 1 || (1 == e && 0 == a)) && (o += " " + t[e]),
                            o
                        );
                    },
                    n = function (n, o) {
                        var a = "",
                            e = Math.floor(n / 100),
                            n = n % 100;
                        return (
                            o || e > 0
                                ? ((a = " " + t[e] + " trăm"), (a += r(n, !0)))
                                : (a = r(n, !1)),
                            a
                        );
                    },
                    o = function (t, r) {
                        var o = "",
                            a = Math.floor(t / 1e6),
                            t = t % 1e6;
                        a > 0 && ((o = n(a, r) + " triệu"), (r = !0));
                        var e = Math.floor(t / 1e3),
                            t = t % 1e3;
                        return (
                            e > 0 && ((o += n(e, r) + " ngàn"), (r = !0)),
                            t > 0 && (o += n(t, r)),
                            o
                        );
                    };

                if (0 == num) return t[0];
                var str = "",
                    a = "";
                do
                    (ty = num % 1e9),
                        (num = Math.floor(num / 1e9)),
                        (str = num > 0 ? o(ty, !0) + a + str : o(ty, !1) + a + str),
                        (a = " tỷ");
                while (num > 0);
                str = str.trim();

                return str.charAt(0).toUpperCase() + str.slice(1);
            };

            function viewSanPham(list)
            {
                var content_san_pham ='';
                $.each(list, function(key,value){
                   content_san_pham += '<tr>';
                   content_san_pham += '<td>'+ value.ten_san_pham +'</td>';
                   content_san_pham += '<td class="text-center">';
                       content_san_pham += '<button class="btn btn-info add" data-id='+ value.id+'>Add</button>';
                   content_san_pham += '</td>';
                   content_san_pham += '</tr>';
                });
                $("#danhSachSanPham tbody").html(content_san_pham);
            }
            $("#searchSanPham").keyup(function()
            {
                var search = $("#searchSanPham").val();
                $payload = {
                    'search': search,
                };
                $.ajax({
                    url: '/admin/san-pham/search',
                    type: 'post',
                    data: $payload,
                    success: function (res) {
                        viewSanPham(res.listSanPham);
                    }
                });
            });
            $("body").on('click', '.add', function(){
                var id_san_pham = $(this).data('id');
                var payload = {
                    'id_san_pham'   :   id_san_pham,
                };
                $.ajax({
                    url     :   '/admin/nhap-kho/create',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        toastr.success("Đã thêm sản phẩm!");
                        loadNhapKho();
                    },
                    error   :   function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });

            loadNhapKho();

            function loadNhapKho()
            {
                $.ajax({
                    url     :   '/admin/nhap-kho/data',
                    type    :   'get',
                    success :   function(res) {
                        var content = '';
                        var tongTien = 0;
                        var tongSanPham = 0;
                        $.each(res.data, function(key, value) {
                            content+= '<tr class="align-middle">';
                            content+= '<th class="text-center">'+(key+1)+'</th>';
                            content+= '<td>'+value.ma_san_pham+'</td>';
                            content+= '<td>'+value.ten_san_pham+'</td>';
                            content+= '<td>';
                            content+= '<input type="number" min=1 class="form-control qty" value="'+value.so_luong_nhap+'" data-id='+ value.id+'>';
                            content+= '</td>';
                            content+= '<td>';
                            content+= '<input type="number" class="form-control price" value="'+value.don_gia_nhap +'" data-id='+ value.id+'>';
                            content+= '</td>';
                            content+= '<td>'+formatNumber(value.so_luong_nhap * value.don_gia_nhap) +'</td>';
                            content+= '<td class="text-center">';
                            content+= '<button class="btn btn-danger delete" data-id='+ value.id+'>Xóa</button>';
                            content+= '</td>';
                            content+= '</tr>';
                            tongTien    = tongTien + value.so_luong_nhap * value.don_gia_nhap;
                            tongSanPham = tongSanPham + value.so_luong_nhap;
                        });
                        $("#listNhapKho tbody").html(content);
                        $("#tongTien").text(formatNumber(tongTien) + ' (' + toVietNam(tongTien) + ')');
                        $("#tongSanPham").text(tongSanPham);
                    },
                });
            }

            $("body").on('click', '.delete', function(){
                var id = $(this).data('id');
                var payload = {
                    'id'   :   id,
                };
                $.ajax({
                    url     :   '/admin/nhap-kho/delete',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        if(res.status) {
                            toastr.warning(res.message);
                            loadNhapKho();
                        } else {
                            toastr.error(res.message);
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

            $("body").on('change', '.qty', function(){
                var payload = {
                    'id'            :   $(this).data('id'),
                    'so_luong_nhap' :   $(this).val(),
                };

                $.ajax({
                    url     :   '/admin/nhap-kho/update',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        if(res.status == false) {
                            toastr.error(res.message);
                            loadNhapKho();
                        } else {
                            toastr.success("Đã cập nhật số lượng sản phẩm!");
                            loadNhapKho();
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

            $("body").on('change', '.price', function(){
                var payload = {
                    'id'            :   $(this).data('id'),
                    'don_gia_nhap'  :   $(this).val(),
                };

                $.ajax({
                    url     :   '/admin/nhap-kho/updatePrice',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        if(res.status == false) {
                            toastr.error(res.message);
                            loadNhapKho();
                        } else {
                            toastr.success("Đã cập nhật đơn giá sản phẩm!");
                            loadNhapKho();
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

            $("#searchSanPham").autocomplete({
                serviceUrl: '/admin/san-pham/auto-complete',
                paramName: "ten_san_pham",
                onSelect: function(suggestion) {
                    $("#searchSanPham").val(suggestion.value);
                },
                transformResult: function(response) {
                    return {
                        suggestions: $.map($.parseJSON(response), function(item) {
                            return {
                                value: item.ten_san_pham,
                            };
                        })
                    };
                },
            });
        })
    </script>
@endsection
