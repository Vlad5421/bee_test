<?php

$task = new TaskController();
$task->get_task();
$performed = ($task->performed == 0) ? '' : 'checked';

if (!empty($_POST)) {
    var_dumpe($_POST);
    // $task->change_task();
    
}
// var_dumpe($task);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Изменение задачи</title>
</head>
<body>
    <h1 style="text-align: center;">Изменение задачи</h1>
    <div class="d-flex justify-content-center">

        <form action="#" method="post" class="task_form w-50">
            <div class="form-group">
                <label for="task_email">Email адрес:</label>
                <input type="email" class="form-control" name="task_email" id="task_email" aria-describedby="emailHelp" value="<?= $task->task_email ?>" disabled >
            </div>
            <div class="form-group">
                <label for="task_name">Имя:</label>
                <input type="text" class="form-control" name="task_name" id="task_name" value="<?= $task->task_name ?>" disabled>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="performed" type="checkbox"  id="performed" <?=$performed?> >
                <label class="form-check-label" for="performed">
                    Отметка о выполнении.
                </label>
            </div>
            <div class="form-group">
                <label for="task_text">Опишите задачу:</label>
                <textarea class="form-control" name="task_text" id="task_text" rows="6"><?=$task->task_text?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>

</body>
</html>