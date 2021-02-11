<?php

class UserController {
    public $user_email;
    public $user_password;
    protected $model;

    public function __construct(){
        if (isset($_POST) && !empty($_POST)) {
            $this->user_email = $_POST['user_email'];
            $this->user_password = md5($_POST['user_password']);
        }
        $this->model = new UserModel();
    }

    public function user_auth(){
        $user_from_db = $this->model->get_user_pass($this->user_email);
        if ($user_from_db == !false) {
            if ($this->user_password != $user_from_db['user_password']) return false;
            else {
                session_start();
                $_SESSION['user'] = $user_from_db;
                if (isset($_SESSION['changed_task_id']) && !empty($_SESSION['changed_task_id'])){
                    $task_id = $_SESSION['changed_task_id'];
                    $link = "Controllers/change_task.php?id=$task_id";
                    header("Location: $link");
                }
            }
        } else {
            return $user_from_db;
        }
        
    }
}   
