<?php

namespace src\Models;
use src\Models\Connection;

class User
{
    /**
     * @var string|mixed
     */
    public string $username = '';
    /**
     * @var string|mixed
     */
    public string $email = '';
    public string $password = '';
    public string $password_confirm = '';
    public string $cv_url = '';

    /**
     * @param $data
     */
    public function __construct($data){
        $this->username = $data['username'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->password_confirm = $data['password_confirm'] ?? '';
        $this->cv_url = $data['cv_url'] ?? '';
    }

    /**
     * @return array|bool
     */
    public  function add():array|bool{
        $query = "INSERT into 
            users(username,email,password,password_confirm,cv_url)
            values (:username,:email,:password,:password_confirm,:cv_url)";
        return Connection::query($query,
            params: [
                ':username'=>$this->username,
                ':email'=>$this->email,
                ':password'=>$this->password,
                ':password_confirm'=>$this->password_confirm,
                ':cv_url'=>$this->cv_url,
            ]
        );

    }

    public static function getAll():array|bool{
        $query = "SELECT * from users";
        return Connection::query($query);
    }
}