<?php
class MyPDO extends PDO
{
    public function __construct($file = 'my_setting.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE))
            throw new exception('Unable to open ' . $file . '.');

        $dns = $settings['database']['driver']
            . ':host=' . $settings['database']['host']
            . ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '')
            . ';dbname=' . $settings['database']['schema'];
        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }
}

class DataMapper
{
    public static $db;
    public $is_new;
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        // $this->data = $data;
    }

    public static function init()
    {
        if (!self::$db)
            self::$db = new MyPDO();
    }

    public static function find($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id=:id LIMIT 1; ";
        $stmt = self::$db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public static function insert($table, $data)
    {
        $field = array_keys($data);
        $f = implode(',', $field);
        $d = ':' . implode(', :', $field, );
        $sql = "INSERT INTO $table ( $f ) VALUES ( $d )";
        echo $sql;
        $stmt = self::$db->prepare($sql);
        $stmt->execute($data);
    }
}

DataMapper::init();
