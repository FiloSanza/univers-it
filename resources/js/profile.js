import $ from 'jquery';

const handle_cancel_click = function() {
    $('.popup-body').hide();
}

$(() => {
    $('#cancel-button').on('click', handle_cancel_click);

    setTimeout(function() {
        $('.value-updated').fadeOut('slow');
    }, 2000);  
});