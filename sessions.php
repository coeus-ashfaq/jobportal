<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/16/18
 * Time: 12:32 PM
 */

class Session {

    private $logged_in = false;
    public $user_id;
    public $name;
    public $type;

    public function __construct()
    {
        session_start();
        $this->check_login();
    }



    /**
     * @return bool
     */
    public function is_logged_in()
    {
        return $this->logged_in;
    }


    public function login($user){
//        die(var_dump($user));
        if ($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;

            $this->name = $_SESSION['name'] = $user->first_name." ".$user->last_name;
            $this->type = $_SESSION['type'] = $user->type;

        }

//        die(var_dump($this->user_id));
    }

    public function logout(){

        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;
        session_destroy();
    }

    /**
     * @return bool
     */
    private function check_login() {
        if (isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->name = $_SESSION['name'];
            $this->type = $_SESSION['type'];
            $this->logged_in = true;
        } else{
          unset($this->user_id);
          $this->logged_in = false;
        }
        return $this->logged_in;
    }
}

$session = new Session();