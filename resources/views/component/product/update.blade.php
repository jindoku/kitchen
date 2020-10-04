@extends('app')
@section('head.title')
    Chỉnh sửa thiết bị
@endsection
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-12 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Chỉnh sửa thiết bị</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-block">
                <form class="forms-sample" method="post" action="{{route('product.update', $product->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Mã thiết bị<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="{{ old('code') ? old('code') : $product->code}}" autocomplete="off" maxlength="50">
                            @if ($errors->has('code'))
                                <p class="text-danger">{{$errors->first('code')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Tên thiết bị<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" maxlength="255" value="{{old('name') ? old('name') : $product->name}}">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Nhóm hàng<span class="text-danger">*</span></label>
                            <select class="form-control select2-input form-control-sm" name="category_id">
                                <option value="">-- Nhóm hàng --</option>
                                @php
                                    $category_id = old('category_id') ? old('category_id') : $product->category_id;
                                @endphp
                                @foreach($categoryProduct as $category)
                                    <option value="{{$category->id}}" @if($category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <p class="text-danger">{{$errors->first('category_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Giá thành<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" maxlength="255" value="{{old('price') ? old('price') : $product->price}}">
                            @if ($errors->has('price'))
                                <p class="text-danger">{{$errors->first('price')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label">Nhà cung cấp</label>
                            <input type="text" class="form-control" name="supplier" maxlength="255" value="{{old('supplier') ? old('supplier') : $product->supplier}}">
                            @if ($errors->has('supplier'))
                                <p class="text-danger">{{$errors->first('supplier')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Mô tả</label>
                            <textarea type="text" class="form-control" name="description" maxlength="255" rows="5">{{old('description') ? old('description') : $product->description}}</textarea>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{$errors->first('description')}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-inverse mr-2 add btn-sm a-font-size-13" title="Chỉnh sửa">
                            <i class="fa fa-save"></i> Chỉnh sửa
                        </button>
                        <a href="{{route('product.index')}}" class="btn btn-secondary btn-sm a-font-size-13"
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
@endsection
