@extends('app')
@section('head.title')
    Thêm mới nhân viên
@endsection
@php
    $sexChecked = old('sex') ? old('sex') : 1;
@endphp
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-12 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Thêm mới nhân viên</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-block">
                <form class="forms-sample" method="post" action="{{route('staff.store')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Mã nhân viên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="{{ generate_staff() }}" autocomplete="off" maxlength="50" readonly>
                            @if ($errors->has('code'))
                                <p class="text-danger">{{$errors->first('code')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Tên nhân viên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" autocomplete="off" maxlength="255">
                            @if ($errors->has('fullname'))
                                <p class="text-danger">{{$errors->first('fullname')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Số điện thoại<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" maxlength="20">
                            @if ($errors->has('phone'))
                                <p class="text-danger">{{$errors->first('phone')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                   autocomplete="off" maxlength="50">
                            @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Ngày sinh</label>
                            <div class="input-group date datepicker-single">
                                <input maxlength="50" type="text"
                                       class="form-control" name="birtday"
                                       value="{{ old('birtday') ? old('birtday') : date('d-m-Y')}}"
                                       autocomplete="off">
                                <span class="input-group-addon header-span">
                                    <span class="fa fa-calendar header-span"></span>
                                </span>
                            </div>
                            @if ($errors->has('birtday'))
                                <p class="text-danger">{{$errors->first('birtday')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Giới tính</label>
                            <div class="form-radio">
                                <div class="radio radio-inline radio-inverse">
                                    <label>
                                        <input type="radio" name="sex" value="1" @if($sexChecked == 1) checked @endif>
                                        <i class="helper"></i>Nam
                                    </label>
                                </div>
                                <div class="radio radio-inline radio-inverse">
                                    <label>
                                        <input type="radio" name="sex" value="2" @if($sexChecked == 2) checked @endif>
                                        <i class="helper"></i>Nữ
                                    </label>
                                </div>
                                <div class="radio radio-inline radio-inverse">
                                    <label>
                                        <input type="radio" name="sex" value="3" @if($sexChecked == 3) checked @endif>
                                        <i class="helper"></i>Khác
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('sex'))
                                <p class="text-danger">{{$errors->first('sex')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{old('address')}}"
                                   maxlength="255">
                            @if ($errors->has('address'))
                                <p class="text-danger">{{$errors->first('address')}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-inverse mr-2 add btn-sm a-font-size-13" title="Lưu mới">
                            <i class="fa fa-save"></i> Lưu mới
                        </button>
                        <a href="{{route('staff.index')}}" class="btn btn-secondary btn-sm a-font-size-13"
                           title="Quay lại">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="module" src="{{asset('js/modules/index.js')}}"></script>
    <script type="module" src="{{asset('js/modules/staff.js')}}"></script>
@endsection
