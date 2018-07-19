<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/18/18
 * Time: 1:07 PM
 */

require_once ("database.php");
require_once ("database_static.php");

class Experience extends DatabaseStatic {

    protected static $table_name = "experience";
    protected static $db_fields = array('id', 'company_name', 'job_title', 'start_date', 'end_date', 'job_designation', 'address', 'user_id');
    public $id;
    public $company_name;
    public $job_title;
    public $start_date;
    public $end_date;
    public $job_designation;
    public $address;
    public $user_id;

}