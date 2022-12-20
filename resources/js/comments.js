import axios from "axios";
import $ from "jquery";

const ERROR_MESSAGE = `<span>ERROR WHILE GETTING THE COMMENTS</span>`;
const DELAY = 1000;

const handle_error = function(error) {
    console.log(error);
    $('#comments-count').html();
    $('#comments-list').html(ERROR_MESSAGE);
};

const update_comments = function() {
    const comment_list = $('#comments-list');
    let postid = comment_list.data('post');
    axios.get('/comments/' + postid).then(response => {
        $('#comments-count').html(response.data.count);
        comment_list.html(response.data.view);
    }).catch((error) => {
        handle_error(error);
    });
};

const handle_comment_submit = function(e) { 
    e.preventDefault(); 
    $.ajax({
        type: "POST",
        url: "/create-comment",
        data: $('#comment-form').serialize(),
        timeout: 4000,
        success: function() {
            update_comments();
        },
        error: function(error) {
            handle_error(error);
        },
        complete: function() {
            $( '#comment-form' ).each(function(){
                this.reset();
            });
            if ($('#comment-form #reply_to')) {
                $('#comment-form #reply_to').remove();
            }
            $('div[data-name="comment-modal"] h2').html('NEW COMMENT');
            $('.popup-body').hide();
        }
    });
};

$(() => {
    if ($('#comments-count').length > 0) {
        console.log('pippo');
        update_comments();
        $("#comment-form").on("submit", handle_comment_submit);
    }
});
