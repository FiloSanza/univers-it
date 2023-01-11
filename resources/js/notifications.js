import axios from 'axios';
import $ from 'jquery';

const read_all = function() {
    $('[data-notification-target]').each(function() {
        const id = this.getAttribute('data-notification-target');
        axios.get(`/notification/read/${id}`)
        .then(() => update_lists())
        .catch((err) => console.log(err));
    });
}

const read_notification = function(evt) {
    const id = $(evt.target).closest('[data-notification-target]').data('notification-target');
    axios.get(`/notification/read/${id}`)
        .then(() => update_lists())
        .catch((err) => console.log(err));
}

const update_lists = function() {
    const unreadNotifications = $('#unreadNotifications');
    const readNotifications = $('#readNotifications');

    axios.get('/notification-list')
        .then((response) => {
            unreadNotifications.html(response.data.unread);
            readNotifications.html(response.data.read);

            $('[data-notification-target]').on('click', read_notification);
        })
        .catch((err) => console.log(err));
}

const update_notification_icon = function() {
    axios.get('/notification-list')
    .then((response) => {
        if (response.data.unread_count > 0) {
            $('#notification-alert').show();
        } else {
            $('#notification-alert').hide();
        }

        if ($('#unreadNotifications').length > 0) {
            update_lists();
        }

        if ($('[data-notification-target]').length > 0) {
            $('#dlt-all').show();
        } else {
            $('#dlt-all').hide();
        }
        
        setTimeout(update_notification_icon, 1000);
    })
    .catch((err) => console.log(err));

}

$(function() {
    if ($('#unreadNotifications').length > 0) {
        update_lists();
    } 
    update_notification_icon();
    $('#dlt-all').on('click', read_all);
});