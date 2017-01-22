$(document).ready(function() {
    $('body').css('height', $(window).height());

    /* pop up messages*/
    if($('.alert').length > 0) {
        $('.message-error').modal();
        $('.message-info').modal();
    }
});