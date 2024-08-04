$(document).ready(function() {
    $(document).on('click', '.like-action', function() {
        var likeActionIcon = $(this).find('.like-action-icon img');
        var likeReactParent = $(this).parents('.like-action-wrap');
        var nf4 = likeReactParent.parents('.nf-4');
        var nf3 = nf4.siblings('.nf-3').find('.react-count-wrap');
        var reactCount = nf4.siblings('.nf-3').find('.nf-3-react-count').text();
        var postId = likeReactParent.data('postid');
        var userId = likeReactParent.data('userid');
        var spanClass = $(this).find('.like-action-text').find('span');
        var reactTypeText = spanClass.text();

        // switch color of 'like' text and button between grey and blue - blue, i.e. liked
        if(spanClass.attr('class') !== undefined && likeActionIcon.attr('src') === 'assets/image/react/like.png'){
            likeActionIcon.attr('src', 'assets/image/likeAction.JPG');
            spanClass.removeClass();
            spanClass.text('Like');
            // mainReactDelete(reactTypeText, postId, userId, nf3);
        }                                                              // grey, i.e. not liked
        else if(spanClass.attr('class') === undefined || likeActionIcon.attr('src') === 'assets/image/likeAction.JPG'){
            spanClass.addClass('like-color');
            likeActionIcon.attr('src', 'assets/image/react/like.png').addClass('reactIconSize');
            spanClass.text('like');
            // mainReactSubmit(reactTypeText, postId, userId, nf3);
        }
    })
})