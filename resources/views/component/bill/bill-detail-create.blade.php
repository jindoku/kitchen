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
                        {{--<tr>--}}
                            {{--<td class="text-center">1</td>--}}
                            {{--<td>--}}
                                {{--<select class="form-control select2-input form-control-sm bill-detail-category" name="category_product_id">--}}
                                    {{--<option value="">-- Nhóm hàng --</option>--}}
                                    {{--@foreach($categoryProducts as $categoryProduct)--}}
                                        {{--<option value="{{$categoryProduct->id}}">{{$categoryProduct->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<select class="form-control select2-input form-control-sm" name="customer_id">--}}
                                    {{--<option value="">-- Sản phẩm --</option>--}}
                                {{--</select>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<input type="number" class="form-control" min="1">--}}
                            {{--</td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td class="text-center">--}}
                                {{--<i class="fa fa-trash fa-2x del-record-bill-detail"></i>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    </tbody>
                    <tfoot id="tfoot-bill-detail">
                        <td colspan="5" class="text-right font-weight-bold">Tổng tiền</td>
                        <td colspan="2" class="text-center font-weight-bold"></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
