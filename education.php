<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/18/18
 * Time: 1:07 PM
 */

require_once ("database.php");
require_once ("database_object.php");

class Education extends DatabaseObject{

    protected static $table_name = "education";
    protected static $db_fields = array('id', 'school', 'start_sate', 'end_date', 'major_subject', 'user_id');
    public $id;
    public $school;
    public $start_date;
    public $end_date;
    public $major_subject;
    public $user_id;

}