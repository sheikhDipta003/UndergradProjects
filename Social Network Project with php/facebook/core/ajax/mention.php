<!--............include/status.php.......................-->
1/ ..........14~ line after 'textarea'..............

<ul class="hash-men-holder" style="position:absolute;margin-top: 0;"></ul>

<!--............profle.php.......................-->
2/ ..............521~ line...........
<script>
 var regex = /[#|@](\w+)$/ig;
            $(document).on('keyup', '.emojionearea-editor', function() {
                let status_text = $.trim($(this).text());

                let regex_text = status_text.match(regex);
                console.log(regex_text);
                if (regex_text != null) {

                    //                    $('.status-prof-textarea').children("<ul class='status-user-list'></ul>");

                    $.post('http://localhost/facebook/core/ajax/hashtag_mention.php', {
                        regex_text_placeholder: regex_text
                    }, function(data) {
                        $('ul.hash-men-holder').html(data);
                        
//      4/.....................                  
                        $('li.mention-user').click(function(){
                            var mention_userLink = $(this).find('.mention-name').data('userlink');
                            var mention_profileid = $(this).find('.mention-name').data('profileid');
                            var status_old = $('.emojionearea-editor').text();
                            var status_new=status_old.replace(regex, "");
                            
                            $('.emojionearea-editor').text(''+status_new+'@'+mention_userLink+'');
                            $('ul.hash-men-holder').empty();
                             $.post('http://localhost/facebook/core/ajax/hashtag_mention.php', {
                        mention_userLink: mention_userLink,
                        mention_profileid:mention_profileid
                    }, function(data) {
//                        $('adv_dem').html(data);
//                        location.reload();
                    })
                            
                        })
                        
         4/.....................end               
                        
                        
                    })
                } else {

                    $('ul.hash-men-holder').empty();
                }
            })

</script>

<!--............core/ajax/hashtag_mention.php.......................-->
3/ ............

<?php
include '../load.php';
include '../../connect/login.php';
$userid = login::isLoggedIn();
if(isset($_POST['regex_text_placeholder'])){
    
    $hash_ment = implode($_POST['regex_text_placeholder']);
    if(substr($hash_ment,0,1) === '@'){
        $mention = str_replace('@', '', $hash_ment);
        $mention_user = $loadFromPost->loadMentionUser($mention);
       
        foreach($mention_user as $ment){
         
            ?>
<li class="mention-user align-middle" style="background-color:#4267b2; color:white; font-size:12px; padding:3px; margin-bottom:5px; cursor:pointer;display: flex;justify-content: space-between;" data-profileid="<?php echo $ment->user_id; ?>">
    <img src="<?php echo BASE_URL.$ment->profilePic; ?>" class="search-image" alt="" style="height:30px; width:30px;">
    <div class="mention-name" data-profileid="<?php echo $ment->user_id; ?>"  data-userlink="<?php echo $ment->userLink; ?>" style="margin-left:3px;font-size:13px;width:100%;"><?php echo ''.$ment->first_name.' '.$ment->last_name.''; ?></div>
</li>

<?php
        }
    }
    
    
}





   public function loadMentionUser($mention){
    $stmt = $this->pdo->prepare("SELECT user_id,first_name, last_name,userLink,profilePic FROM users as u LEFT JOIN profile as p ON p.userId = u.user_id WHERE first_name LIKE :mention OR userLink LIKE :mention ");
    $stmt->bindValue(":mention", $mention.'%');
        $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



?>

<!--............profile.php.......................-->
5/....... 874~ line.................

<script>
   var mention_user = statusText.match(regex);
                
                
//                if (stIm == '') {
//                    $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
//                        onlyStatusText: statusText,
                        mention_user:mention_user
//                    }, function(data) {
//                        $('adv_dem').html(data);
//                        location.reload();
                     
//                    })
//                } else {
//                    $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
//                        stIm: stIm,
//                        statusText: statusText,
                        mention_user:mention_user

//                    }, function(data) {
//                        $('#adv_dem').html(data);
//                        location.reload();
//                    })
                }/
</script>


<!--............core/ajax/postSubmit.php.......................-->
6/...............
<?php
//include '../load.php';
//include '../../connect/login.php';
//
//$userid = login::isLoggedIn();
//
//
//if(isset($_POST['onlyStatusText'])){
//    $statusText = $_POST['onlyStatusText'];
      $mention_user = $_POST['mention_user'];
    $ment = str_replace('@', '', $mention_user);
    $ment_userlink = $ment[0];
   
    $mention_user_details = $loadFromPost->mention_user_details($ment_userlink);
    $mention_profileid = $mention_user_details->user_id;
    $postid 
//        = $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postedOn'=>date('Y-m-d H:i:s')));
    
    $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $mention_profileid, 'postid'=> $postid, 'type'=>'mention', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));


6 b/ ......Update 'mention' type in notification database table...........................
    
    
    
}
//if(isset($_POST['stIm'])){
//    $stIm = $_POST['stIm'];
//    $statusText = $_POST['statusText'];
//    
    $mention_user = $_POST['mention_user'];
    $ment = str_replace('@', '', $mention_user);
    $ment_userlink = $ment[0];
    $mention_user_details = $loadFromPost->mention_user_details($ment_userlink);
    $mention_profileid = $mention_user_details->user_id;

    $postid = 
//        $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postImage'=>$stIm, 'postedOn'=>date('Y-m-d H:i:s')));
    
      $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $mention_profileid, 'postid'=> $postid, 'type'=>'mention', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
}
?>

<!--............core/classes/post.php.......................-->
7/..........
<?php
   
     public function mention_user_details($userLink){
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE userLink = :userlink ");
            $stmt->bindParam(":userlink", $userLink, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
    }

?>

<!--............profile.php.......................-->

8/ in line 191 .....................

<?php
}else if($notify->type == 'mention'){  ?>
                                <li class="item-notification-wrap <?php echo ($notify->status == '0') ? 'unread-notification': 'read-notification' ?>" data-postid="<?php echo $notify->postid; ?>" data-notificationid="<?php echo $notify->ID; ?>" data-profileid="<?php echo $notify->userId; ?>" >
                                <?php if($notify->type == 'request'){ ?>
                                <a href="<?php echo $notify->userLink; ?>" target="_blank" class="item-notification">

                                    <?php }else if($notify->type == 'message'){

                                }else{ ?>
                                    <a href="post.php?username=<?php echo $notify->userLink; ?>&postid=<?php echo $notify->postid; ?>&profileid=<?php echo $notify->userId; ?>" target="_blank" class="item-notification">
                                        <?php } ?>
                                        <img src="<?php echo $notify->profilePic; ?>" style="height:40px; width:40px; border-radius:50%;" alt="">
                                        <div class="notification-type-details">
                                            <span style="font-weight:600; font-size:14px; color:#CDDC39;margin-left:5px;">
                                                <?php echo ''.$notify->firstName.' '.$notify->lastName.''; ?></span>
                                                
                                                 <?php echo 'mentioned you in a <span>post</span>'; ?>

                                        </div>
                                    </a>
                            </li>     
                                        
                                        
                          <?php  
                                     ///////////////////////..................end............///////////




