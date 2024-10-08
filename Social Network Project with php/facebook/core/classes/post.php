<?php

class Post extends User
{

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function posts($user_id, $profileId, $num, $home = false)
    {
        $userdata = $this->userData($user_id);

        if ($home) {
            $stmt = $this->pdo->prepare("SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id 
            LEFT JOIN profile pr ON pr.userId = p.userId 
            WHERE p.sharedBy IS NULL AND p.userId =:user_id 
            UNION 
            SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id 
            LEFT JOIN profile pr ON pr.userId = p.userId 
            WHERE p.userId IN 
            (SELECT request.reqtReceiver FROM request WHERE request.reqtSender = :user_id AND request.reqStatus = 1) OR 
            p.userId IN 
            ( SELECT request.reqtSender FROM request WHERE request.reqtReceiver = :user_id AND request.reqStatus = 1 ) OR 
            p.userId IN 
            (SELECT follow.receiver FROM follow WHERE follow.sender = :user_id ) 
            ORDER BY postedOn DESC LIMIT :num");
            // Retrieves Original posts (that are NOT shared by anyone) by a specific user (:user_id) and Posts from users who are friends with or followed by this user. The results are sorted by the most recent posts and limited to a specified number (:num).
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.userId LEFT JOIN post ON post.userId = users.user_id WHERE post.userId = :user_id ORDER BY post.postedOn DESC LIMIT :num");
            // Retrieve all user details from the users table.
            // Join additional profile information from the profile table (if available) and post information from the post table.
            // Filter the results to include only posts made by a specific user (:user_id).
            // Order these posts by their posting date in descending order.
            // Limit the number of posts returned to a specified number (:num)
        }

        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($posts as $post) {
            $blockedUser = $this->block($post->postBy, $user_id);
            if (!empty($blockedUser)) {
            } else {
                $main_react = $this->main_react($user_id, $post->post_id);
                $react_max_show = $this->react_max_show($post->post_id);
                $main_react_count = $this->main_react_count($post->post_id);
                $commentDetails = $this->commentFetch($post->post_id);
                $totalCommentCount = $this->totalCommentCount($post->post_id);
                $totalShareCount = $this->totalShareCount($post->post_id);
                if (empty($post->shareId)) {
                } else {
                    $shareDetails = $this->shareFetch($post->shareId, $post->postBy);
                }

                $obj = $this;
                require 'C:\\xampp\\htdocs\\facebook\\core\\classes\\postHelp.php';
            }
        }
    }

    //get the details of this post, including the user and profile info of the person who made that post
    public function postDetails($postid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.userId LEFT JOIN post ON post.userId = users.user_id WHERE post.post_id = :postid  ");
        $stmt->bindValue(':postid', $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function postUpd($user_id, $post_id, $editText)
    {
        $stmt = $this->pdo->prepare('UPDATE post SET post = :editText WHERE post_id =:post_id AND userId = :user_id');
        $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":editText", $editText, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete($user_id, $post_id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM post WHERE post_id = :post_id AND userId = :user_id');
        $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function main_react($userid, $postid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :userid AND `reactOn` = :postid AND `reactCommentOn`= '0' AND `reactReplyOn` = '0' ");
        // reactCommentOn = 0 -> this react is not sent on any comment, reactReplyOn = 0 -> this react is not sent on any reply
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function react_max_show($postid)
    {
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as _count from react WHERE reactOn = :postid AND reactCommentOn = '0' AND reactReplyOn = '0' GROUP BY reactType LIMIT 3");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function main_react_count($postid)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) as _count from react WHERE reactOn = :postid AND reactCommentOn = '0' AND reactReplyOn = '0'");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //this query fetches the first 10 comments on a post (excluding replies), including both the comments and the profiles of the commenters.
    public function commentFetch($postid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentOn = :postid AND comments.commentReplyID = '0' LIMIT 10");
        //commentReplyID = '0' => only top-level comments (i.e., comments that are not replies to other comments) should be selected
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function totalCommentCount($postid)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) as totalComment FROM comments WHERE comments.commentOn =:postid");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //fetch the top 3 react type and their typewise count for a particular comment (excluding react-info for any reply) on a particular post
    public function com_react_max_show($postid, $commentid)
    {
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as _count FROM react WHERE reactOn = :postid AND reactCommentOn = :commentID AND reactReplyOn = '0' GROUP BY reactType LIMIT 3");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the total react count for a particular comment (excluding react-info for any reply) on a particular post
    public function com_main_react_count($postid, $commentid)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) as _count FROM react WHERE reactOn = :postid AND reactCommentOn = :commentID AND reactReplyOn = '0' ");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //fetch the react info from the 'react' table for a particular comment (excluding react-info for any reply) of a post of a user
    public function commentReactCheck($userid, $postid, $commentid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM react WHERE reactBy = :userid AND reactOn = :postid AND reactCommentOn = :commentid and reactReplyOn = '0' ");
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //once user makes a new comment, fetch that comment (using its id) and profile-info of the user so that the new comment can be shown in the comment-list in the user's timeline
    public function lastCommentFetch($commentid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentID = :commentid");
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //update only the text of this comment for this post made by this user
    public function commentUpd($userid, $postid, $editedTextVal, $commentid)
    {
        $stmt = $this->pdo->prepare("UPDATE comments SET comment = :editedText WHERE commentID =:commentid AND commentBy = :userid AND commentOn = :postid");
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":editedText", $editedTextVal, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the first 5 replies (including the profile info) for this comment on this post
    public function replyFetch($postid, $commentid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentOn = :postid and comments.commentReplyID = :commentid LIMIT 5");

        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the top 3 react type and their typewise count for this reply of this comment on this post
    public function reply_react_max_show($postid, $commentid, $replyid)
    {
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as _count FROM react WHERE reactOn = :postid AND reactCommentOn = :commentid AND reactReplyOn = :replyid GROUP BY reactType LIMIT 3");
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the total react count for this reply of this comment on this post
    public function reply_main_react_count($postid, $commentid, $replyid)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) as _count FROM react WHERE reactOn = :postid AND reactCommentOn = :commentid AND reactReplyOn = :replyid");

        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //fetch the react info from the 'react' table for this reply of this comment on this post made by this user
    public function replyReactCheck($user_id, $postid, $commentid, $replyid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM react WHERE reactBy = :userid AND reactOn=:postid AND reactCommentOn = :commentid AND reactReplyOn= :replyid");

        $stmt->bindParam(":userid", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //once user makes a new reply for a comment, fetch that reply (using its id) and profile-info of the user so that the new reply can be shown in the comment-list in the user's timeline
    public function lastReplyFetch($replyid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentID = :replyid");

        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //edit only the text of this reply of this comment on this post made by this user
    public function replyUpd($userid, $postid, $editedTextVal, $replyid)
    {
        $stmt = $this->pdo->prepare("UPDATE comments SET comment = :editText WHERE commentBy = :user_id AND commentOn = :post_id AND commentID = :replyid ");

        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->bindParam(":editText", $editedTextVal, PDO::PARAM_STR);
        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the total number of times this post has been shared
    public function totalShareCount($postid)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) as totalShare FROM post WHERE post.shareId = :post_id");

        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //fetch the user, profile and post info (including sharedFrom, sharedText, shareCount) for this post made by this profile owner
    public function shareFetch($postid, $profileId)
    {
        $stmt = $this->pdo->prepare("SELECT users.*, post.*, profile.* FROM users, post, profile WHERE users.user_id = :user_id AND post.post_id = :post_id AND profile.userId = :user_id");

        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //update/edit the shareText of this post by this user
    public function sharedPostUpd($userid, $postid, $editText)
    {
        $stmt = $this->pdo->prepare("UPDATE post SET shareText = :editText WHERE post_id =:post_id AND userId = :user_id");

        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":editText", $editText, PDO::PARAM_STR);
        $stmt->execute();
    }
}
