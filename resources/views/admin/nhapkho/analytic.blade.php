@extends('share.master')
@section('title')
Thống Kê Đơn Hàng Nhập Kho
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ Route('postThongKeNhapKho') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="from_date" class="form-control" value="{{ Carbon\Carbon::parse($begin)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{ Carbon\Carbon::parse($end)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Thống Kê</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th><b>#</b></th>
                                    <th><b>Ngày</b></th>
                                    <th><b>Tổng Tiền</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <th class="text-center">{{ $key + 1 }}</th>
                                        <td class="text-center">{{ $value->date }}</td>
                                        <td class="text-end">{{ number_format($value->total, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var labels    = {!! json_encode($labels) !!};
    var data_js   = {!! json_encode($data_js) !!};

    const data = {
      labels: labels,
      datasets: [{
        label: 'Tổng Tiền',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: data_js,
      }]
    };

    const config = {
      type: 'line',
      data: data,
      options: {}
    };
  </script>
  <script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script>
@endsection
