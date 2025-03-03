<?php
require_once("database.php");

class Menu extends DataMapper
{
    public const table = "menus";
    public const pk = "menu_id";
    public const fields = ['menu_name', 'price'];

    public $data = [];
    public $is_new = false;

    public function __construct($data=null, $is_new=false) {
        parent::__construct(self::table, self::pk, self::fields);
        $this->data = $data;
        $this->is_new = $is_new;
    }
}

