import Resource from './resource/app.js';
const resource = new Resource();
var Config = (function () {
    resource.get_csrf_ajax();
    var handleConfirmation = function () {
        resource.datepicker('.datepicker-single');
        resource.change_selected_page('.number_raw');
        resource.select2('.select2-input');
        resource.no_filter_select2('.select2-no-filter-input')

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
