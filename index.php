<?php

spl_autoload_register(function($class_name){
    $file = file_exists(__DIR__."/Controllers/$class_name.php") ? __DIR__."/Controllers/$class_name.php" : __DIR__."/Models/$class_name.php";
    require_once $file;
});

$queri = explode('?', $_SERVER['REQUEST_URI']);

$action = trim(strrchr($queri[0], '/'), '/');


switch ($action) {
    case 'sort_task':
        $view = __DIR__.'/Controllers/sort_task.php';
        break;
    case 'logout':
        $view = __DIR__.'/Controllers/logout.php';
        break;
    case 'task_list':
        $view = __DIR__.'/views/task_list.php';
        break;
    case 'sign_in':
        $view = __DIR__.'/views/sign_in.php';
        break;
    case 'change_task_view':
        $view = __DIR__.'/views/change_task.php';
        break;
    case 'change_task_ctl':
        $view = __DIR__.'/Controllers/change_task.php';
        break;
    
    default:
        $view = __DIR__.'/views/task_list.php';
        break;
}
require_once $view;
