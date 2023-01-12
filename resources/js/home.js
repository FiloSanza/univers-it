import $ from "jquery";

$(() => {
    if ($('[data-name="notverified-modal"]').length) {
        $('[data-name="notverified-modal"]').show();
    }
    $('#confirm').on('click', () => $('[data-name="notverified-modal"]').hide());
});