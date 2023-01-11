import $ from 'jquery';
 
$(document).on('click', function(evt) {
    const parent = $(evt.target).closest("[data-target]");
    const target_popup = parent.data('target');
    if (target_popup) {
        $(`div.popup-body[data-name='${target_popup}']`).toggle();
    }
    if (evt.target.classList.contains('reply-p')) {
        $('div[data-name="comment-modal"] h2').html('REPLY');
        $('<input>').attr({
            type: 'hidden',
            id: 'reply_to',
            name: 'reply_to',
            value: evt.target.parentNode.parentNode.getAttribute('id'),
        }).appendTo('#comment-form');
    }
});

$('.popup-body').on('click', function(evt) {
    if ($(evt.target).hasClass('popup-body')) {
        $(this).hide();
    }
});
