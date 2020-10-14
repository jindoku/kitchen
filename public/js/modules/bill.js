import Resource from './resource/app.js';

const resource = new Resource();
var Config = (function () {
    var httpUrlApi = resource.url_router_api();
    var renderHtmlBillDetail = function (categoryProduct = [], row) {
        var html = '<tr>';
        html += '<td class="text-center">' + row + '</td>';
        html += '<td><select class="form-control form-control-sm select-bill-detail-category" name="category_id_' + row + '">';
        html += '<option value="">--- Nhóm hàng ---</option>';
        for (var i = 0; i < categoryProduct.length; i++) {
            html += '<option value="' + categoryProduct[i].id + '">' + categoryProduct[i].name + '</option>'
        }
        html += '</select></td>';
        html += '<td><select class="form-control form-control-sm select-product-bill-detail" name="product_id_' + row + '"><option value="">--- Sản phẩm ---</option></select></td>';
        html += '<td><input type="number" min="1" class="form-control input-count-product-bill-detail" name="count_product_' + row + '" disabled></td>';
        html += '<td class="text-center"></td>';
        html += '<td class="text-center"></td>';
        html += '<td class="text-center"><i class="fa fa-trash fa-2x del-record-bill-detail" title="Xóa"></i></td>';
        html += '</tr>';

        return html;
    };

    var refreshSelect2 = function () {
        resource.select2('.select-bill-detail-category');
        resource.select2('.select-product-bill-detail');
    };

    var totalPriceAll = function () {
        var elTr = $('#bill-detail-product tr');
        var rowTr = elTr.length;
        var total = 0;
        for (var i = 0; i < rowTr; i++){
            var totalPriceNow = $(elTr[i]).children(':nth-child(6)').text();
            if(totalPriceNow)
                total = total+ parseInt(totalPriceNow);
        }
        if(total > 0)
            $('#tfoot-bill-detail').children().children(':nth-child(2)').text(total);
        else
            $('#tfoot-bill-detail').children().children(':nth-child(2)').text('');
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
                    refreshSelect2();
                    resource.pre_loader('.waitting-preloader', 0);
                    $('#total_row').val(rowNumber);
                }
            })
        });

        //Xóa row
        $('#bill-detail-product').on('click', '.del-record-bill-detail', function () {
            var elIndex = $(this).parent().closest("tr");
            var elNextAll = elIndex.nextAll();
            for (var i = 0; i < elNextAll.length; i++) {
                var rowNow = $(elNextAll[i]).index();
                var rowNew = rowNow - 1;
                $(elNextAll[i]).children(':nth-child(1)').html(rowNew);
                $(elNextAll[i]).children(':nth-child(2)').children().attr('name', 'category_id_' + rowNew);
                $(elNextAll[i]).children(':nth-child(3)').children().attr('name', 'product_id_' + rowNew);
                $(elNextAll[i]).children(':nth-child(4)').children().attr('name', 'count_product_' + rowNew);
            }
            refreshSelect2();
            elIndex.remove();
            totalPriceAll();
            var trLength = $('#bill-detail-product tr').length;
            $('#total_row').val(trLength);
        });

        $('#bill-detail-product').on('change', '.select-bill-detail-category', function () {
            var el = $(this);
            var categoryId = el.val();
            resource.pre_loader('.waitting-preloader', 1);
            if (categoryId && typeof categoryId !== 'undefined') {
                $.ajax({
                    type: 'get',
                    url: httpUrlApi + '/get-product-by-category/' + categoryId,
                    success: function (res) {
                        resource.pre_loader('.waitting-preloader', 0);
                        var html = '<option value="" data-price="">--- Sản phẩm ---</option>';
                        for (var i = 0; i < res.length; i++) {
                            html += '<option value="' + res[i].id + '" data-price="' + res[i].price + '">' + res[i].name + '</option>';
                        }
                        el.parent().next().children().empty().append(html);
                        refreshSelect2();
                    }
                })
            }
        });

        $('#bill-detail-product').on('change', '.select-product-bill-detail', function () {
            var price = $(this).find(':selected').data('price');
            var elInputCountProduct = $(this).parent().next().children();
            var elPrice = $(this).parent().next().next();
            var elTotalPrice = $(this).parent().next().next().next();
            if (price){
                var valueCount = elInputCountProduct.val() ? elInputCountProduct.val() : 1;
                var totalPrice = valueCount * price;
                elInputCountProduct.prop( "disabled", false ).val(valueCount);
                elPrice.text(price);
                elTotalPrice.text(totalPrice);
            }
            else
            {
                elInputCountProduct.prop( "disabled", true ).val('');
                elPrice.text('');
                elTotalPrice.text('');
            }

            totalPriceAll();
        });

        $('#bill-detail-product').on('change', '.input-count-product-bill-detail', function () {
            var valueCount = $(this).val();
            var price = $(this).parent().prev().children().find(':selected').data('price');
            var totalPrice = valueCount * price;
            $(this).parent().next().next().text(totalPrice);

            totalPriceAll();
        });

        //in hóa đơn
        $('.print-invoice').on('click', function () {
            $('#invoice-print').printThis({
                importCSS: true,
            });
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
