<?php
session_start();

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

    $stm = $conn->prepare( $sql );
    $stm->execute([
        "username"=> $username,
        "password"=> $password 
    ]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $user;
    return $user;
}

function isLogin() {
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $username = $user['username'];
        return $user;
    }
    return false;
}

function logout() {
    unset($_SESSION['user']);
}
