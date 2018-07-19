<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/18/18
 * Time: 1:06 PM
 */

require_once ("database.php");
require_once ("database_static.php");

class Job extends DatabaseStatic {

    protected static $table_name = "job";
    protected static $db_fields = array('id', 'company_name', 'industry', 'designation', 'offered_salary', 'experience_required', 'shift', 'job_type', 'slots', 'user_id');
    public $id;
    public $company_name;
    public $industry;
    public $designation;
    public $offered_salary;
    public $experience_required;
    public $shift;
    public $job_type;
    public $slots;
    public $user_id;

}