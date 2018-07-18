<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/18/18
 * Time: 1:07 PM
 */

require_once ("database.php");
require_once ("database_object.php");

class Document extends DatabaseObject{

    protected static $table_name = "document";
    protected static $db_fields = array('id', 'name', 'user_id');
    public $id;
    public $name;
    public $user_id;

}