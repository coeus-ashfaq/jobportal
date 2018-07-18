<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/16/18
 * Time: 7:44 PM
 */

require_once ("sessions.php");
    $session->logout();
    header("Location:  index.php");

?>