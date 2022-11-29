<?php

namespace src\Models\Validation;
interface ValidateRegisterInterface
{
    public static function required($attribute);
    public static function min($attribute,$mnNum);
    public static function max($attribute,$mxNum);
    public static function email($email);
    public static function url($url);
    public static function confirmed($pass,$pass_confirm);
}