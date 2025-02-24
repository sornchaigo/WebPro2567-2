<?php
require_once("database.php");

class Menu extends DataMapper
{
    public $table = "menus";
    public $pk = "menu_id";
    public $fields = ['menu_name', 'price'];

}

$menu = new Menu();
$data = $menu->list();

var_dump($data);

echo "<br>";
$cake = $menu->get(1);
var_dump($cake);
