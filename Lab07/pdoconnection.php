<?php

try {
    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "register";

    $servername = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $conn = new PDO(
        $servername,
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Database connection error : " . $e->getMessage();
    exit();
}

function login($conn, $username, $password) {
    $sql = "SELECT * 
    FROM user 
    WHERE username=:username 
    AND `password`=:password ";
    echo $sql;
    $stm = $conn->prepare( $sql );
    $stm->execute([
        "username"=> $username,
        "password"=> $password 
    ]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    var_dump($row);
    echo "</pre>";
    return $row;
}

