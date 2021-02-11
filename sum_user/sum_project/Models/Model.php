<?php

class Model {
    protected $pdo;

    public function __construct(){
        $dsn = 'mysql:dbname=task_bee;host=127.0.0.1;charset=UTF8';
        $user = 'pma';
        $password = 'pmaPassword';
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $password, $opt);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }
}
