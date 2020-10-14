@extends('app')
@section('head.title')
    Quản lý hóa đơn
@endsection
@section('head.css')
    <link rel="stylesheet" type="text/css" href="{{asset('template/css/select2.min.css')}}">
@endsection
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-8 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Quản lý hóa đơn</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="float-right p-r-10">
                    <a class="btn btn-inverse btn-sm color-white" title="Thêm mới" href="{{route('bill.create')}}">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-header p-b-15 p-t-10 header-form-search">
                @include('component.bill._search')
            </div>
            <div class="card-body p-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-custom">
                        <thead class="t-head-inverse">
                        <tr>
                            <th>STT</th>
                            <th>Mã hóa đơn</th>
                            <th>Tên khách hàng</th>
                            <th>Nhân viên lập HĐ</th>
                            <th>Ngày lập</th>
                            <th>Ghi chú</th>
                            <th>Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $index = $bills->perpage() * ($bills->currentPage() - 1);
                        @endphp
                        @foreach($bills as $key => $bill)
                            <tr>
                                <td class="text-center">{{$key + 1 + $index}}</td>
                                <td>{{$bill->code}}</td>
                                <td>{{$bill->customer->fullname}}</td>
                                <td>{{$bill->staff->fullname}}</td>
                                <td class="text-center">{{$bill->updated_at}}</td>
                                <td>{{$bill->note}}</td>
                                <td class="text-center">
                                    <a class="p-l-5" href="{{route('bill.edit', $bill->id)}}" title="Chỉnh sửa">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>

                                    <a class="del-record color-red p-l-5" data-id="{{$bill->id}}" href="javascript:void(0)">
                                        <i class="fa fa-trash fa-lg" title="Xóa"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('component.pagination', ['column' => 7, 'datas' => $bills])
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @include('component.flash-message')
    </div>
@endsection
@section('script')
    <script type="module" src="{{asset('js/modules/index.js')}}"></script>
    <script type="module" src="{{asset('js/modules/bill.js')}}"></script>
@endsection
