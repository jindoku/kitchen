@extends('app')
@section('head.title')
    Lập hóa đơn
@endsection
@section('content')
    <div class="page-header m-t-150 page-header-index">
        <div class="row">
            <div class="col-lg-12 p-t-5">
                <div class="page-header-title p-l-10">
                    <div class="d-inline">
                        <h4>Lập hóa đơn</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card card-index">
            <div class="card-block">
                <form class="forms-sample" method="post" action="{{route('bill.store')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Mã hóa đơn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="{{ generate_bill() }}" autocomplete="off" maxlength="255" readonly>
                            @if ($errors->has('code'))
                                <p class="text-danger">{{$errors->first('code')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label">Khách hàng<span class="text-danger">*</span></label>
                            <select class="form-control select2-input form-control-sm" name="customer_id">
                                <option value="">-- Khách hàng --</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" @if(old('customer_id') == $customer->id) selected @endif>{{$customer->fullname . ' - ' .$customer->phone}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('customer_id'))
                                <p class="text-danger">{{$errors->first('customer_id')}}</p>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="m-t-30">
                                <a class="btn btn-inverse btn-sm color-white" title="Thêm mới" href="{{route('customer.create')}}" target="_blank">
                                    <i class="fa fa-plus"></i> Thêm mới khách hàng
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Ghi chú</label>
                            <textarea type="text" class="form-control" name="note" rows="5"
                                      maxlength="255">{{old('note')}}</textarea>
                            @if ($errors->has('note'))
                                <p class="text-danger">{{$errors->first('note')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row m-t-20">
                        @include('component.bill.bill-detail-create')
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-inverse mr-2 add btn-sm a-font-size-13" title="Lưu mới">
                            <i class="fa fa-save"></i> Lưu mới
                        </button>
                        <a href="{{route('bill.index')}}" class="btn btn-secondary btn-sm a-font-size-13"
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
    <script src="{{asset('template/js/numeral.min.js')}}"></script>
    <script type="module" src="{{asset('js/modules/bill.js')}}"></script>
@endsection
