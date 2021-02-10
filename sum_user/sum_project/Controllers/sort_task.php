<?php
session_start();
$sort_param = $_SESSION['sort_param'];
$sort_param['field'] = $_GET['sort_by'];
$sort_param['sort'] = (!isset($_SESSION['sort_param']['sort']) or empty($_SESSION['sort_param']['sort']) or $_SESSION['sort_param']['sort'] == 'ASC') ? 'DESC' : 'ASC';
if (isset($_GET['list_page']) && !empty($_GET['list_page']))
    $sort_param['list_page'] = $_GET['list_page'];
$_SESSION['sort_param'] = $sort_param;


// function var_dumpe($elem)
// {
//     echo ('<pre>');
//     var_dump($elem);
//     echo ('</pre>');
// }
$ref = $_SERVER["HTTP_REFERER"];
header("Location: $ref");