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
    public function get_task_list()
    {
        $sql = "SELECT * FROM tasks ORDER BY create_date DESC";
        $statement = $this->pdo->query($sql); //->fetchAll()
        return $statement;
    }

}
