<?php

class UserController {
    public $user_login;
    public $user_password;
    protected $model;

    public function __construct(){
        if (isset($_POST['user_login']) && !empty($_POST['user_login'])) {
            $this->user_login = $_POST['user_login'];
            $this->user_password = md5($_POST['user_password']);
        }
        $this->model = new UserModel();
    }

    public function user_auth(){
        $user_from_db = $this->model->get_user($this->user_login);
        if ($user_from_db == !false) {
            if ($this->user_password != $user_from_db['user_password']) return false;
            else {
                session_start();
                $_SESSION['user'] = $user_from_db;
                if (isset($_SESSION['changed_task_id']) && !empty($_SESSION['changed_task_id'])){
                    $task_id = $_SESSION['changed_task_id'];
                    $link = "change_task_ctl?id=$task_id";
                    header("Location: $link");
                    return;
                } else {
                    $link = 'task_list';
                    header("Location: $link");
                    return;
                }
            }
        } else {
            return $user_from_db;
        }
    }

    public function check_status(){
        $role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : 'guest';
        return $role;
    }
}   
