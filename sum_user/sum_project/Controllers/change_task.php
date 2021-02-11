<?php
function var_dumpe($elem)
{
    echo ('<pre>');
    var_dump($elem);
    echo ('</pre>');
}
session_start();

// var_dumpe($_SESSION);
// var_dumpe($_SERVER["REQUEST_URI"]);
// var_dumpe($_SERVER);

$_SESSION['changed_task_id'] = $_GET['id'];

if ($_SESSION['user']['role'] != 'admin') {
    $text = 'Для изменения задачи нужно авторизоваться, каак администратор!';
    $view = $_SERVER["HTTP_REFERER"].'sign_in?message='. $text;
    header("Location: $view");
    die;
} else {
    $view = 'change_task.php';
}