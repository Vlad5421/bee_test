<?php

if (isset($_GET['message']) && !empty($_GET['message'])) $message = $_GET['message'];

if (isset($_POST) && !empty($_POST)) {
    $user = new UserController();
    $auth_result = $user->user_auth();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Авторизация</title>
</head>
<body>
<h1 class="text-center">Авторизация</h1>
<section class="p-2 m-3 d-flex flex-column align-items-center" style="border: 2px solid #ccc; border-radius: 10px; padding: 10px;">
    <?php if(isset($message)): ?>
        <h3><?= $message ?></h3>
    <?php endif ?>
    <form action="#" method="post" class="task_form w-50">
        <div class="form-group">
            <label for="user_login">Ваш логин:</label>
            <input type="text" class="form-control" name="user_login" id="user_login" aria-describedby="loginHelp" placeholder="Ваш логин" required>
            <small id="loginHelp" class="form-text text-muted">Укажите логин</small>
        </div>
        <div class="form-group">
            <label for="user_password">Пароль:</label>
            <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Ваш парль" required>
        </div>
        <?php if (isset($auth_result) && $auth_result == false): ?>
            <div class="alert alert-danger" role="alert">Введены некорректные данные</div>
        <?php endif ?>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</secton>
</body>
</html>