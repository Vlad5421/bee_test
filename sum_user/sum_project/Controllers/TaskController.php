<?php

class TaskController {

    public $task_id;
    public $task_name;
    public $task_email;
    public $task_text;
    public $change_date;
    public $create_date;
    public $performed;
    protected $task_list = [
        "id" => "id",
        "Имя" => "task_name",
        "Эл. адрес" => "task_email",
        "Задача" => "task_text",
        "Выполненно" => "performed",
        "Изменено" => "change_date",
    ];
    protected $model;
    protected $post_local = null;
    protected $get_local = null;
    protected $session_local = null;

    public function __construct(){
        if (!empty($_POST)) {
            if(!empty($_POST['task_name'])) $this->task_name = $_POST['task_name'];
            if(!empty($_POST['task_email'])) $this->task_email = $_POST['task_email'];
            if(!empty($_POST['task_text'])) $this->task_text = $_POST['task_text'];
        }
        $this->model = new TaskModel();
        if (!empty($_POST)) $this->post_local = $_POST;
        if (isset($_GET) && !empty($_GET)) $this->get_local = $_GET;
        session_start();
        $this->session_local = $_SESSION;
    }

    public function create_task(){
        return $this->model->create_task($this->task_name, $this->task_email, $this->task_text);
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
            if ($row['change_date'] == $row['create_date']) $row['change_date'] = '';
            else $row['change_date'] = 'Изменено администратором: '. $row['change_date'];
            $row['performed'] = ($row['performed'] != 0) ? 'Выполненно' : '';

            foreach ($this->task_list as $key => $value) {
                $item_new_list[$key] = $row[$value];
            }
            $new_list[] = $item_new_list;
        }
        $page = (($geted_list['count'] % 3) !== 0) ? intdiv($geted_list['count'], 3) + 1 : $geted_list['count'] / 3;
        return [$new_list, $page];
    }

    public function get_task(){
        if (isset($_SESSION['changed_task_id'])) {
            $this->task_id = $_SESSION['changed_task_id'];
            $task = $this->model->get_task($this->task_id);
            $this->task_name = $task['task_name'];
            $this->task_email = $task['task_email'];
            $this->task_text = $task['task_text'];
            $this->change_date = $task['change_date'];
            $this->create_date = $task['create_date'];
            $this->performed = $task['performed'];
        } else {
            $link = 'task_list';
            header("Location: $link");
            return;
        }
        
    }

    public function change_task(){
        $this->task_id = $_SESSION['changed_task_id'];
        $new_text = $_POST['task_text'];
        $change_date = date("Y-m-d H:i:s");
        $change = false;
        $performance = false;
        if (isset($_POST['performed']) && $_POST['performed'] == 'on' && $this->performed == 0) {
            $performance = $this->model->set_task_performed($this->task_id, 'on');
        } elseif (!isset($_POST['performed']) && $this->performed == 1) {
            $performance = $this->model->set_task_performed($this->task_id, 'off');
        }
        if ($this->task_text !== $new_text) {
            $change = $this->model->change_task_text($this->task_id, $new_text, $change_date);
        }
        if ($change) unset($_SESSION['changed_task_id']);
        return [$change, $performance];
    }
}
