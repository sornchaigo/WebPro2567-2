<?php

class MyPDO extends PDO
{

    public function __construct()
    {

        $username = "root";
        $password = "";
        $host = "localhost";
        $dbname = "restaurant";

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        parent::__construct(
            $dsn,
            $username,
            $password
        );
    }
}

class DataMapper
{

    static $db;

    public $table = "";
    public $pk = "";
    public $fields = [];

    public $is_new = false;
    public $data = [];

    public function __construct($table, $pk, $fields)
    {
        $this->table = $table;
        $this->pk = $pk;
        $this->fields = $fields;
    }

    public static function init()
    {
        if (self::$db === null) {
            self::$db = new MyPDO();
        }
    }

    public static function select(
        $table_name,
        $condition = null,
        $parametor = null
    ) {
        $sql = "SELECT * FROM $table_name ";
        if (is_array($condition)) {
            $sql .= " WHERE " . implode(' AND ', $condition);
        }
        $stmt = self::$db->prepare($sql);
        $result = $stmt->execute($parametor);
        if ($result) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function get($id)
    {
        $data = self::select(
            $this->table,
            [$this->pk."=:id"],
            ['id' => $id]
        );
        if ($data)
            return $data[0];
        return [];
    }

    public static function list($table)
    {
        return self::select($table);
    }

    public static function add($data, $table, $fields)
    {
        $sql = "INSERT INTO $table (" .
            implode(
                ',',
                $fields
            ) . ") VALUES (:" .
            implode(",:", $fields)
            . ") ";
        $stmt = self::$db->prepare($sql);
        $stmt->execute($data);
    }

    public static function update($id, $data, $table, $pk)
    {
        unset($data['id']);
        unset($data[$pk]);
        foreach ($data as $key => $value) {
            $data_key[] = "$key=:$key";
        }
        $data['id'] = $id;

        $sql = "UPDATE $table 
                SET " . implode(",", $data_key) .
            " WHERE $pk=:id";
        $stmt = self::$db->prepare($sql);
        $stmt->execute($data);
    }

    public static function delete($id, $table, $pk)
    {
        $sql = "DELETE FROM $table WHERE $pk=:id";
        $stmt = self::$db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function save()
    {
        if ($this->is_new) {
            self::add($this->data, $this->table, $this->fields);
            $this->is_new = false;
        } else {
            self::update($this->data[$this->pk], $this->data);
            $this->is_new = false;
        }
    }
}

try {
    DataMapper::init();
} catch (Exception $e) {
    echo "" . $e->getMessage() . "";
}
