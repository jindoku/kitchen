@extends('app')
@section('head.title')
    Quản lý nhân viên
@endsection
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-8 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Quản lý nhân viên</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="float-right p-r-10">
                    <a class="btn btn-inverse btn-sm color-white" title="Thêm mới" href="{{route('staff.create')}}">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-header p-b-15 p-t-10 header-form-search">
                @include('component.staff._search')
            </div>
            <div class="card-body p-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-custom">
                        <thead class="t-head-inverse">
                            <tr>
                                <th>STT</th>
                                <th>Mã nhân viên</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Giới tính</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = $staffs->perpage() * ($staffs->currentPage() - 1);
                            @endphp
                            @foreach($staffs as $key => $staff)
                                <tr>
                                    <td class="text-center">{{$key + 1 + $index}}</td>
                                    <td>{{$staff->code}}</td>
                                    <td>{{$staff->fullname}}</td>
                                    <td>{{$staff->email}}</td>
                                    <td>{{$staff->phone}}</td>
                                    <td class="text-center">
                                        @if($staff->sex == 1)
                                            <label class="label label-md label-primary">Nam</label>
                                        @elseif($staff->sex == 2)
                                            <label class="label label-md label-danger">Nữ</label>
                                        @else
                                            <label class="label label-md label-default">Khác</label>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="p-l-5" href="{{route('staff.edit', $staff->id)}}" title="Chỉnh sửa">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </a>

                                        <a class="del-record color-red p-l-5" data-id="{{$staff->id}}" href="javascript:void(0)">
                                            <i class="fa fa-trash fa-lg" title="Xóa"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                           @include('component.pagination', ['column' => 7, 'datas' => $staffs])
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
    <script type="module" src="{{asset('js/modules/staff.js')}}"></script>
@endsection
