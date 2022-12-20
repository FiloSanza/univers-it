import $ from 'jquery';

$('#navbar-hamburger').on('click', function(evt) {
    $('#navbar-responsive-menu').toggle();
    $('#navbar-hamburger-close').toggle();
    $('#navbar-hamburger-open').toggle();
});