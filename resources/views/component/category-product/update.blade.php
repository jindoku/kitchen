@extends('app')
@section('head.title')
    Chỉnh sửa nhóm hàng
@endsection

@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-12 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Chỉnh sửa nhóm hàng</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-block">
                <form class="forms-sample" method="POST" action="{{route('customer.update', $categoryProduct->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="col-form-label">Mã nhóm hàng<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="{{$categoryProduct->code}}" autocomplete="off" maxlength="255">
                            @if ($errors->has('code'))
                                <p class="text-danger">{{$errors->first('code')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-7">
                            <label class="col-form-label">Tên nhóm hàng<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" maxlength="20" value="{{$categoryProduct->name}}">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Mô tả</label>
                            <textarea type="text" class="form-control" name="description" maxlength="255">{{$categoryProduct->description}}</textarea>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{$errors->first('description')}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mr-2 add btn-sm a-font-size-13" title="Lưu mới">
                            <i class="fa fa-save"></i> Chỉnh sửa
                        </button>
                        <a href="{{route('category-product.index')}}" class="btn btn-secondary btn-sm a-font-size-13"
                           title="Quay lại">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

