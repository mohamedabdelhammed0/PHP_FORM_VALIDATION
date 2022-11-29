<?php

namespace src\Models\Validation;

class ValidateRegisterClass implements ValidateRegisterInterface
{
    /**
     * @var array
     */
    public static array $errors;

    /**
     * @param $attribute
     * @return bool
     */
    public static   function required($attribute):bool
    {
        if(empty($_POST[$attribute]))
        {
            self::$errors[$attribute] = "$attribute is required";
            return false;
        }
        return true;
    }

    /**
     * @param $attribute
     * @param $num
     * @return bool
     */
    public static function min($attribute,$mnNum):bool
    {
        if(strlen($_POST[$attribute]) < $mnNum)
        {
            self::$errors[$attribute] = "$attribute length should be greater than $mnNum";
            return false;
        }
        return true;

    }

    /**
     * @param $attribute
     * @param $num
     * @return bool
     */
    public static function max($attribute,$mxNum):bool
    {
        $a =  strlen($_POST[$attribute]) > $mxNum;
        echo $a;
        if(strlen($_POST[$attribute]) > $mxNum)
        {
            self::$errors[$attribute] = "$attribute length should be less than $mxNum";
            return false;
        }
        return true;

    }

    /**
     * @param $email
     * @return bool
     */
    public static function email($email):bool
    {
        if(empty($_POST[$email])){
            self::$errors[$email] = "$email is required";
            return false;
        }
        if(!filter_var($_POST[$email],FILTER_VALIDATE_EMAIL))
        {
            self::$errors[$email] = "$email should be valid email";
            return false;
        }
        return true;

    }

    /**
     * @param $url
     * @return bool
     */
    public static function url($url):bool
    {
        if(empty($_POST[$url])){
            self::$errors[$url] = "$url is required";
            return false;
        }
        else if(!filter_var($_POST[$url],FILTER_VALIDATE_URL))
        {
            self::$errors[$url] = "$url should be valid URL";
            return false;
        }
        return true;
    }

    /**
     * @param $pass
     * @param $pass_confirm
     * @return bool
     */
    public static function confirmed($pass, $pass_confirm):bool
    {
        if(self::required($pass) && self::required($pass_confirm) && !strcmp($pass,$pass_confirm))
        {
            self::$errors[$pass] = "The two passwords entered do not match. Please try again";
            return false;
        }
        return true;

    }

    /**
     * @param $attributes
     * @return bool
     */
    public static function validate($attributes):void
    {
        foreach ($attributes as $attributeName => $attributeMethods)
        {

            $attributeMethods = explode('|',$attributeMethods);
            foreach($attributeMethods as  $attributeMethod){

                if(str_contains($attributeMethod,':'))
                {

                    $attributeMethod = explode(':',$attributeMethod);
                    $value = $attributeMethod[1];
                    $attributeMethod = $attributeMethod[0];
//                    echo "$attributeMethod($attributeName,$value)". "<br>";
//                    echo "<br>enter 1</br>";
                    self::$attributeMethod($attributeName,$value);
//                    echo "<br>done 1</br>";
                }
                else{
//                    echo "<br>enter</br>";
//                    echo "$attributeMethod($attributeName) " . "<br>";
                    self::$attributeMethod($attributeName);
//                    echo "<br>done<br><br>";
                }
            }

        }

    }


}