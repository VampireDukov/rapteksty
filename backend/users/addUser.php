<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$items =json_decode($_POST['items']);
require 'validate/validate_object.php';
function validateData($items){

    $validate = new Validate();
    if($validate->validateLogin($items->login) == true && $validate->validateMail($items->mail) == true && $validate->validatePassword($items->password) == true){
       return true;
    }else{
        echo 'badpls';
        return false;
    }
}
function addUser($items){
    require_once 'database/database_functions.php';
    $date = date("Y-m-d");
    $ipAddr = $_SERVER['REMOTE_ADDR'];
    $pass = sha1($items->password);
    $database = new DataBase();
    
    $conn = $database->Connect();
    if($database->regUser($conn,$items->login,$items->mail,$pass,$ipAddr,$date)){
        echo true;
    }

}
if(validateData($items)){
    addUser($items);
}

