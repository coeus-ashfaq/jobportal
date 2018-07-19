<?php
/**
 * Created by PhpStorm.
 * User: ashfa
 * Date: 7/15/2018
 * Time: 4:50 PM
 */

require_once("db_config.php");

class MySQLConnection {

    private $connection;
    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exits;


    public function __construct()
    {
        $this->open_connection();
        $this->magic_quotes_active = get_magic_quotes_gpc();
        $this->real_escape_string_exits = function_exists( "mysqli_real_escape_string" ); // i.e. PHP >= v4.3.0

    }

    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
        if (!$this->connection){
            die("Databse Connection Failed: ".mysqli_error($this->connection));
        }
        else{
            $db_select = mysqli_select_db($this->connection,DB_NAME);
            if (!$db_select){
                die("Databse Selection Failed: ".mysqli_error($this->connection));
            }
        }
    }

    public function close_connection(){
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql){

        $this->last_query = $sql;


        $result = mysqli_query($this->connection,$sql);

        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result)
    {


        if (!$result){

            $output = "Query Failed: ".mysqli_error($this->connection) . "<br>";
            $output .= "Last SQL Query : ".$this->last_query;

        }
    }

    public function fetch_array($result){
        return mysqli_fetch_array($result);
    }

    public function num_rows($result){
        return mysqli_num_rows($result);
    }

    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }

    public function escape_value( $value ) {
//        die(var_dump(($value)));

//        $magic_quotes_active = get_magic_quotes_gpc();
//        $new_enough_php = function_exists( "mysqli_real_escape_string" ); // i.e. PHP >= v4.3.0

        if( $this->real_escape_string_exits ) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if( $this->magic_quotes_active ) { $value = stripslashes( $value );

            }
//            die(var_dump(($value)));
//            $value = mysqli_real_escape_string($this->connection, $value );
//            die(var_dump(($value)));
        } else { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
            // if magic quotes are active, then the slashes already exist
        }

        return $value;
    }

    public static function object(){
        $obj = new MySQLConnection();
        return $obj;
    }
}

$database = new MySQLConnection();