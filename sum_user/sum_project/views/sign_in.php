<?php

if (isset($_GET['message']) && !empty($_GET['message'])) $message = $_GET['message'];

if (isset($_POST) && !empty($_POST)) {
    $user = new UserController();
    $user->user_auth();
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
<?php if(isset($message)): ?>
    <h3><?= $message ?></h3>
<?php endif ?>
<form action="#" method="post" class="task_form">
    <div class="form-group">
        <label for="user_email">Email адрес:</label>
        <input type="email" class="form-control" name="user_email" id="user_email" aria-describedby="emailHelp" placeholder="Ваш email">
        <small id="emailHelp" class="form-text text-muted">Укажите email</small>
    </div>
    <div class="form-group">
        <label for="user_password">Пароль:</label>
        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Ваш парль">
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
</body>
</html>