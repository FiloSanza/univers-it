import $ from 'jquery';

$(document).on('click', function (evt) {
    // Check if the click was on a dropdown element.
    const ancestors = $(evt.target).parents('.dropdown');

    if (ancestors.length === 0) {
        $('.dropdown-content').hide();
    } else {
        const content = ancestors.children('.dropdown-content');
        content.toggle();
    }
});