<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/12/26
 * Time: 15:45
 */

class CheckingInformation
{
    /**
     * @param $email
     * @return bool
     */
    public function isEmail($email){
        if (preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$email)){
            return true;
        }
        else{
            return false;
        }
    }

    public function isPhoneNum($phone){
        if (preg_match("/^1[34578]\d{9}$/",$phone)){
            return true;
        }
        else{
            return false;
        }
    }



}