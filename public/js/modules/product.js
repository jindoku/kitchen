import Resource from './resource/app.js';

const resource = new Resource();
var Config = (function () {
    var renderThumbImage = function (f_object) {
        var html = '<div class="jFiler-items jFiler-row">\n' +
            '<ul class="jFiler-items-list jFiler-items-grid">\n' +
            '<li class="jFiler-item" data-jfiler-index="2" style="">\n' +
            '<div class="jFiler-item-container">\n' +
            '<div class="jFiler-item-inner">\n' +
            '<div class="jFiler-item-thumb">\n' +
            '<div class="jFiler-item-thumb-image">' +
            '<img src="'+ f_object.f64 +'" draggable="false">' +
            '</div>\n' +
            '</div>\n' +
            '<div class="jFiler-item-assets jFiler-row">\n' +
            '<ul class="list-inline pull-right">\n' +
            '<li>' +
            '<a class="icon-jfi-trash jFiler-item-trash-action del-image-thumb"></a>' +
            '</li>\n' +
            '</ul>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>\n' +
            '</li>\n' +
            '</ul>\n' +
            '</div>';

        return html;
    };

    var getData64 = async function (files) {
        return new Promise((resolve) => {
            var reader = new FileReader();
            reader.readAsDataURL(files);
            reader.onload = () => {
                resolve(reader.result);
            };
        });
    };

    var handleConfirmation = function () {
        resource.destroy('product');
        $('.file-upload-browse').on('click', function () {
            var file = $(this).parent().parent().parent().find('.file-upload-default');
            file.trigger('click');
        });

        $('.file-upload-default').on('change', async function () {
            var f_obj = $(this).prop('files')[0];
            var base64 = await getData64(f_obj);
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            var f_info_obj = {
                f64: base64
            };
            var appendHtml = renderThumbImage(f_info_obj);
            $('#preview-image').empty().append(appendHtml)
        });

        $('#preview-image').on('click', '.del-image-thumb', function () {
            $('#preview-image').empty();
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
