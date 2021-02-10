<?php

require_once "Model.php";

class TaskModel extends Model {

    public function create_task($task_name, $task_email, $task_text){
        $sql = "INSERT INTO tasks (task_name, task_email, task_text) VALUE (:task_name, :task_email, :task_text)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':task_name', $task_name);
        $statement->bindParam(':task_email', $task_email);
        $statement->bindParam(':task_text', $task_text);
        $statement->execute();
    }
    public function get_task_list($sort_fields = 'create_date', $sort = 'DESC')
    {
        $sql = "SELECT * FROM tasks ORDER BY '$sort_fields' '$sort'";
        $statement = $this->pdo->query($sql); //->fetchAll()
        return $statement;
    }

}
