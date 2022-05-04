/*
 * Welcome to your app's base JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import 'toastr/build/toastr.min.css';

import toastr from "toastr";
window.toastr = toastr;
// const routes = require('../../../public/js/fos_js_routes.json');
// import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
// Routing.setRoutingData(routes);
// window.Routing = Routing;

$(document).ready(function () {
    toastr.options = {
        "closeButton": true
    };
    // // setting default value of jqBlockUI
    // $.blockUI.defaults.css.width = '100px;';
    // $.blockUI.defaults.message = '<div class="page-loading-panel" style="width: 100px;"><span>Please wait...</span></div>';

    let infoMessages = [];
    let successMessages = [];
    let errorMessages = [];

    if ($('#infoMessages').attr('data-id')) {
        infoMessages = JSON.parse($('#infoMessages').attr('data-id'));
        $.each(infoMessages, function (i, flashMessage) {
            toastr.info(flashMessage, 'Information');
        });
    }
    if ($('#successMessages').attr('data-id')) {
        successMessages = JSON.parse($('#successMessages').attr('data-id'));
        $.each(successMessages, function (i, flashMessage) {
            toastr.success("hello", 'Success');
        });
    }
    if ($('#errorMessages').attr('data-id')) {
        errorMessages = JSON.parse($('#errorMessages').attr('data-id'));
        $.each(errorMessages, function (i, flashMessage) {
            toastr.error(flashMessage, 'Error');
        });
    }
});