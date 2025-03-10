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
    public static function list()
    {
        return self::select(self::table);
    }

}


$customer = new Customer();
$method = $_SERVER['REQUEST_METHOD'];
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
{
    if (isset($_GET['list'])) {
        echo json_encode(Customer::list());
    } else if ($method == 'POST') {
        // $data = file_get_contents('php://input');
        // json_decode($data);
        $data = json_decode(file_get_contents('php://input'), true);
        $customer->add($data);
    } else if ($method == 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $customer->update($id, $data);
    } else if ($method == 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $customer->delete($id);
    }
}