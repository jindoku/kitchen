import Resource from './resource/app.js';

const resource = new Resource();
var Config = (function () {
    var httpUrlApi = resource.url_router_api();
    var renderHtmlBillDetail = function (categoryProduct = [], row) {
        var html = '<tr data-row="' + row + '">';
        html += '<td class="text-center">' + row + '</td>';
        html += '<td><select id="cate-pro-bill-detail-' + row + '" class="form-control form-control-sm bill-detail-category">';
        html += '<option>--- Nhóm hàng ---</option>';
        for (var i = 0; i < categoryProduct.length; i++) {
            html += '<option value="' + categoryProduct[i].id + '">' + categoryProduct[i].name + '</option>'
        }
        html += '</select></td>';
        html += '<td><select id="product-bill-detail-' + row + '" class="form-control form-control-sm"><option>--- Sản phẩm ---</option></select></td>';
        html += '<td><input type="number" min="1" class="form-control"></td>';
        html += '<td></td>';
        html += '<td></td>';
        html += '<td class="text-center"><i class="fa fa-trash fa-2x del-record-bill-detail" title="Xóa"></i></td>';
        html += '</tr>';

        return html;
    };

    var handleConfirmation = function () {
        $('.add-record-product').on('click', function () {
            resource.pre_loader('.waitting-preloader', 1);
            var trLength = $('#bill-detail-product tr').length;
            var rowNumber = trLength + 1;
            $.ajax({
                type: 'GET',
                url: httpUrlApi + '/get-category-product',
                success: function (res) {
                    var html = renderHtmlBillDetail(res, rowNumber);
                    $('#bill-detail-product').append(html);
                    resource.select2('#cate-pro-bill-detail-' + rowNumber);
                    resource.select2('#product-bill-detail-' + rowNumber);
                    resource.pre_loader('.waitting-preloader', 0)
                }
            })
        });

        //Xóa row
        $('#bill-detail-product').on('click', '.del-record-bill-detail', function () {
            var elIndex = $(this).parent().closest("tr");
            var elNextAll = elIndex.nextAll();
            var rowIndex = $(this).parent().closest("tr").index() + 1;
            console.log(rowIndex);
        });

        //in hóa đơn
        $('.print-invoice').on('click', function () {
            $('#invoice-print').printThis({
                importCSS: true,
            })
        })
    };

    return {
        init: function () {
            handleConfirmation()
        }
    }
})();

jQuery(document).ready(function () {
    Config.init();
});
