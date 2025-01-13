<?php

try {
    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "restaurant";

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

function getCustomer($conn)
{
    try {
        $sql = "SELECT * FROM customers;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        echo "Customer query error : " . $e->getMessage();
        exit();
    }
}

function addCustomer($conn, $customer_name, $customer_city)
{
    try {
        $sql = "INSERT INTO customers (`name`, `city`) VALUES (:name, :city)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            "name" => $customer_name,
            "city" => $customer_city,
        ]);
    } catch (Exception $e) {
        echo "Add Customer error : " . $e->getMessage();
    }
}
function getMenu($conn)
{
    try {
        $sql = "SELECT * FROM menus;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        echo "Customer query error : " . $e->getMessage();
        exit();
    }
}
function addMenu($conn, $name, $price)
{
    try {
        $sql = "INSERT INTO menus (`menu_name`, `price`) VALUES (:name, :price)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            "name" => $name,
            "price" => $price,
        ]);
    } catch (Exception $e) {
        echo "Add Menu error : " . $e->getMessage();
        exit();
    }
}


function getSubject($conn, $id)
{
    try {
        $conn->query("USE classroom;");

        $stm = $conn->prepare(
            "SELECT * 
        FROM classroom 
        WHERE `id` = :id  "
        );
        $stm->execute([
            'id' => $id
        ]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }
    return false;
}


function updateSubject($conn, $id, $subject, $day, $start_hour, $hour)
{
    try {
        $conn->query("USE classroom;");

        $stm = $conn->prepare(
            "UPDATE classroom
            SET `name`=:name, `day`=:day, `start_hour`=:start_hour, `hour`=:hour
            WHERE id=:id "
        );
        $stm->execute([
            'id' => $id,
            'name' => $subject,
            'day' => $day,
            'start_hour' => $start_hour,
            'hour' => $hour
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}


function deleteSubject($conn, $id)
{
    try {
        $conn->query("USE classroom;");

        $stm = $conn->prepare(
            "DELETE FROM classroom WHERE id=:id "
        );
        $stm->execute([
            'id' => $id
        ]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }
    return false;
}