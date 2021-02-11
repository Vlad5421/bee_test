<?php

class UserModel extends Model{

    public function get_user_pass($user_email){
        $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
        $statement = $this->pdo->query($sql)->fetch();


        return $statement;
    }

}