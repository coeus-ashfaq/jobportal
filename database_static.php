<?php


require_once ("database.php");

class DatabaseStatic
{

    protected static $table_name = "user";
    protected static $db_fields = array();

//    protected static $class_name ;
//    protected static $object;

    public static function find_all()
    {

        return static::find_by_sql("SELECT * From " . static::$table_name);
    }


    public static function find_by_id($key = 0)
    {
        $result = static::find_by_sql("SELECT * From " . static::$table_name . " where id=$key");
//        die( !empty($result) ? array_shift($result) : null);

        return !empty($result) ? array_shift($result) : null;
    }


    public static function find_by_sql($sql = "")
    {

        global $database;
        $result_set = $database->query($sql);


        $object_arr = array();

        while ($row = $database->fetch_array($result_set)) {
            $object_arr[] = static::instantiate($row);
        }
//        die(var_dump($object_arr));

        return $object_arr;

    }


    private static function instantiate($record)
    {
        $class_name = get_called_class();
        $object = new $class_name;
        foreach ($record as $attribute => $value) {
            if (static::has_attribute($attribute, $object)) {
                $object->$attribute = $value;
            }
        }
//        die(var_dump($object));

        return $object;

    }

//    private static function has_attribute($attribute)
//    {
//        $class_name = get_called_class();
//        $object = new $class_name;
//        $object_vars = get_object_vars($object);
//        return array_key_exists($attribute, $object_vars);
//    }


/////////////////////////////////////


    private static function has_attribute($attribute,$object){
        $object_vars = static::attributes($object);
        return array_key_exists($attribute,$object_vars);
    }

    protected static function attributes($object)
    {
        // return an array of attribute names and their values
//
//        $class_name = get_called_class();
//        $object = new $class_name;
//        die(var_dump($object->first_name));

        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($object, $field)) {
//                die(var_dump($object->$field));
                $attributes[$field] = $object->$field;
            }
        }
//        die(var_dump($attributes));
        return $attributes;
    }

    protected static function sanitized_attributes($object)
    {
        global $database;
//        die(var_dump((int)$object->id));
        $object->id = (int)$object->id;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute

        foreach (static::attributes($object) as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }

        $clean_attributes["id"] = (int)$clean_attributes["id"];


        return $clean_attributes;
    }

    public static function create($object)
    {
//        die(var_dump(true));

        global $database;

        $attributes = static::sanitized_attributes($object);
        $query = "INSERT INTO " . static::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";


        if ($database->query($query)) {
            $object->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }


    public static function update($object) {

//                die(var_dump($object));

        global $database;
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

        $attributes = static::sanitized_attributes($object);
        $attribute_pairs = array();
//                die(var_dump($attributes));

        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->escape_value($object->id);


        $database->query($sql);
        die(var_dump($database->affected_rows()));

        return ($database->affected_rows() == 1) ? true : false;
    }

    public static function save($object) {
        // A new record won't have an id yet.
//        die(var_dump($object->id));

        return isset($object->id) ? static::update($object) : static::create($object);
    }

    public function delete($object) {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM ".self::$table_name;
        $sql .= " WHERE id=". $database->escape_value($object->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;

        // NB: After deleting, the instance of User still
        // exists, even though the database entry does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted";
        // but, for example, we can't call $user->update()
        // after calling $user->delete().
    }
}