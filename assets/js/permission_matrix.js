//import '../../public/js/fos_js_routes.json';
const routes = require('../../public/js/fos_js_routes.json');
import Routing from '../../public/bundles/fosjsrouting/js/router.min.js';
// import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
Routing.setRoutingData(routes);
window.Routing = Routing;

$(document).ready(function(){
    $(".table").hide();
    $('select').on('change', function() {
        $(".table").show();
        var roleVal = this.value;
        if(roleVal === 'SearchRoles'){
            $(".table").hide();
        }
        var data = {roleVal: roleVal};
        var i;

        $.ajax({
            'url': Routing.generate('fetch_permissionmatrix_page'),
            'type': 'POST',
            'data': data,
            'dataType': 'json',
            'success': function (result,status,xhr) {
                if(result.length){
                    $(":checkbox").prop("checked", false);
                    for(i = 0; i < result.length; i++){
                        // var resourceId = result[i]['resource']['id'];
                        // var permissionType = result[i]['permission_type']['name'];
                        var resourceId = result[i]['id'];
                        var permissionType = result[i]['name'];
                        var checkboxId = permissionType+'-'+resourceId;
                        $("#" + checkboxId).prop('checked', true);
                    }
                }else{
                    $(":checkbox").prop("checked", false);
                }
            },
            'error': function (data) {
                console.log(data);
            }
        });
    });

    $('input[type="checkbox"]').click(function(){
        if($(this).prop("checked") == true) {
            var checked = true;
        }else if($(this).prop("checked") == false){
            var checked = false;
        }

        var roleVal = $('#search-role option:selected').attr('id');

        var checkboxVal = $(this).attr('id');
        var data = {checked: checked, roleId : roleVal, checkboxVal : checkboxVal};
        console.log(data);

        $.ajax({
            'url': Routing.generate('permissionmatrix_page'),
            'type': 'POST',
            'data': data,
            'dataType': 'json',
            'success': function (data) {
                // console.log(data);
            },
            'error': function (data) {
                console.log(data);
            }
        });
    });
});
