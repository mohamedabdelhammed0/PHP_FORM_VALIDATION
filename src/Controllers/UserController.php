<?php

namespace src\Controllers;
use src\Models\Validation\ValidateRegisterClass;
use src\Models\User;
class UserController
{
    public static function add():string{
        $result = ['status'=>'success'];
        ValidateRegisterClass::validate(
            [
                'username'=> 'required|min:3|max:16',
                'email' =>'required|email',
                'password' =>'required',
                'password_confirm'=>'required',
                'cv_url' =>'required|url'
            ]
        );
        if(!empty(ValidateRegisterClass::$errors)){
            $result['status']='error';
            $errors  = ValidateRegisterClass::$errors;
            $result['message'] = $errors;
        }else{
            $user = new User($_POST);
            $user->add();
        }
        return json_encode($result,JSON_PRETTY_PRINT);
    }

    public static function getAll():array{
        return User::getALL();
    }

}