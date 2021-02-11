<?php

spl_autoload_register(function($class_name){
    $file = file_exists(__DIR__."/Controllers/$class_name.php") ? __DIR__."/Controllers/$class_name.php" : __DIR__."/Models/$class_name.php";
    require_once $file;
});

$queri = explode('?', $_SERVER['REQUEST_URI']);

$action = trim(strrchr($queri[0], '/'), '/');


switch ($action) {
    case 'logout':
        $view = 'Controllers/logout.php';
        break;
    case 'task_list':
        $view = 'views/task_list.php';
        break;
    case 'sign_in':
        $view = 'views/sign_in.php';
        break;
    case 'change_task':
        $view = 'views/change_task.php';
        break;
    
    default:
        $view = 'views/task_list.php';
        break;
}
require_once $view;
