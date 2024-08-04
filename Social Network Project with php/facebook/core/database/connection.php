<?php

$hostDetails = 'mysql:host=127.0.0.1; port=3307; dbname=facebook; charset=utf8mb4';
$userAdmin = 'root';
$pass = '';

try{
    $pdo = new PDO($hostDetails,$userAdmin,$pass);
} catch(PDOExecption $e){
    echo 'Connection error!' . $e->getMessage();
}

?>
