import $ from 'jquery';

let post_id;

const bg_hover = 'rgb(199, 206, 217)';
const bg_clicked = 'rgb(157, 193, 250)';
const bg = 'rgb(203, 220, 247)';

let clicked;
let not_clicked;

const update_reactions = function() {
    $.get(`/post/reactions/${post_id}`)
        .then(response => {
            $("#like-number").html(response.likes);
            $("#dislike-number").html(response.dislikes);
            if(response.user_reaction) {
                clicked = response.user_reaction;
                not_clicked = response.user_reaction === 'like' ? 'dislike' : 'like';

                $(`#${clicked}-button`).css('background-color', bg_clicked);
                $(`#${not_clicked}-button`).css('background-color', bg);
            } else {
                clicked = null;
                not_clicked = null;

                $("#like-button").css('background-color', bg);
                $("#dislike-button").css('background-color', bg);
            }
        })
        .catch(err => console.log(err));
}

const handle_click = function(button_name) {
    console.log(`{ "post_id":${post_id}, "reaction_name":${button_name}}`);
    $.post("/post/react", { "post_id": post_id, "reaction_name": button_name })
        .then(() => update_reactions())
        .catch(err => console.log(err));
}

$(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#like-button').css('background-color', bg);
    $('#dislike-button').css('background-color', bg);

    post_id = $('div[data-post]').data('post');

    $('#like-button').on('click', function (evt) {
        handle_click('like');
    });

    $('#dislike-button').on('click', function (evt) {
        handle_click('dislike');
    });

    $('#like-button').on('mouseenter', function (evt) {
        $(this).css('background-color', bg_hover);
    });

    $('#like-button').on('mouseleave', function (evt) {
        $(this).css('background-color', clicked === 'like' ? bg_clicked : bg);
    });

    $('#dislike-button').on('mouseenter', function (evt) {
        $(this).css('background-color', bg_hover);
    });

    $('#dislike-button').on('mouseleave', function (evt) {
        $(this).css('background-color', clicked === 'dislike' ? bg_clicked : bg);
    });

    update_reactions();
});