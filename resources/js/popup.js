import $ from 'jquery';
 
$(document).on('click', function(evt) {
    const parent = $(evt.target).closest("[data-target]");
    const target_popup = parent.data('target');
    if (target_popup) {
        $(`div.popup-body[data-name='${target_popup}']`).toggle();
    }
});
 
$('.popup-body').on('click', function(evt) {
    if ($(evt.target).hasClass('popup-body')) {
        $(this).hide();
    }
});