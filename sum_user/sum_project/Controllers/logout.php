<?php

session_start();
unset($_SESSION['user']);
$link = $_SERVER['HTTP_REFERER'];
header("Location: $link");