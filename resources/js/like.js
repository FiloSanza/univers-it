import $ from 'jquery';

let post_id;

const update_reactions = function() {
    $.get(`/post/reactions/${post_id}`)
        .then(response => {
            console.log(response);
            $("#like-number").html(response.likes);
            $("#dislike-number").html(response.dislikes);
            if(response.user_reaction) {
                $(`#${response.user_reaction}-button`).focus(); 
            }
        })
        .catch(err => console.log(err));
}

const handle_click = function(button_name) {
    $.post("/post/react", { "post_id": post_id, "reaction_name": button_name })
        .then(response => {
            console.log(response);
            update_reactions();
        })
        .catch(err => console.log(err));
}

$(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    post_id = $('div[data-post]').data('post');

    $('#like-button').on('click', function (evt) {
        handle_click('like');
    });
    
    $('#dislike-button').on('click', function (evt) {
        handle_click('dislike');
    });

    update_reactions();
});