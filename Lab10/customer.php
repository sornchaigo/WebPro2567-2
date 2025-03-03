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
}


$customer = new Customer();
$method = $_SERVER['REQUEST_METHOD'];

if (isset($_GET['list'])) {
    echo json_encode($customer->list());
} else if ($method == 'POST') {
    // $data = file_get_contents('php://input');
    // json_decode($data);
    $data = json_decode(file_get_contents('php://input'), true);
    $customer->add($data);
}
