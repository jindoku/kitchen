{{--search--}}
<div>
    <form id="form-search" method="get" action="{{route('bill.index')}}">
        <div class="form-row">
            <div class="col-md-3">
                <input id="search_input" type="text" class="form-control" name="keyword" placeholder="Nhập mã hóa đơn" value="{{request('keyword')}}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="customer" placeholder="Nhập tên khách hàng" value="{{request('customer')}}">
            </div>
            <div class="col-md-2">
                <div class="input-group date datepicker-single">
                    <input maxlength="50" type="text"
                           class="form-control" name="begin_date"
                           value="" autocomplete="off" placeholder="Từ ngày">
                    <span class="input-group-addon header-span">
                        <span class="fa fa-calendar header-span"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group date datepicker-single">
                    <input maxlength="50" type="text"
                           class="form-control" name="end_date"
                           value="" autocomplete="off" placeholder="đến ngày">
                    <span class="input-group-addon header-span">
                        <span class="fa fa-calendar header-span"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-inverse btn-sm" type="submit" title="Tìm kiếm">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>
{{--end search--}}
