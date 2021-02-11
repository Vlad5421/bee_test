<?php
error_reporting(-1);

/**
 *  work_time 10.02 - 6 часов
 * 
 */

function var_dumpe($elem)
{
    echo ('<pre>');
    var_dump($elem);
    echo ('</pre>');
}
function print_arr($elem)
{
    echo ('<pre>');
    var_dump($elem);
    echo ('</pre>');
}

spl_autoload_register(function($class_name){
    $file = file_exists(__DIR__."/Controllers/$class_name.php") ? __DIR__."/Controllers/$class_name.php" : __DIR__."/Models/$class_name.php";
    require_once $file;
});

$queri = explode('?', $_SERVER['REQUEST_URI']);

$action = trim(strrchr($queri[0], '/'), '/');


switch ($action) {
    case '':
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
