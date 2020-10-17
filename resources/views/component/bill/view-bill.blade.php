@extends('app')
@section('head.title')
    Hóa đơn
@endsection
@php $totalAll = 0; @endphp
@section('content')
    <div class="page-body">
        <div class="container">
            <div class="card">
                <div id="invoice-print">
                    <div class="row invoice-contact">
                        <div class="col-md-8">
                            <div class="invoice-box row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive invoice-table table-borderless">
                                        <tbody>
                                        <tr>
                                            <td class="text-uppercase">Công ty TNHH TM</td>
                                        </tr>
                                        <tr>
                                            <td>Địa Chỉ: 24, ngõ 245, Định Công</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Số điện thoại: 012345678
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row invoive-info">
                            <div class="table-responsive">
                                <table class="table invoice-table invoice-order table-borderless w-75 m-l-15">
                                    <thead>
                                        <th class="w-50 text-uppercase" style="border-bottom: none">Thông tin khách hàng</th>
                                        <th class="text-uppercase" style="border-bottom: none">Thông tin hóa đơn</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Họ và tên: {{$bill->customer->fullname}}</td>
                                            <td>Mã hóa đơn: {{$bill->code}}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ: {{$bill->customer->address}}</td>
                                            <td>Ngày lập: {{date ('d-m-Y', strtotime($bill->created_at))}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Số điện thoại: {{$bill->customer->phone}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table invoice-detail-table">
                                        <thead>
                                        <tr class="thead-default">
                                            <th>Nhóm hàng</th>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bill->billDetail as $billDetail)
                                            @php
                                                $price = $billDetail->product->price;
                                                $amount = $billDetail->amount;
                                                $total = ($price * $amount);
                                                $totalAll += $total;
                                            @endphp
                                            <tr>
                                                <td>{{$billDetail->categoryProduct->name}}</td>
                                                <td>{{$billDetail->product->name}}</td>
                                                <td>{{$amount}}</td>
                                                <td>{{$price}}</td>
                                                <td>{{$total}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>

                                    <tr class="text-info">
                                        <td>
                                            <h5 class="text-primary">Tổng thanh toán :</h5>
                                        </td>
                                        <td>
                                            <h5 class="text-primary">{{$totalAll}}</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Ghi chú :</h6>
                                <p>{{$bill->note}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="w-100">
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-inverse mr-2 btn-sm a-font-size-13 print-invoice" title="in hóa đơn">
                        <i class="fa fa-print"></i> In hóa đơn
                    </button>
                    <a href="{{route('bill.index')}}" class="btn btn-secondary btn-sm a-font-size-13"
                       title="Quay lại">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/modules/printThis.js')}}"></script>
    <script type="module" src="{{asset('js/modules/index.js')}}"></script>
    <script type="module" src="{{asset('js/modules/bill.js')}}"></script>
@endsection
