<?php
/**
 * Created by PhpStorm.
 * User: ashfa
 * Date: 7/15/2018
 * Time: 7:31 PM
 */

require_once ("database.php");
require_once ("database_static.php");


class User extends DatabaseStatic {
//class User extends DatabaseObject {

//class User {

    protected static $table_name = "user";
    protected static $db_fields = array('id','first_name', 'last_name', 'dob', 'age', 'gender', 'email', 'picture', 'phone', 'address', 'password', 'type', 'current_salary', 'expected_salary');
    public $id;
    public $first_name;
    public $last_name;
    public $dob;
    public $age=0;
    public $gender;
    public $email;
    public $picture;
    public $phone=0;
    public $address;
    public $password;
    public $type;
    public $current_salary=0;
    public $expected_salary=0;


    public static function authanticate($username = "", $password = ""){
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $sql = "SELECT * from ".self::$table_name." WHERE email='$username' AND password = '$password' LIMIT 1";
//        die(var_dump(true));

        $result_arr = parent::find_by_sql($sql);

//        die(var_dump($result_arr));

        return !empty($result_arr)? array_shift($result_arr) : false;
    }


    public function full_name(){
        if (isset($this->first_name) && isset($this->last_name)){
            return $this->first_name." ".$this->last_name;
        }
        else{
            return "";
        }
    }

    public function validate_picture(){

    }

//    public function find_all(){
//        global $database;
//        return self::find_by_sql("SELECT * From ".self::$table_name);
//    }
//
//    public function find_by_id($key=0){
//        global $database;
//        $result = self::find_by_sql("SELECT * From ".self::$table_name." where id=$key");
////        return $database->fetch_array($result);
//        return !empty($result)? array_shift($result):null;
//    }
//
//    public function find_by_sql($sql=""){
//        global $database;
//        $result_set = $database->query($sql);
//
//
//        $object_arr = array();
//
//        while ($row = $database->fetch_array($result_set)){
//            $object_arr[] = self::instantiate($row);
//        }
//
//        return $object_arr;
//
//    }


///////////////////////////////


//    public function instantiate($record){
//        $object = new self;
////        $object->first_name = $record["first_name"];
////        $object->last_name = $record["last_name"];
//
//        foreach ($record as $attribute=>$value){
//            if ($object->has_attribute($attribute)){
//                $object->$attribute = $value;
//            }
//        }
//        return $object;
//
//    }
//
//    private function has_attribute($attribute){
//        $object_vars = $this->attributes();
//        return array_key_exists($attribute,$object_vars);
//    }
////
//    protected function attributes() {
//        // return an array of attribute names and their values
//        $attributes = array();
//        foreach(self::$db_fields as $field) {
//            if(property_exists($this, $field)) {
//                $attributes[$field] = $this->$field;
//            }
//        }
//        return $attributes;
//    }
//
//    protected function sanitized_attributes() {
//        global $database;
//        $clean_attributes = array();
//        // sanitize the values before submitting
//        // Note: does not alter the actual value of each attribute
//        foreach($this->attributes() as $key => $value){
//            $clean_attributes[$key] = $database->escape_value($value);
//        }
//        return $clean_attributes;
//    }
//
//    public function create() {
//        global $database;
//        // Don't forget your SQL syntax and good habits:
//        // - INSERT INTO table (key, key) VALUES ('value', 'value')
//        // - single-quotes around all values
//        // - escape all values to prevent SQL injection
//        $attributes = $this->sanitized_attributes();
//        $sql = "INSERT INTO ".self::$table_name." (";
//        $sql .= join(", ", array_keys($attributes));
//        $sql .= ") VALUES ('";
//        $sql .= join("', '", array_values($attributes));
//        $sql .= "')";
//        if($database->query($sql)) {
//            $this->id = $database->insert_id();
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//
//    public function update() {
//        global $database;
//        // Don't forget your SQL syntax and good habits:
//        // - UPDATE table SET key='value', key='value' WHERE condition
//        // - single-quotes around all values
//        // - escape all values to prevent SQL injection
//
//        $attributes = $this->sanitized_attributes();
//        $attribute_pairs = array();
//
//        foreach($attributes as $key => $value) {
//            $attribute_pairs[] = "{$key}='{$value}'";
//        }
//
//        $sql = "UPDATE ".self::$table_name." SET ";
//        $sql .= join(", ", $attribute_pairs);
//        $sql .= " WHERE id=". $database->escape_value($this->id);
//        $database->query($sql);
//        return ($database->affected_rows() == 1) ? true : false;
//    }
//
//    public function save() {
//        // A new record won't have an id yet.
//        return isset($this->id) ? $this->update() : $this->create();
//    }
//
//    public function delete() {
//        global $database;
//        // Don't forget your SQL syntax and good habits:
//        // - DELETE FROM table WHERE condition LIMIT 1
//        // - escape all values to prevent SQL injection
//        // - use LIMIT 1
//        $sql = "DELETE FROM ".self::$table_name;
//        $sql .= " WHERE id=". $database->escape_value($this->id);
//        $sql .= " LIMIT 1";
//        $database->query($sql);
//        return ($database->affected_rows() == 1) ? true : false;
//
//        // NB: After deleting, the instance of User still
//        // exists, even though the database entry does not.
//        // This can be useful, as in:
//        //   echo $user->first_name . " was deleted";
//        // but, for example, we can't call $user->update()
//        // after calling $user->delete().
//    }
}
