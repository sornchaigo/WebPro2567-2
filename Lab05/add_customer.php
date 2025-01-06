<?php
require_once("pdoconnection.php");
if (
    !empty($_POST["name"]) &&
    !empty($_POST["city"])
) {
    $name = $_POST["name"];
    $city = $_POST["city"];
    addCustomer($conn, $name, $city);

}

header("Location:/lab05");
