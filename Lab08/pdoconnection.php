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
    -- AND `password`=:password 
    ";

    $stm = $conn->prepare( $sql );
    $stm->execute([
        "username"=> $username,
        // "password"=> password_hash($password, PASSWORD_DEFAULT)
    ]);

    $user = $stm->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        echo "User is not exist";
        return false;
    }

    $isPasswordCorrect = password_verify($password, $user['password']);
    if ( !$isPasswordCorrect) {
        echo "Password is invalid";
        return false;
    }

    $_SESSION['user'] = $user;
        return $user;
}

function isLogin() {
    if (!empty($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $username = $user['username'];
        return $user;
    }
    return false;
}

function logout() {
    unset($_SESSION['user']);
}

function insertUser($conn, 
    $username, $password, $first_name, $last_name) {

    $sql = 'INSERT INTO user 
    (username, first_name, last_name, password)
    VALUES (?, ?, ?, ?) ';
    
    $stm = $conn->prepare( $sql );
    $stm->execute([
        $username, 
        $first_name, 
        $last_name,
        password_hash($password, PASSWORD_DEFAULT),
    ]);
}