<?php

class User
{
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function checkInput($variable)
    {
        $variable = htmlspecialchars($variable);
        $variable = trim($variable);
        $variable = stripslashes($variable);
        return $variable;
    }

    public function checkEmail($email_mobile)
    {
        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email_mobile, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function create($table, $fields = array())
    {
        $columns = implode(',', array_keys($fields));
        //first-name,last-name,mobile

        $values = ':' . implode(', :', array_keys($fields));
        // :first-name, :last-name, :mobile

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        if ($stmt = $this->pdo->prepare($sql)) {
            foreach ($fields as $key => $data) {
                $stmt->bindValue(':' . $key, $data);
            }
            // The foreach loop iterates over the $fields array. $stmt->bindValue(':'.$key, $data): This line binds each value from the $fields array to its corresponding placeholder in the prepared SQL statement.

            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }

    public function userIdByUsername($username)
    {
        $stmt = $this->pdo->prepare('SELECT user_id FROM users WHERE userLink = :username');
        $stmt->bindparam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user->user_id;
    }
    public function userData($profileId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.userId WHERE users.user_id = :user_id");
        $stmt->bindParam(':user_id', $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($table, $user_id, $fields = array())
    {
        $columns = '';
        $i = 1;

        foreach ($fields as $name => $value) {
            $columns .= "{$name} = :{$name}";
            //            coverPic = :coverPic, profilePic = :profilePic,
            if ($i < count($fields)) {
                $columns .= ', ';
            }
            $i++;
        }
        $sql = "UPDATE {$table} SET {$columns} WHERE userId = {$user_id}";
        //        UPDATE profile SET coverPic = :coverPic, profilePic = :profilePic WHERE userId = 10;
        if ($stmt = $this->pdo->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        $stmt->execute();
    }
    public function userUpdate($table, $user_id, $fields = array())
    {
        $columns = '';
        $i = 1;

        foreach ($fields as $name => $value) {
            $columns .= "{$name} = :{$name}";
            //            coverPic = :coverPic, profilePic = :profilePic,
            if ($i < count($fields)) {
                $columns .= ', ';
            }
            $i++;
        }
        $sql = "UPDATE {$table} SET {$columns} WHERE user_id = {$user_id}";
        //        UPDATE profile SET coverPic = :coverPic, profilePic = :profilePic WHERE userId = 10;
        if ($stmt = $this->pdo->prepare($sql)) {
            foreach ($fields as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        $stmt->execute();
    }

    public function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $current = time();
        $seconds = $current - $time;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $months = round($seconds / 2600640);

        if ($seconds <= 60) {
            if ($seconds == 0) {
                return 'posted now';
            } else {
                return '' . $seconds . 's';
            }
        } else if ($minutes <= 60) {
            return '' . $minutes . 'm';
        } else if ($hours <= 24) {
            return '' . $hours . 'h';
        } else if ($months <= 24) {
            return '' . date('M j', $time);
        } else {
            return '' . date('j M Y', $time);
        }
    }
    public function timeAgoForCom($datetime)
    {
        $time = strtotime($datetime);
        $current = time();
        $seconds = $current - $time;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $months = round($seconds / 2600640);

        if ($seconds <= 60) {
            if ($seconds == 0) {
                return '0s';
            } else {
                return '' . $seconds . 's';
            }
        } else if ($minutes <= 60) {
            return '' . $minutes . 'm';
        } else if ($hours <= 24) {
            return '' . $hours . 'h';
        } else if ($months <= 24) {
            return '' . date('M j', $time);
        } else {
            return '' . date('j M Y', $time);
        }
    }

    public function delete($table, $array)
    {
        $sql = "DELETE FROM `{$table}`";
        $where = " WHERE ";
        foreach ($array as $name => $value) {
            $sql .= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }
        if ($stmt = $this->pdo->prepare($sql)) {
            foreach ($array as $name => $value) {
                $stmt->bindValue(':' . $name, $value);
            }
            $stmt->execute();
        }
    }

    //searches for users whose user->userLink start with the given search term, and it fetches the related user and profile information from the database.
    public function searchText($search)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.userId WHERE users.userLink LIKE ? ");
        //WHERE users.userLink LIKE ?: This filters the results to only include users whose userLink column value starts with the search term (provided as a parameter). The LIKE operator is used for pattern matching.

        $stmt->bindValue(1, $search . '%', PDO::PARAM_STR);
        //$search.'%': The search term is appended with a % symbol, which is a wildcard character in SQL. This means the query will match any userLink that starts with the provided search term.
        //bindValue(1, $search.'%', PDO::PARAM_STR): This binds the value of the search term to the first placeholder (?) in the query.

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the details of this request (which includes reqStatus and requestOn) made by the logged-in user to this profile owner
    public function requestCheck($userid, $profileId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM request WHERE reqtReceiver = :profileid and reqtSender = :userid ");

        $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //fetch the details of this request (which includes reqStatus and requestOn) made by this profile owner to the logged-in user
    public function requestConf($profileid, $userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM request WHERE reqtReceiver = :userid AND reqtSender =:profileid");

        $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //update reqStatus for the request made by this profile owner to the logged-in user
    public function updateConfirmReq($profileid, $userid)
    {
        $stmt = $this->pdo->prepare("UPDATE request SET reqStatus = 1 WHERE reqtReceiver = :userid AND reqtSender = :profileid");
        $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //fetch the entry from the 'follow' table where the logged-in user followed the profile-owner or the other way
    public function followCheck($profileId, $userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM follow WHERE (sender = :profileid AND receiver =:userid) OR (sender = :userid AND receiver = :profileid)");

        $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //$aboutData -> particular column names in the profile table - 'workspace','highschool','address','relationship'
    //$heading -> the label to be shown describing this $aboutData
    public function aboutOverview($aboutData, $userid, $profileid, $heading)
    {
        $userdata = $this->userdata($profileid);

        echo ($userid != $profileid)
            ? '<span class="about-success">' . $userdata->$aboutData . '</span><br>'
            : (($userdata->$aboutData == '')
                ? '<div class="add-' . $aboutData . ' align-middle" 
                    data-userid="' . $userid . '" 
                    data-profileid="' . $profileid . '" 
                    style="margin: 0 0 20px 0;">
                    <div class="plus-square">+</div>
                    <div class="' . $aboutData . '" style="font-size:15px;">' . $heading . '</div>
                </div>'
                : '<div class="add-' . $aboutData . ' align-middle" 
                    data-userid="' . $userid . '" 
                    data-profileid="' . $profileid . '" 
                    style="margin: 0 0 20px 0;">
                    <span class="about-success">' . $userdata->$aboutData . '</span>
                </div><br>'
            );
    }

    //fetch the total number of friend requests that this profile owner has received but hasn't confirmed yet
    public function requestData($profileId)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) as reqCount FROM request WHERE reqStatus = 0 AND reqtReceiver = :profileid");
        $stmt->bindValue(':profileid', $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //retrieves all requests where this profile owner is either the sender or the receiver, and the status of the request is '1', that is, 'confirmed'
    public function friendsdata($profileid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM request LEFT JOIN profile ON profile.userId = request.reqtReceiver LEFT JOIN users ON users.user_id = request.reqtReceiver WHERE request.reqtSender = :profileid AND request.reqStatus = '1' UNION
        SELECT * FROM request LEFT JOIN profile ON profile.userId = request.reqtSender LEFT JOIN users ON users.user_id = request.reqtSender WHERE request.reqtReceiver = :profileid AND request.reqStatus = '1'
        ");
        $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch all the info from the 'users','follow','profile' tables about the followers of this profile owner
    public function followersdata($profileid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM follow LEFT JOIN profile ON profile.userId = follow.sender LEFT JOIN users ON users.user_id = follow.sender WHERE follow.receiver = :profileid");
        $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the full image paths (indicating their file location in local machine) of all the photos posted by the profile owner
    public function yourPhoto($profileId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM post WHERE postImage != '' and postBy = :profileid");
        $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //fetch the row where profile-owner blocked this user or vice versa
    public function block($profileId, $userid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM block WHERE (blockerID = :userid AND blockedID = :profileid) OR (blockerID = :profileid AND blockedID = :userid) ");
        $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //get user details for which mention text matches user's first_name or userLink
    public function loadMentionUser($mention, $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT user_id, first_name, last_name, userLink, profilePic FROM users as u LEFT JOIN profile as p ON p.userId = u.user_id WHERE (first_name LIKE :mention OR userLink LIKE :mention) AND user_id != :userid ");
        $stmt->bindValue(":mention", $mention . '%');
        $stmt->bindValue(":userid", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //get all information about this user represented by userLink
    public function mention_user_details($userLink)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE userLink = :userlink ");
        $stmt->bindParam(":userlink", $userLink, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
