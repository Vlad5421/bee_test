<?php

session_start();
unset($_SESSION['user']);
$link = 'task_list';
header("Location: $link");
