<?php

$controller = new TaskController();
$create_result = false;
if (isset($_POST) && !empty($_POST)) {
    $create_result = $controller->create_task();
}
$task_list = $controller->get_task_list();
$tasks = $task_list[0];
$page = $task_list[1];

if (isset($_SESSION['sort_param']['list_page'])) $list_page = $_SESSION['sort_param']['list_page'];
else $list_page = 1;

$user = new UserController;
$user_status = $user->check_status(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Задачник</title>
</head>
<body>
    <h1 class="text-center">Задачи</h1>
    <section class="p-2 m-3" style="border: 2px solid #ccc; border-radius: 10px; padding: 10px;">
        <div class="m-5" >
        <?php if ($create_result == true): ?>
            <div class="alert alert-success w-25" role="alert">Новая задача успешно создана</div>
        <?php endif ?>
        <h2>Страница <?=$list_page?></h2>
            <table class="table table-bordered" style="width: 100%;">
                <col width="5%" valign="top">
                <col width="20%" valign="top">
                <col width="20%">
                <col width="35%">
                <col width="5%">
                <col width="15%">
                <tr>
                    <td><a href="sort_task?sort_by=id">id</a></td>
                    <td><a href="sort_task?sort_by=task_name">Имя</a></td>
                    <td><a href="sort_task?sort_by=task_email">Эл. адрес</a></td>
                    <td>Задача</td>
                    <td><a href="sort_task?sort_by=performed">Статус выполнения</a></td>
                    <td><a href="sort_task?sort_by=change_date">Изменено</a></td>
                </tr>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <?php foreach ($task as $key => $value): ?>
                            <?php if ($key == "Задача") : ?>
                                    <td>
                                        <a href="change_task_ctl?id=<?=$task['id']?>">
                                            <?= htmlspecialchars($value) ?>
                                        </a>
                                    </td>
                            <?php elseif ($key == "performed" && $value != 0) : ?>
                            <?php $value = 'выплненно' ?>
                            <?php else : ?>
                                <td>
                                    <?= htmlspecialchars($value) ?>
                                </td>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="page_row">
            <?php for ($i=1; $i <= $page ; $i++) : ?> 
                <a href="sort_task?list_page=<?=$i?>" class="page_a"><?=$i?></a>
            <?php endfor ?>
            </div>
        </div>
        <div class="m-5 w-25">
            <form action="#" method="post" class="task_form">
                <h3>Создание задачи:</h3><hr>
                <div class="form-group">
                    <label for="task_email">Email адрес:</label>
                    <input type="email" class="form-control" name="task_email" id="task_email" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">Укажите email ящик исполнителя.</small>
                </div>
                <div class="form-group">
                    <label for="task_name">Имя:</label>
                    <input type="text" class="form-control" name="task_name" id="task_name" placeholder="Имя исполнителя" required>
                </div>
                <div class="form-group">
                    <label for="task_text">Опишите задачу:</label>
                    <textarea class="form-control" name="task_text" id="task_text" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
            <?php if ($user_status == 'admin'): ?>
                <a href="logout"><button type="button" class="btn btn-danger mt-2">Выйти</button></a>
            <?php else: ?>
                <a href="sign_in"><button type="button" class="btn btn-success mt-2">Войти</button></a>
            <?php endif ?>
        </div>
    </section>
</body>
</html>