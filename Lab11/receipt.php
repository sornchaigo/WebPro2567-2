<?php
require_once("database.php");
require_once("menu.php");
require_once("customer.php");

class Receipt extends DataMapper
{

    public const table = "receipt";
    public const pk = "receipt_id";
    public const fields = ['customer_id', 'menu_id'];
    public $data = [];
    public $is_new = false;

    public function __construct($data = null, $is_new = false)
    {
        parent::__construct(self::table, self::pk, self::fields);
        $this->data = $data;
        $this->is_new = $is_new;
    }

    public static function all($table = self::$table)
    {
        return self::select(self::table);
    }

    public static function load($id)
    {
        $data = parent::select(
            self::table,
            [self::pk . "=:id"],
            ['id' => $id]
        );
        $data[0]['customer'] = self::getCustomer($data[0]['customer_id']);
        $data[0]['menu'] = self::getMenu($data[0]['menu_id']);
        $receipts = new self($data[0]);
        return $receipts;
    }

    public function get($id)
    {
        return self::load($id);
    }

    public static function getMenu($menu_id)
    {
        $menu = new Menu();
        $data = $menu->get($menu_id);
        if ($data)
            return $data;
    }
    public static function getCustomer($customer_id)
    {
        $customer = new Customer();
        $data = $customer->get($customer_id);
        if ($data)
            return $data;
    }

}

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {

    $method = $_SERVER['REQUEST_METHOD'];
    if (isset($_GET['list'])) {
        echo json_encode(Receipt::all(), );
    } else if ($method == 'GET' && !empty($_GET['id'])) {
        echo json_encode(Receipt::load($_GET['id'])->data);
    }
}

