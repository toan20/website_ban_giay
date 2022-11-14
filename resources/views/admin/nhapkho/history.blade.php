@extends('share.master')
@section('title')
Lịch sử nhập kho
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th style="font-weight: bold">#</th>
                                <th style="font-weight: bold">Mã Hóa Đơn</th>
                                <th style="font-weight: bold">Ngày Nhập</th>
                                <th style="font-weight: bold">Tổng Tiền</th>
                                <th style="font-weight: bold">Tổng Sản Phẩm</th>
                                <th style="font-weight: bold">Thanh Toán</th>
                                <th style="font-weight: bold">Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hoaDonNhapKho as $key => $value)
                                <tr class="align-middle">
                                    <th style="font-weight: bold">{{ $key + 1 }}</th>
                                    <td class="text-center">{{ $value->ma_don_hang }}</td>
                                    <td class="text-center">{{ Carbon\Carbon::parse($value->created_at)->format('d/m/Y h:i:s') }}</td>
                                    <td class="text-end">{{ number_format($value->tong_tien, 0) }} đ</td>
                                    <td class="text-end">{{ number_format($value->tong_san_pham, 0) }} sp</td>
                                    <td class="text-end">
                                        @if($value->tinh_trang == 0)
                                            <span class="text-danger">Chưa thanh toán</span>
                                        @else
                                            <span class="text-primary">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-info detail" data-id="{{$value->id}}" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Xem Chi Tiết</button>
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="myLargeModalLabel">Chi Tiết Đơn Hàng</h4>
                                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered" id="chiTietHoaDon">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th style="font-weight: bold">#</th>
                                                                <th style="font-weight: bold">Mã Sản Phẩm</th>
                                                                <th style="font-weight: bold">Tên Sản Phẩm</th>
                                                                <th style="font-weight: bold">Số Lượng</th>
                                                                <th style="font-weight: bold">Đơn Giá Nhập</th>
                                                                <th style="font-weight: bold">Thành Tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <h5 class="text-start text-danger mt-2" id="tongHoaDon"></h5>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(".detail").click(function(){
                var id_hoa_don_nhap = $(this).data('id');
                $.ajax({
                    url     :   '/admin/hoa-don-nhap-kho/detail/' + id_hoa_don_nhap,
                    type    :   'get',
                    success :   function(res) {
                        if(res.status) {
                            var content = '';
                            var tongTien = 0;
                            $.each(res.data, function(key, value) {
                                tongTien = tongTien + value.so_luong_nhap * value.don_gia_nhap;
                                content += '<tr>';
                                content += '<th style="font-weight: bold">'+ (key + 1) +'</th>';
                                content += '<td class="text-start">'+ value.ma_san_pham +'</td>';
                                content += '<td class="text-start">'+ value.ten_san_pham +'</td>';
                                content += '<td class="text-end">'+ value.so_luong_nhap +'</td>';
                                content += '<td class="text-end">'+ value.don_gia_nhap +'</td>';
                                content += '<td class="text-end">'+ value.so_luong_nhap * value.don_gia_nhap +'</td>';
                                content += '</tr>';
                            });
                            $("#chiTietHoaDon tbody").html(content);
                            $("#tongHoaDon").html("Tổng tiền hóa đơn là: " + tongTien + " đ");
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
