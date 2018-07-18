<?php


require_once ("database.php");

class DatabaseStatic {

    protected static $table_name = "user";
    protected static $db_fields = array();


    public function find_all(){

        return static::find_by_sql("SELECT * From ".static::$table_name);
    }


    public static function find_by_id($key=0){

        $result = static::find_by_sql("SELECT * From ".static::$table_name." where id=$key");
        return !empty($result)? array_shift($result):null;
    }


    public static function find_by_sql($sql=""){
        global $database;
        $result_set = $database->query($sql);


        $object_arr = array();

        while ($row = $database->fetch_array($result_set)){
            $object_arr[] = static::instantiate($row);
        }

        return $object_arr;

    }

    private static function instantiate($record){
        $class_name = get_called_class();
        $object = new $class_name;

        foreach ($record as $attribute=>$value){
            if (static::has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;

    }

    private static function has_attribute($attribute){
        $class_name = get_called_class();
        $object = new $class_name;
        $object_vars = get_object_vars($object);
        return array_key_exists($attribute,$object_vars);
    }
}