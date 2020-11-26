const http = 'http://localhost:8080/kitchen/public/';
class Resource {
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

    formatMoneyPre(prepaid) {
        if(prepaid){
            let price = parseInt(prepaid);

            let numPrice = numeral(price).format('0,0');

            return numPrice;
        }
    }

    setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

}

export {Resource as default}
