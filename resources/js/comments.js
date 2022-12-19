import axios from "axios";
import $ from "jquery";

const ERROR_MESSAGE = `<span>ERROR WHILE GETTING THE COMMENTS</span>`;
const DELAY = 1000;

const handle_error = function(error) {
    console.log(error.data);
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

$(function(){
    update_comments();
    $("#comment-form").on("submit", function(e) { 
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
            }
        });
    });
});
