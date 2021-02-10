<?php
error_reporting(-1);

/**
 *  work_time 10.02 - 6 часов
 * 
 */

function var_dumpe($elem)
{
    echo ('<pre>');
    var_dump($elem);
    echo ('</pre>');
}
function print_arr($elem)
{
    echo ('<pre>');
    var_dump($elem);
    echo ('</pre>');
}
spl_autoload_register(function($class_name){
        $file = file_exists(__DIR__."/Controllers/$class_name.php") ? __DIR__."/Controllers/$class_name.php" : __DIR__."/Models/$class_name.php";
        require_once $file;
    });
$controller = new TaskController();
if (isset($_POST) && !empty($_POST)) {
    $controller->create_task();
}
$task_list = $controller->get_task_list();
$tasks = $task_list[0];
$page = $task_list[1];

$fgh = trim(strrchr($_SERVER['REQUEST_URI'], '/'), '/');
if (!empty($_GET)) var_dumpe($controller->get_local);
// var_dumpe($task_list);

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
            <table class="table table-bordered" style="width: 100%;">
                <col width="5%" valign="top">
                <col width="25%" valign="top">
                <col width="25%">
                <col width="40%">
                <col width="5%">
                <tr>
                    <td><a href="Controllers/sort_task.php?sort_by=id">id</a></td>
                    <td><a href="Controllers/sort_task.php?sort_by=task_name">Имя</a></td>
                    <td>Эл адрес</td>
                    <td>Задача</td>
                    <td>Выполненно?</td>
                </tr>
            
                <?php foreach ($tasks as $task): ?>
                    <!-- <div class="d-flex justify-content-between w-100 p-2"> tr -->
                    <tr>
                        <?php foreach ($task as $key => $value): ?>
                            <?php if ($key == "Содержание") : ?>
                                    <td>
                                        <a href="?change_task=<?=$task['id']?>">
                                            <?= htmlspecialchars($value) ?>
                                        </a>
                                    </td>
                            <?php else : ?>
                                <td>
                                    <?= htmlspecialchars($value) ?>
                                </td>
                            <?php endif ?>
                            <!-- <div class="ml-1 px-1 border border-dark" style="flex-grow: 1;"> td -->
                                <!-- <strong></strong><br><span></span> -->
                            <!-- </div> -->
                        <?php endforeach; ?>
                    </tr>
                    <!-- </div> -->
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