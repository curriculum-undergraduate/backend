<?php 

session_start();
// session_save_path()

// load all class
spl_autoload_register(function($class){
    require_once "classes/" . $class. ".php";
});

$user = new User();
$batch = new Batch();