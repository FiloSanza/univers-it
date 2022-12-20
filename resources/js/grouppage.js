import axios from 'axios';
import $ from 'jquery';

const handle_click = function() {
    const id = $(this).data('follow-id');
    const operation = $(this).text().trim().toLowerCase();
    const data = { 'group_id': id };

    axios
        .post(`/group/${operation}`, data)
        .then(() => window.location.reload());
}

$(() => {
    if ($('#groupname').length > 0) {
        $('[data-follow-main]').on('click', handle_click);
    }
});