<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "banco";
$port = 3306;

try{
    $connection = new PDO("mysql:host=$host;port=$port;dbname=" .$dbname, $user, $pass);
    

}catch(PDOException $erro){
    echo "erro" .$erro->getMessage();
}