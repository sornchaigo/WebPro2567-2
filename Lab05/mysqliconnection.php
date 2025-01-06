<?php
//– เชื่อมต่อ Database
$host = "localhost";
$mysqli = new mysqli($host,
    "root","",
    "restaurant");

//– การตั้งค่าภาษา รองรับภาษาไทย
$mysqli->set_charset("utf8");
