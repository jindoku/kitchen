@php
    $totalAll = 0;
@endphp
<div class="form-group col-md-12">
    <div class="card">
        <div class="card-header card-product-detail">
            <h5>Thông tin sản phẩm</h5>
            <button type="button" class="btn btn-inverse btn-sm a-font-size-13 add-record-product">
                <i class="fa fa-plus"></i> Thêm sản phẩm
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-custom">
                    <thead class="t-head-inverse">
                    <tr>
                        <th>STT</th>
                        <th>Nhóm hàng</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá thành</th>
                        <th>Thành tiền</th>
                        <th>Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody id="bill-detail-product">
                    <input id="total_row" type="hidden" name="total_row" value="{{old('total_row')}}">
                    @if ($errors->has('total_row'))
                        <p class="text-danger">{{$errors->first('total_row')}}</p>
                    @endif
                    @if(old('total_row'))
                        @for($i = 1; $i <= old('total_row'); $i++)
                            @php
                                $productLists = \App\Product::getProductByCategory(old('category_id_'.$i));
                                $total = 0;
                                $selected = false;
                                $price = 0;
                            @endphp
                            <tr>
                                <td class="text-center">{{$i}}</td>
                                <td>
                                    <select class="form-control form-control-sm select2-input"
                                            name="category_id_{{$i}}">
                                        <option>--- Nhóm hàng ---</option>
                                        @foreach($categoryProducts as $categoryProduct)
                                            <option value="{{$categoryProduct->id}}"
                                                    @if($categoryProduct->id == old('category_id_'.$i)) selected @endif>{{$categoryProduct->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id_'.$i))
                                        <p class="text-danger">{{$errors->first('category_id_'.$i)}}</p>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-control form-control-sm select2-input"
                                            name="product_id_{{$i}}">
                                        <option>--- Sản phẩm ---</option>
                                        @foreach($productLists as $productList)
                                            @php
                                                if($productList->id == old('product_id_'.$i)){
                                                    $selected = true;
                                                    $total = old('count_product_'.$i) * $productList->price;
                                                    $price = $productList->price;
                                                    $totalAll += $total;
                                                }
                                            @endphp
                                            <option value="{{$productList->id}}" data-price="{{$productList->price}}"
                                                @if($selected) selected @endif>{{$productList->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_id_'.$i))
                                        <p class="text-danger">{{$errors->first('product_id_'.$i)}}</p>
                                    @endif
                                </td>
                                <td>
                                    <input type="number" min="1" class="form-control input-count-product-bill-detail" name="count_product_{{$i}}" value="{{old('count_product_'.$i)}}" @if(!old('count_product_'.$i)) disabled @endif>
                                    @if ($errors->has('count_product_'.$i))
                                        <p class="text-danger">{{$errors->first('count_product_'.$i)}}</p>
                                    @endif
                                </td>
                                <td class="text-center">{{$price > 0 ? $price : ''}}</td>
                                <td class="text-center">{{$total > 0 ? $total : ''}}</td>
                                <td class="text-center">
                                    <i class="fa fa-trash fa-2x del-record-bill-detail" title="Xóa"></i>
                                </td>
                            </tr>
                        @endfor
                    @endif
                    </tbody>
                    <tfoot id="tfoot-bill-detail">
                    <td colspan="5" class="text-right font-weight-bold">Tổng tiền</td>
                    <td colspan="2" class="text-center font-weight-bold">{{$totalAll > 0 ? $totalAll : ''}}</td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
