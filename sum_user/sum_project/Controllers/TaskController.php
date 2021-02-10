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
    public $get_local = null;
    protected $session_local = null;

    public function __construct(){
        if (isset($_POST) && !empty($_POST)) {
            $this->task_name = $_POST['task_name'];
            $this->task_email = $_POST['task_email'];
            $this->task_text = $_POST['task_text'];
        }
        $this->model = new TaskModel();
        if (isset($_POST) && !empty($_POST)) $this->post_local = $_POST;
        if (isset($_GET) && !empty($_GET)) $this->get_local = $_GET;
        session_start();
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
        $sort_field = (isset($this->session_local['sort_param']['field'])) ? $this->session_local['sort_param']['field'] : 'id';
        $sort = (isset($this->session_local['sort_param']['sort'])) ? $this->session_local['sort_param']['sort'] : 'DESC';
        $list_page = (isset($this->session_local['sort_param']['list_page'])) ? $this->session_local['sort_param']['list_page'] : 1;
        
        $geted_list = $this->model->get_task_list($sort_field, $sort, $list_page);

        $new_list = [];
        while ($row = $geted_list['tasks']->fetch()){
            $item_new_list = [];
            foreach ($this->task_list as $key => $value) {
                $item_new_list[$key] = $row[$value];
            }
            $new_list[] = $item_new_list;
        }

        $page = (($geted_list['count'] % 3) != 0) ? intdiv($geted_list['count'], 3) + 1 : $geted_list['count'] % 3;
        return [$new_list, $page];
    }
}
