<?php

class Notification
{
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //retrieves all notifications for current user, along with the profile and user details of the sender, ordered by the most recent notification
    public function notification($userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notification LEFT JOIN profile ON notification.notificationFrom = profile.userId LEFT JOIN users ON profile.userId = users.user_id WHERE notification.notificationFor = :userid ORDER BY notification.notificationOn DESC; ");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //retrieves notifications with notificationCount = '0' for a specific user (:userid), excluding notifications of types 'request' and 'message', and orders them by the most recent date.
    public function notificationCount($userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notification LEFT JOIN profile ON notification.notificationFrom = profile.userId LEFT JOIN users ON profile.userId = users.user_id WHERE notification.notificationFor = :userid AND notification.notificationCount = '0' AND notification.type != 'request' AND notification.type != 'message' ORDER BY notification.notificationOn DESC; ");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //retrieves unprocessed(notificationCount = '0') friend request notifications where the current user (:userid) is either the sender or receiver, with additional filtering for accepted requests sent by the user, the results are ordered by the most recent notification date.
    public function requestNotificationCount($userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notification 
        LEFT JOIN profile ON 
        (SELECT IF(notification.notificationFrom = :userid, notification.notificationFor, notification.notificationFrom)) = profile.userId 
        LEFT JOIN users ON 
        profile.userId = users.user_id 
        WHERE (notification.notificationFrom =:userid AND 
        notification.type = 'request' AND notification.notificationCount = '0' AND notification.friendStatus ='1') 
        OR ( notification.type = 'request' AND notification.notificationCount = '0' AND notification.notificationFor = :userid)  ORDER BY notification.notificationOn DESC;");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //get only 'message' notifications sent to this user (:userid)
    public function messageNotificationCount($userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notification WHERE notification.type = 'message' AND notificationCount = '0' AND notificationFor = :userid ");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //set notificationCount for notifications of given type (optional) sent to this user (:userid)
    public function notificationCountReset($userid, $notifType = null)
    {
        $query = "UPDATE notification SET notificationCount = '1' WHERE notificationFor = :userid AND notificationCount = '0'";
        
        if ($notifType !== null) {
            $query .= " AND type = :type";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        
        if ($notifType !== null) {
            $stmt->bindValue(':type', $notifType, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //mark this notification sent to this user as 'read', that is, 'status' is set to '1'
    public function notificationStatusUpdate($userid, $notificationId)
    {
        $stmt = $this->pdo->prepare("UPDATE notification SET status = '1' WHERE notificationFor = :userid AND ID = :notificationid AND status = '0' ");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':notificationid', $notificationId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //set 'friendStatus' as '1' and 'notificationCount' as '0' for all notifs sent to this user from the profile owner
    public function confirmRequestUpdate($profileid, $userid)
    {
        $stmt = $this->pdo->prepare("UPDATE notification SET friendStatus = '1', notificationCount = '0' WHERE notificationFrom = :profileid AND notificationFor = :userid   ");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':profileid', $profileid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
