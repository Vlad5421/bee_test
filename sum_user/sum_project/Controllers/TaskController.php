<?php


class TaskController {

    public $task_name;
    public $task_email;
    public $task_text;
    protected $task_list = [
        "id" => "id",
        "Имя" => "task_name",
        "Эл. адрес" => "task_email",
        "Содержание" => "task_text",
    ];
    protected $model;
    protected $post_local = null;
    protected $get_local = null;
    protected $session_local = null;

    public function __construct(){
        if (isset($_POST) && !empty($_POST)) {
            $this->task_name = $_POST['task_name'];
            $this->task_email = $_POST['task_email'];
            $this->task_text = $_POST['task_text'];
        }
        $this->model = new TaskModel();
        if (isset($_POST) && !emty($_POST)) $post_local = $_POST;
        if (isset($_GET) && !emty($_GET)) $get_local = $_GET;
        session_start();
        if ($this->get_local != NULL && isset($this->get_local['sort_by']) && !empty($this->get_local['sort_by'])){
            $_SESSION['sort_param']['field'] = $this->get_local['sort_by'];
            $_SESSION['sort_param']['sort'] = ($_SESSION['sort_param']['sort'] == 'DESK') ? 'ASC' : 'DESC';
        }
        $this->session_local = $_SESSION;

    }

    public function create_task(){
        $this->model->create_task($this->task_name, $this->task_email, $this->task_text);
    }

    public function change_task_text(){
        $this->model->change_task_text($task_text);
    }

    public function get_task_list()
    {
        $sort_fields = $this->session_local['sort_param']['field'];
        $sort = $this->session_local['sort_param']['sort'];
        $geted_list = $this->model->get_task_list($sort_fields, $sort);
        $new_list = [];
        while ($row = $geted_list->fetch()){
            $item_new_list = [];
            foreach ($this->task_list as $key => $value) {
                $item_new_list[$key] = $row[$value];
            }
            $new_list[] = $item_new_list;
        }
        return $new_list;
    }
}
