@extends('app')
@section('head.title')
    Quản lý khách hàng
@endsection
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-8 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Quản lý khách hàng</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="float-right p-r-10">
                    <a class="btn btn-inverse btn-sm color-white" title="Thêm mới" href="{{route('customer.create')}}">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-header p-b-15 p-t-10 header-form-search">
                @include('component.customer._search')
            </div>
            <div class="card-body p-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-custom">
                        <thead class="t-head-inverse">
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $index = $customers->perpage() * ($customers->currentPage() - 1);
                        @endphp
                        @foreach($customers as $key => $customer)
                            <tr>
                                <td class="text-center">{{$key + 1 + $index}}</td>
                                <td>{{$customer->fullname}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->birtday ? date('d-m-Y', strtotime($customer->birtday)) : ''}}</td>
                                <td class="text-center">
                                    @if($customer->sex == 1)
                                        <label class="label label-md label-primary">Nam</label>
                                    @elseif($customer->sex == 2)
                                        <label class="label label-md label-danger">Nữ</label>
                                    @else
                                        <label class="label label-md label-default">Khác</label>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="p-l-5" href="{{route('customer.edit', $customer->id)}}" title="Chỉnh sửa">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>

                                    <a class="del-record color-red p-l-5" data-id="{{$customer->id}}" href="javascript:void(0)">
                                        <i class="fa fa-trash fa-lg" title="Xóa"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @include('component.pagination', ['column' => 7, 'datas' => $customers])
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
    <script type="module" src="{{asset('js/modules/customer.js')}}"></script>
@endsection
