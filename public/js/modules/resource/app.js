const http = 'http://localhost:8080/kitchen/public/';
class Resource {
    url_http(){
        return http;
    }

    url_router_api(){
        return http + 'api';
    }

    get_csrf_ajax(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name=csrf-token]').attr('content')
            }
        });
    }

    swal_1500(message, status) {
        swal(message, {
            buttons: false,
            timer: 1500,
            icon: status
        });
    }

    pre_loader(el, hide){
        if(hide === 1){
            $(el).addClass('display-block').removeClass('display-none');
            $('#pcoded').addClass('opacity-0-1');
        }
        else{
            $(el).removeClass('display-block').addClass('display-none');
            $('#pcoded').removeClass('opacity-0-1');
        }
    }

    destroy(uriName) {
        var self = this;
        $('.del-record').on('click', function () {
            var id = $(this).data('id');
            if(id && typeof id !== 'undefined'){
                swal("Bạn có chắc chắn muốn xóa bản ghi này?", {
                    buttons: ["Thoát", "Đồng ý"]
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            self.pre_loader('.waitting-preloader', 1);
                            $.ajax({
                                url: http + uriName + '/' + id,
                                type: 'DELETE',
                                success: function (response) {
                                    self.swal_1500(response.message, response.status);
                                    location.reload();
                                },
                                error: function () {
                                    self.pre_loader('.waitting-preloader', 0);
                                    self.swal_1500('Có lỗi xảy ra', 'error');
                                }
                            })
                        }
                    });
            }

        });
    };

    datepicker(el) {
        $(el).datepicker({
            language: 'vi',
            autoclose: true,
            autoOpen: false,
        });
    };

    change_selected_page(el)
    {
        $(el).on('change', function () {
            var paged = $(this).val();
            var url = '';
            console.log(paged);
        })
    }

    select2(el)
    {
        $(el).select2({
            // width: '100%'
            language: {
                noResults: function() {
                    return "Không tìm thấy"
                },
            },
        });
    }

    no_filter_select2(el)
    {
        $(el).select2({
            minimumResultsForSearch: -1,
        });
    }
}

export {Resource as default}
