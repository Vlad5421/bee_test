<?php
session_start();

$_SESSION['changed_task_id'] = $_GET['id'];

if ($_SESSION['user']['role'] != 'admin') {
    $text = 'Для изменения задачи нужно авторизоваться, каак администратор!';
    $view = '../sign_in?message='. $text;
    header("Location: $view");
    die;
} else {
    $view = '../change_task';
    header("Location: $view");
}
