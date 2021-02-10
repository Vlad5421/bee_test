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

    public function __construct(){
        if (isset($_POST) && !empty($_POST)) {
            $this->task_name = $_POST['task_name'];
            $this->task_email = $_POST['task_email'];
            $this->task_text = $_POST['task_text'];
        }
        
        $this->model = new TaskModel();
        
    }

    public function create_task(){
        $this->model->create_task($this->task_name, $this->task_email, $this->task_text);
    }

    public function change_task_text(){
        $this->model->change_task_text($task_text);
    }

    public function get_task_list()
    {
        $geted_list = $this->model->get_task_list();
        $new_list = [];
        while ($row = $geted_list->fetch( )){
            $item_new_list = [];
            foreach ($this->task_list as $key => $value) {
                $item_new_list[$key] = $row[$value];
            }
            $new_list[] = $item_new_list;
        }
        return $new_list;
    }
}
