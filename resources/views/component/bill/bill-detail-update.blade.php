@php
    $totalAll = 0;
    $totalRow = $bill->billDetail->count();
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
                    <input id="total_row" type="hidden" name="total_row" value="{{$totalRow}}">
                    @if ($errors->has('total_row'))
                        <p class="text-danger">{{$errors->first('total_row')}}</p>
                    @endif
                    @foreach($bill->billDetail as $key => $detail)
                        @php
                            $index = $key + 1;
                            $productLists = \App\Product::getProductByCategory($detail->category_product_id);
                            $total = 0;
                            $selected = false;
                            $price = 0;
                        @endphp
                        <tr>
                            <td class="text-center">{{$index}}</td>
                            <td>
                                <select class="form-control form-control-sm select2-input"
                                        name="category_id_{{$index}}">
                                    <option>--- Nhóm hàng ---</option>
                                    @foreach($categoryProducts as $categoryProduct)
                                        <option value="{{$categoryProduct->id}}"
                                                @if($categoryProduct->id == $detail->category_product_id) selected @endif>{{$categoryProduct->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id_'.$index))
                                    <p class="text-danger">{{$errors->first('category_id_'.$index)}}</p>
                                @endif
                            </td>
                            <td>
                                <select class="form-control form-control-sm select2-input"
                                        name="product_id_{{$index}}">
                                    <option>--- Sản phẩm ---</option>
                                    @foreach($productLists as $productList)
                                        @php
                                            if($productList->id == $detail->product_id){
                                                $selected = true;
                                                $total = $detail->amount * $productList->price;
                                                $price = $productList->price;
                                                $totalAll += $total;
                                            }
                                        @endphp
                                        <option value="{{$productList->id}}" data-price="{{$productList->price}}"
                                                @if($selected) selected @endif>{{$productList->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id_'.$index))
                                    <p class="text-danger">{{$errors->first('product_id_'.$index)}}</p>
                                @endif
                            </td>
                            <td>
                                <input type="number" min="1" class="form-control input-count-product-bill-detail" name="count_product_{{$index}}" value="{{$detail->amount}}">
                                @if ($errors->has('count_product_'.$index))
                                    <p class="text-danger">{{$errors->first('count_product_'.$index)}}</p>
                                @endif
                            </td>
                            <td class="text-center">{{$price > 0 ? $price : ''}}</td>
                            <td class="text-center">{{$total > 0 ? $total : ''}}</td>
                            <td class="text-center">
                                <i class="fa fa-trash fa-2x del-record-bill-detail" title="Xóa"></i>
                            </td>
                        </tr>
                    @endforeach
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
