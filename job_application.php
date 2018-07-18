<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/18/18
 * Time: 1:06 PM
 */

require_once ("database.php");
require_once ("database_object.php");

class JobApplication extends DatabaseObject{

    protected static $table_name = "job_applications";
    protected static $db_fields = array('id', 'job_id', 'user_id', 'status');
    public $id;
    public $job_id;
    public $user_id;
    public $status;


}