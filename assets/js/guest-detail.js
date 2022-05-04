$(document).ready(function() {
    $(".select-type input[name='guestbundle_guestdetail[type]']").on('click', function() {
        $('[id^=div-guest]').hide();
        $('#div-guest-'+this.value).show();
    });

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    $('.cannot-edit').on('click', function () {
        const status = $(this).attr('data-status');
        alert('You can not edit as this '+status+' detail by Admin!');
        return false;
    });
});