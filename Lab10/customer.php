<?php
require_once("database.php");

class Customer extends DataMapper
{
    public const table = "customers";
    public const pk = "id";
    public const fields = ['name', 'city'];

    public $data = [];
    public $is_new = false;

    public function __construct($data=null, $is_new=false) {
        parent::__construct(self::table, self::pk, self::fields);
        $this->data = $data;
        $this->is_new = $is_new;
    }

    public function list() {
        return json_encode(parent::list() );
    }
}


$customer = new Customer();
if ( isset($_GET['list' ]) )
    echo $customer->list();
