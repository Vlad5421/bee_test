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
        var_dumpe($user_from_db);
    }
}   
