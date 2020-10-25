@extends('app')
@section('head.title')
    Thêm mới thiết bị
@endsection
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-12 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Thêm mới thiết bị</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-block">
                <form class="forms-sample" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Mã thiết bị<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="{{ generate_product() }}" autocomplete="off" maxlength="50" readonly>
                            @if ($errors->has('code'))
                                <p class="text-danger">{{$errors->first('code')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Tên thiết bị<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" maxlength="255" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Nhóm hàng<span class="text-danger">*</span></label>
                            <select class="form-control select2-input form-control-sm" name="category_id">
                                <option value="">-- Nhóm hàng --</option>
                                @foreach($categoryProduct as $category)
                                    <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>{{$category->name}}</option>
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
                            <input type="text" class="form-control" name="price" maxlength="255" value="{{old('price')}}">
                            @if ($errors->has('price'))
                                <p class="text-danger">{{$errors->first('price')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label">Nhà cung cấp</label>
                            <input type="text" class="form-control" name="supplier" maxlength="255" value="{{old('supplier')}}">
                            @if ($errors->has('supplier'))
                                <p class="text-danger">{{$errors->first('supplier')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="name_input" class="col-form-label">Ảnh sản phẩm</label>
                            <input type="file" name="product_file" class="file-upload-default" hidden>
                            <div class="input-group col-xs-12 mb-0">
                                <input type="text" class="form-control file-upload-info" value="" disabled>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary btn-sm a-font-size-13" type="button">
                                        <i class="fa fa-upload"></i>Tải lên
                                    </button>
                                </span>
                            </div>
                            <div id="preview-image" class="m-t-15"></div>
                            @if ($errors->has('product_file'))
                                <p class="text-danger">{{$errors->first('product_file')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-8">
                            <label class="col-form-label">Mô tả</label>
                            <textarea type="text" class="form-control" name="description" maxlength="255" rows="15">{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{$errors->first('description')}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-inverse mr-2 add btn-sm a-font-size-13" title="Lưu mới">
                            <i class="fa fa-save"></i> Lưu mới
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
    <script type="module" src="{{asset('js/modules/product.js')}}"></script>
@endsection
