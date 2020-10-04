{{--search--}}
<div>
    <form id="form-search" method="get" action="{{route('product.index')}}">
        <div class="form-row">
            <div class="col-md-5">
                <input id="search_input" type="text" class="form-control" name="keyword" placeholder="Nhập mã hoặc tên thiết bị" value="{{request('keyword')}}">
            </div>
            <div class="col-md-4">
                <select class="form-control select2-input form-control-sm" name="category_id">
                    <option value="">-- Nhóm hàng --</option>
                    @foreach($categoryProduct as $category)
                        <option value="{{$category->id}}" @if(request('category_id') == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
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
