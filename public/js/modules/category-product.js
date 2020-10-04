import Resource from './resource/app.js';
const resource = new Resource();
var Config = (function () {
    var handleConfirmation = function () {
        resource.destroy('category-product');

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
