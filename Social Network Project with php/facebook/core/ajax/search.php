<?php

include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

function renderSearchResult($searchResults, $user_id, $isMsgUser = false)
{
    echo '<ul style="background-color:white; padding:5px; margin-top:0; box-shadow: 0 0 5px gray;  border-radius:3px" >';

    foreach ($searchResults as $search) {
        if ($isMsgUser || $search->userId != $user_id) {
            $profilePicStyle = $isMsgUser ? 'height:30px; width:20px;' : 'height:20px; width:20px;';
            $fontSize = $isMsgUser ? '13px' : '12px';
            $extraAttributes = $isMsgUser ? 'data-profileid="' . $search->user_id . '"' : '';

            echo '<li class="mention-individuals align-middle" style="background-color:#4267b2; color:white; font-size:' . $fontSize . '; padding:3px; margin-bottom:5px; cursor:pointer;" ' . $extraAttributes . '>';
            echo '<a href="' . BASE_URL . '/profile.php?username=' . $search->userLink . '" class="align-middle" style="color:white;">';
            echo '<img src="' . BASE_URL . $search->profilePic . '" style="' . $profilePicStyle . '" alt="">';
            echo '<div class="mention-name" style="margin-left:3px;">' . $search->first_name . ' ' . $search->last_name . '</div>';
            echo '</a>';
            echo '</li>';
        }
        else{
            echo '<li class="mention-individuals align-middle" style="font-size: 12px; padding:3px; margin-bottom:5px;" >You are already logged in</li>';
        }
    }

    echo '</ul>';
}

if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];
    $searchResult = $loadFromUser->searchText($searchText, $user_id);
    renderSearchResult($searchResult, $user_id);
}

if (isset($_POST['msgUser'])) {
    $msgUser = $_POST['msgUser'];
    $userid = $_POST['userid'];
    $searchResult = $loadFromUser->searchMsgUser($msgUser, $userid);
    renderSearchResult($searchResult, $userid, true);
}

?>