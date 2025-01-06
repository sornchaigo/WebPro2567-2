<?php
require_once("pdoconnection.php");
if (
    !empty($_POST["menu_name"]) &&
    !empty($_POST["price"])
) {
    $name = $_POST["menu_name"];
    $price = $_POST["price"];
    addMenu($conn, $name, $price);
}
header("Location:/lab05");
