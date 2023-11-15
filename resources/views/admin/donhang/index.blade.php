@extends('share.master')
@section('title')
    Quản lý đơn hàng
@endsection
@section('content')
    <style>
        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }
        .csc-no{
            background-image:url('https://bizweb.dktcdn.net/100/334/874/files/giay-co-trang-phu-1.jpg?v=1660125247224');
            background-size: cover;
            margin-right: 50px;
            padding: 10px 0 30px 10px;
            width: 100%;
            border-radius: 20px;
        }
        .csc-yes{
            margin-right: 50px;
            background-image:url('https://bizweb.dktcdn.net/100/334/874/files/giay-co-trang-phu-1.jpg?v=1660125247224');
            background-size: cover;
            padding: 10px 0 30px 10px;
            width: 100%;
            border-radius: 20px;
        }
        .csc-no p {
            font-size: 25px;
            line-height: 40px;
            font-weight: 500;
            font-family: "Times New Roman", Times, serif;
        }
        .csc-yes p {
            font-size: 25px;
            line-height: 40px;
            font-weight: 500;
            font-family: "Times New Roman", Times, serif;
        }
        .csc-no .header {
            border-bottom: 1px solid;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .csc-yes .header {
            border-bottom: 1px solid;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }


        .csc-no i {
            font-size: 25px;
            font-weight: 700
        }

        .csc-no .btn {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            padding: 13px;
        }
        .csc-yes i {
            font-size: 25px;
            font-weight: 700
        }
        .scroll{
            display:flex;
            flex-direction: column;
            height: 750px;
            overflow-y: scroll;
        }

        .csc-yes .btn {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            padding: 13px;
        }
        .card{
            background-color: rgba(143, 214, 148, 0.391);
            /* background-image: url('https://kenh14cdn.com/thumb_w/660/2020/5/28/0-1590653959375414280410.jpg');
            background-repeat: no-repeat; */
        }
        .card .card-header{
            background-color: rgba(38, 194, 49, 0.644);
        }

    </style>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5> Hóa Đơn Bán Hàng</h5>
            </div>
            <div class="card-body "id="app" style="display: flex;
            ">
                {{-- <table class="table table-bordered" >
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Mã Đơn Hàng</th>
                            <th scope="col">Tổng tiền </th>
                            <th scope="col">Tiền giảm giá </th>
                            <th scope="col">Thực trả</th>
                            <th scope="col">Agent ID</th>
                            <th scope="col">Loại thanh toán</th>
                            <th scope="col">Tên người nhận</th>
                            <th scope="col">Số điện thoại người nhận</th>
                            <th scope="col">Email người nhận </th>
                            <th scope="col">Địa chỉ người nhận</th>
                            <th scope="col">Phí vận chuyển </th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <template v-for="(value, key) in listBill" >
                        <tr>
                            <td>@{{ key + 1 }}</td>
                            <td class="text-left">
                                <div class="seller-box align-flax w-100">
                                    <div class="seller-contain pl-15">
                                        <a  class="product-name text-uppercase">@{{ value.ma_don_hang }}</a>
                                    </div>
                                </div>
                            </td>
                            <td><span class="price">@{{ formatNumber(value.tong_tien) }}</span></td>
                            <td><span class="price">@{{ formatNumber(value.tien_giam_gia) }}</span></td>
                            <td><span class="price">@{{ formatNumber(value.thuc_tra) }}</span></td>
                            <td><span class="price">@{{ value.agent_id }}</span></td>
                            <td><span v-if="value.loai_thanh_toan== 1" class="price">Bank</span>
                                <span v-else class="price">COD</span></td>
                            <td><span class="price">@{{ value.ten_nguoi_nhan }}</span></td>
                            <td><span class="price">@{{ value.sdt_nguoi_nhan }}</span></td>
                            <td><span class="price">@{{ value.email_nguoi_nhan }}</span></td>
                            <td><span class="price">@{{ value.dia_chi_nguoi_nhan }}</span></td>
                            <td><span class="price">@{{ formatNumber(value.phi_van_chuyen) }}</span></td>
                            <td>
                                    <i type="submit" v-if="value.tinh_trang == 1" v-on:click="change(value.id)" style="color: rgb(94, 255, 0)" class="fas fa-check fa-lg" aria-hidden="true"></i>
                                    <i type="submit" v-else v-on:click="change(value.id)" style="color: red" class="fa-solid fa-xmark fa-lg" aria-hidden="true"></i>
                            </td>
                            <td>
                                <ul >
                                    <i v-on:click="deleteRow(value)" style="color: red" class="fas fa-trash-o fa-lg" aria-hidden="true"></i>
                                </ul>
                            </td>
                        </tr>
                    </template>
                    <tbody>

                    </tbody>
                </table> --}}
                   <div class=" scroll container">
                    <template v-for="(value, key) in listBill">
                        <div class="alert csc-no  "  v-if="value.tinh_trang == 0">
                            <p class="text-center header">Tình trạng thanh toán:
                                <i type="submit"
                                    style="border: 1px solid rgb(128, 0, 0);
                                    border-radius: 50%;
                                    background-color: rgba(255, 0, 0, 0.706);
                                    height: 30px;
                                    width: 30px;
                                    padding-top: 2px;
                                    ;"
                                    class=" fa-solid fa-xmark " v-on:click="change(value.id)"></i> Chưa phê duyệt
                            </p>
                            <p>Mã Đơn Hàng : @{{ value.ma_don_hang }} </p>
                            <p>Tổng tiền: @{{ formatNumber(value.tong_tien) }} </p>
                            <p>Tiền giảm giá : @{{ formatNumber(value.tien_giam_gia) }}</p>
                            <p>Thực trả: @{{formatNumber(value.thuc_tra) }}</p>
                            <p>ID khách hàng: @{{ value.agent_id }}</p>
                            <p>Thanh toán :
                                <i v-if="value.loai_thanh_toan == 1" class="fa-solid fa-building-columns"></i>
                                <i v-else class="fa-sharp fa-solid fa-dollar-sign"></i>
                            </p>
                            <p>Người Nhận: @{{ value.ten_nguoi_nhan }}</p>
                            <p>Số điện thoại : @{{ value.sdt_nguoi_nhan }} </p>
                            <p>Email : @{{ value.email_nguoi_nhan }} </p>
                            <p>Địa chỉ: @{{ value.dia_chi_nguoi_nhan }} </p>

                            <p>Phí vận chuyển: @{{formatNumber(value.phi_van_chuyen) }} </p>
                            <hr style="color: blue">
                            <p class="text-center"><button v-on:click="deleteRow(value.id)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </p>

                        </div>
                        <div class="alert  csc-yes" v-else >
                          <p class="text-center header">Tình trạng thanh toán: <i
                                    style="border: 1px solid green;
                        border-radius: 50%;
                        padding: 2px;
                        background-color: yellow;"
                                    type="submit" style="border" v-on:click="change(value.id)"
                                    class="fa-solid fa-check"></i> Đã phê duyệt
                            </p>
                            <p>Mã Đơn Hàng : @{{ value.ma_don_hang }} </p>
                            <p>Tổng tiền: @{{ formatNumber(value.tong_tien) }} </p>
                            <p>Tiền giảm giá : @{{formatNumber( value.tien_giam_gia) }}</p>
                            <p>Thực trả: @{{ formatNumber(value.thuc_tra) }}</p>
                            <p>ID khách hàng: @{{ value.agent_id }}</p>
                            <p>Thanh toán :
                                <i v-if="value.loai_thanh_toan == 1" class="fa-solid fa-building-columns"></i>
                                <i v-else class="fa-sharp fa-solid fa-dollar-sign"></i>
                            </p>
                            <p>Người Nhận: @{{ value.ten_nguoi_nhan }}</p>
                            <p>Số điện thoại : @{{ value.sdt_nguoi_nhan }} </p>
                            <p>Email : @{{ value.email_nguoi_nhan }} </p>
                            <p>Địa chỉ: @{{ value.dia_chi_nguoi_nhan }} </p>
                            <p>Phí vận chuyển: @{{ formatNumber(value.phi_van_chuyen) }} </p>
                            <hr style="color: blue">
                            <p v-on:click="deleteRow(value.id)" class="text-center"><button class="btn btn-danger"><i
                                        class="fa-solid fa-trash"></i></button></p>

                        </div>
                    </template>
                </div>

            </div>

        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                listBill: [],
                tong_tien: 0,
            },
            created() {
                this.loadBill();
            },
            methods: {
                loadBill() {
                    axios
                        .get('/show-don-hang')
                        .then((res) => {
                            this.listBill = res.data.dataBillGate;
                        });
                },
                change(id) {
                    axios
                        .get('/tinhtrangtt/' + id)
                        .then((res) => {
                            if (res.data.status) {

                                this.loadBill();
                            }
                        });
                },
                formatNumber(number) {
                    return new Intl.NumberFormat('vi-VI', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number);
                },

                deleteRow(id) {
                    axios
                        .get('/remove-donhang/' + id)
                        .then((res) => {
                            if(res.data.status){
                                alert('xóa nha <3')
                             this.loadBill();
                            }
                        });
                },

            },
        });
    </script>
@endsection
