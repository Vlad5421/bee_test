<?php

$controller = new TaskController();
if (isset($_POST) && !empty($_POST)) {
    $controller->create_task();
}
$task_list = $controller->get_task_list();

$tasks = $task_list[0];
$page = $task_list[1];


if (!empty($_GET)) var_dumpe($controller->get_local);
if (isset($_SESSION['sort_param']['list_page'])) $list_page = $_SESSION['sort_param']['list_page'];
else $list_page = 2;
// var_dumpe($task_list);
var_dumpe($_SESSION);
// var_dumpe($page);

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
        <h2>Страница <?=$list_page?></h2>
            <table class="table table-bordered" style="width: 100%;">
                <col width="5%" valign="top">
                <col width="20%" valign="top">
                <col width="20%">
                <col width="35%">
                <col width="5%">
                <col width="15%">
                <tr>
                    <td><a href="Controllers/sort_task.php?sort_by=id">id</a></td>
                    <td><a href="Controllers/sort_task.php?sort_by=task_name">Имя</a></td>
                    <td>Эл адрес</td>
                    <td>Задача</td>
                    <td>Выполненно?</td>
                    <td>Изменено</td>
                </tr>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <?php foreach ($task as $key => $value): ?>
                            <?php if ($key == "Задача") : ?>
                                    <td>
                                        <a href="Controllers/change_task.php?id=<?=$task['id']?>">
                                            <?= htmlspecialchars($value) ?>
                                        </a>
                                    </td>
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
                <a href="Controllers/sort_task.php?list_page=<?=$i?>" class="page_a"><?=$i?></a>
            <?php endfor ?>
            </div>
        </div>

        <div class="m-5 w-25">
            <form action="#" method="post" class="task_form">
                <div class="form-group">
                    <label for="task_email">Email адрес:</label>
                    <input type="email" class="form-control" name="task_email" id="task_email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">Укажите email ящик исполнителя.</small>
                </div>
                <div class="form-group">
                    <label for="task_name">Имя:</label>
                    <input type="text" class="form-control" name="task_name" id="task_name" placeholder="Имя исполнителя">
                </div>
                <div class="form-group">
                    <label for="task_text">Опишите задачу:</label>
                    <textarea class="form-control" name="task_text" id="task_text" rows="6"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </section>
</body>
</html>