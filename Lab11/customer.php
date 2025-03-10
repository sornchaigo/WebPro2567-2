<?php
require_once("database.php");

class Customer extends DataMapper
{
    public const table = "customers";
    public const pk = "id";
    public const fields = ['name', 'city'];

    public $data = [];
    public $is_new = false;

    public function __construct($data = null, $is_new = false)
    {
        parent::__construct(self::table, self::pk, self::fields);
        $this->data = $data;
        $this->is_new = $is_new;
    }

    public static function list($table = '')
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

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    $method = $_SERVER['REQUEST_METHOD'];
    if (isset($_GET['list'])) {
        echo json_encode(Customer::list());
    } else if ($method == 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        Customer::add($data);
    } else if ($method == 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        Customer::update($id, $data);
    } else if ($method == 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        Customer::delete($id);
    }
}