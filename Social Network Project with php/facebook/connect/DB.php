<?php

class DB{

    private static function connect(){
        $pdo = new PDO('mysql:host=127.0.0.1; port=3307; dbname=facebook; charset=utf8mb4', 'root', '');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // ATTR_ERRMODE -> report error, ERRMODE_EXCEPTION -> throw exception
        return $pdo;
    }

    public static function query($query, $params = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if(explode(' ', $query)[0] == 'SELECT'){
            //if the first word of the query is SELECT, fetch and return the data
            $data = $statement->fetchAll();
            return $data;
        }
    }
}
?>
