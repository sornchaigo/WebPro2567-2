<?php
require_once("database.php");

class Menu extends DataMapper
{
    public const table = "menus";
    public const pk = "menu_id";
    public const fields = ['menu_name', 'price'];

    public $data = [];
    public $is_new = false;

    public function __construct($data = null, $is_new = false)
    {
        parent::__construct(self::table, self::pk, self::fields);
        $this->data = $data;
        $this->is_new = $is_new;
    }

    public static function list($table='')
    {
        return parent::select(self::table);
    }

    public static function add($data, $table = '', $fields = '')
    {
        return parent::add($data, self::table, self::fields);
    }

    public static function update($id, $data, $table = 'id', $fields = '')
    {
        return parent::update($id, $data, self::table, self::pk);
    }

    public static function delete($id, $table = '', $pk = '')
    {
        return parent::delete($id, self::table, self::pk);
    }

}


$method = $_SERVER['REQUEST_METHOD'];
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    if (isset($_GET['list'])) {
        echo json_encode(Menu::list());
    } else if ($method == 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        Menu::add($data);
    } else if ($method == 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        Menu::update($id, $data);
    } else if ($method == 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        Menu::delete($id);
    }
}