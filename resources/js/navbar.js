import $ from 'jquery';

$('#navbar-hamburger').on('click', function() {
    $('#navbar-responsive-menu').toggle();
    $('#navbar-hamburger-close').toggle();
    $('#navbar-hamburger-open').toggle();
});