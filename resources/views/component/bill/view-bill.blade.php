@extends('app')
@section('head.title')
    Lập hóa đơn
@endsection
@php $totalAll = 0; @endphp
@section('content')
    <div class="page-body">
        <div class="container">
            <div id="invoice-print" class="card">
                <div class="row invoice-contact">
                    <div class="col-md-8">
                        <div class="invoice-box row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td class="text-uppercase">Công ty trách nhiệm hữu hạn</td>
                                    </tr>
                                    <tr>
                                        <td>Địa Chỉ: 24, ngõ 245, Đinh Công</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Phone: 012345678
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <div class="card-block">
                    <div class="row invoive-info">
                        <div class="col-md-4 col-xs-12 invoice-client-info">
                            <h6 >Khách hàng :</h6>
                            <h6 class="m-0">{{$bill->customer->fullname}}</h6>
                            <p class="m-0 m-t-10">{{$bill->customer->address}}</p>
                            <p class="m-0">{{$bill->customer->phone}}</p>
                            <p><a href="..\..\..\cdn-cgi\l\email-protection.htm" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">{{$bill->customer->email}}</a></p>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h6>  thông tin hóa đơn :</h6>
                            <table class="table table-responsive invoice-table invoice-order table-borderless">
                                <tbody>
                                <tr>
                                    <th>Mã hóa đơn :</th>
                                    <td>{{$bill->code}}</td>
                                </tr>
                                <tr>
                                    <th>Ngày :</th>
                                    <td>{{date ('d-m-Y', strtotime($bill->created_at))}}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 col-sm-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table  invoice-detail-table">
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
                    <hr>
                    <div class="text-center">
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
    </div>
@endsection
@section('script')
    <script src="{{asset('js/modules/printThis.js')}}"></script>
    <script type="module" src="{{asset('js/modules/index.js')}}"></script>
    <script type="module" src="{{asset('js/modules/bill.js')}}"></script>
@endsection
