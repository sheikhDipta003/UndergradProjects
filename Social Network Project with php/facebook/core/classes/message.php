<?php

class Message
{
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //fetch the user details for all users (except current user, :userid) whose 'userLink' field matches with the given search expression
    public function searchMsgUser($msgUser, $userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.userId WHERE users.user_id != ? AND users.userLink LIKE ? ");
        $stmt->bindValue(1, $userid, PDO::PARAM_INT);
        $stmt->bindValue(2,  $msgUser . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //retrieves the most recent message exchange for each user that the current user has communicated with, along with their profile and user details
    public function lastPersonWithAllUserMSG($userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM messages 
        LEFT JOIN profile ON 
        (SELECT IF(messages.messageFrom = :userid, messages.messageTo, messages.messageFrom)) = profile.userId 
        LEFT JOIN users ON 
        profile.userId = users.user_id 
        WHERE (messages.messageTo = :userid OR messages.messageFrom = :userid) AND 
        messages.messageID IN 
        (SELECT MAX(messages.messageID) FROM messages GROUP BY messages.messageTo, messages.messageFrom ORDER BY messages.messageID DESC) 
        GROUP BY profile.id ORDER BY messages.messageOn DESC;");
        // Main Table (messages):
        // LEFT JOIN profile ON (SELECT IF(messages.messageFrom = :userid, messages.messageTo, messages.messageFrom)) = profile.userId: This joins the profile table to get the profile of the user involved in the message exchange with the current user (:userid). The IF statement dynamically selects either messageTo or messageFrom, depending on whether the message was sent by or to the current user.

        // Join with users:
        // LEFT JOIN users ON profile.userId = users.user_id: Joins the users table to retrieve user details based on the userId from the profile table.

        // Filter Messages Involving the User:
        // WHERE (messages.messageTo = :userid OR messages.messageFrom = :userid): Filters to select only the messages that involve the current user, either as the sender (messageFrom) or receiver (messageTo).

        // Subquery for Latest Message:
        // AND messages.messageID IN (SELECT MAX(messages.messageID) FROM messages GROUP BY messages.messageTo, messages.messageFrom ORDER BY messages.messageID DESC): Ensures that only the latest message between any two users (based on messageID) is selected. This subquery groups the messages by messageTo and messageFrom and retrieves the maximum (latest) message ID.

        // Grouping by Profile:
        // GROUP BY profile.id: Groups the results by profile.id, ensuring that only one message exchange per profile is shown.

        // Ordering by Message Date:
        // ORDER BY messages.messageOn DESC: Orders the results by the messageOn timestamp in descending order, showing the most recent messages first.

        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //retrieves the profile of the other user involved in the most recent message exchange with the current user (:userid), along with the message details
    public function lastPersonMsg($userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM profile 
        LEFT JOIN messages ON 
        profile.userId = (SELECT IF(messages.messageTo =:userid, messages.messageFrom, messages.messageTo)) 
        WHERE (messages.messageFrom = :userid OR messages.messageTo = :userid) 
        ORDER BY messages.messageOn DESC LIMIT 0, 1");
        // Main Table (profile):
        // LEFT JOIN messages ON profile.userId = (SELECT IF(messages.messageTo = :userid, messages.messageFrom, messages.messageTo)): Joins the profile table to the messages table by matching profile.userId to the other user in the conversation. The IF condition dynamically selects either messageFrom or messageTo depending on whether the current user (:userid) is the recipient or sender of the message.

        // Filter Messages Involving the User:
        // WHERE (messages.messageFrom = :userid OR messages.messageTo = :userid): Ensures that only messages where the current user is either the sender (messageFrom) or recipient (messageTo) are considered.

        // Ordering by Message Date:
        // ORDER BY messages.messageOn DESC: Orders the results by the messageOn timestamp in descending order, showing the most recent message first.

        // Limit the Result:
        // LIMIT 0, 1: Restricts the result to the first row, ensuring that only the single most recent message and the corresponding profile are returned.

        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //retrieves the complete message history between two users (:userid and :otherid), including profile details for the sender of each message, ordered by the time the messages were sent.
    public function messageData($userid, $lastpersonid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM messages 
        LEFT JOIN profile ON 
        profile.userId = messages.messageFrom 
        WHERE (messageTo = :userid and messageFrom=:otherid) OR (messageTo = :otherid and messageFrom=:userid) 
        ORDER BY messageOn ASC");
        // Main Table (messages):
        // The query is selecting all columns from the messages table.

        // Join with profile:
        // LEFT JOIN profile ON profile.userId = messages.messageFrom: This joins the profile table to the messages table by matching the profile.userId with the messageFrom field in the messages table. This allows retrieval of profile information for the user who sent each message.

        // Filter for Conversation Between Two Users:
        // WHERE (messageTo = :userid AND messageFrom = :otherid) OR (messageTo = :otherid AND messageFrom = :userid): This filters the messages to include only those exchanged between the current user (:userid) and the other user (:otherid), whether the current user is the sender or the receiver.

        // Ordering by Message Timestamp:
        // ORDER BY messageOn ASC: Orders the messages in ascending order based on the messageOn timestamp, so the messages are displayed in chronological order, from the oldest to the newest.

        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":otherid", $lastpersonid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
