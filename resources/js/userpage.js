import axios from "axios";
import $ from "jquery";

const handle_error = function(error) {
    console.log(error.data);
};

const handle_click = function(evt) {
    const id = $(this).data('follow-id');
    const operation = $(this).text().trim().toLowerCase();
    const data = { 'followed_id': id };

    axios.post(`/user/${operation}`,data).then(
        () => {
            if ($(evt.target).data('follow-main') !== undefined) {
                window.location.reload();
                return;
            }
            load_data();
        }
    );
}

const load_data = function() {
    const update = function (list_name) {
        const list = $(`#${list_name}-list`);
        const counter = $(`#${list_name}-count`);
        const username = $('#username').text();

        axios.get(`/user/${list_name}/${username}`).then(response => {
            counter.html(response.data.count);
            list.html(response.data.view);

            // Set click handlers AFTER the elements have been loaded.
            $('span[data-follow-id]').on('click', handle_click);

        }).catch((error) => {
            handle_error(error);
        });
    };

    update('followers');
    update('following');
};

$(() => {
    load_data();
});
