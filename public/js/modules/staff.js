import Resource from './resource/app.js';
const resource = new Resource();
var Config = (function () {
    var handleConfirmation = function () {
        resource.destroy('staff');

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
