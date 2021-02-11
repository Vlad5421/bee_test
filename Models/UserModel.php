<?php

class UserModel extends Model{

    public function get_user($user_login){
        $sql = "SELECT * FROM users WHERE user_login = '$user_login'";
        $statement = $this->pdo->query($sql)->fetch();
        return $statement;
    }

}
