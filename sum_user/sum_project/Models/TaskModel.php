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
    public function get_task_list(string $sort_fields = 'create_date', string $sort = 'DESC',int $list_page = 1, int $limit = 3)
    {
        $offset = $limit * ($list_page - 1);
        $sql = "SELECT * FROM tasks ORDER BY $sort_fields $sort LIMIT $offset, $limit";
        $statement = $this->pdo->query($sql);

        $sql_count = "SELECT COUNT(*) FROM tasks";
        $res = $this->pdo->query($sql_count);
        $count = $res->fetchColumn();
        return ['tasks'=>$statement, 'count'=>$count];
    }

    public function get_task($id){
        $sql = "SELECT * FROM tasks WHERE id = '$id'";
        $statement = $this->pdo->query($sql);
        return $statement->fetch();
    }

    public function change_task_text($id, $new_text){
        $data = [
            'new_text' => $new_text,
        ];
        $sql = "UPDATE tasks SET task_text = :new_text  WHERE id=$id";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute($data);
    }

}
