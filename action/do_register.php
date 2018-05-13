<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/12/25
 * Time: 14:44
 */
header("Content-type: text/html; charset=utf-8");
include "../otherClass/SqlFunction.php";
$sqlFunction = new SqlFunction("JerryZheng_Blog");
//$username = '方法都是';
//$password = $email = $phone = '111';
//$sqlFunction->doInsert("login","'".$username."','".$password."',"."'defaultHead.jpg','".$email."','".$phone."'");
//
//die;
//
include "../otherClass/CheckingInformation.php";
$sqlFunction = new SqlFunction("JerryZheng_Blog");
$username = $_POST['username'];
$password = $_POST['password'];
$rePassword = $_POST['rePassword'];
$email = $_POST['email'];
$phone = $_POST['tel'];
$verificationCode = $_POST['verificationCode'];
$cheak = new CheckingInformation();
session_start(); //启动Session 的初始化
$_SESSION["isRegister"]="这222";
if($password==""&&$username==""&&$email==""&&$phone==""&&$verificationCode==""&&$rePassword==""){
    $_SESSION["isRegister"]="所有内容均不可以为空";
    echo "<script language='javascript'>location=\"../register.php\";</script>";
}else if ($password!=$rePassword){
    $_SESSION["isRegister"]="两次密码不相同";
    echo "<script language='javascript'>location=\"../register.php\";</script>";
}else if (!$cheak->isEmail($email)){
    $_SESSION["isRegister"]="这不是一个有效的邮箱";
    echo "<script language='javascript'>location=\"../register.php\";</script>";
}else if (!$cheak->isPhoneNum($phone)){
    $_SESSION["isRegister"]="这不是一个有效的电话号码".$phone;
    echo "<script language='javascript'>location=\"../register.php\";</script>";
}else if (($sqlFunction->doSelect("SELECT * FROM login WHERE username = '$username'"))[0]!=null){
    $_SESSION["isRegister"]="已经存在当前用户名";
    echo "<script language='javascript'>location=\"../register.php\";</script>";
}

else if($password!=""&&$username!=""){//登陆界面已经限制不为空，这个可以省略。
    if (strcasecmp($_SESSION["captcha"],$verificationCode)==0 ){
        $login=$sqlFunction->doInsert("login","'".$username."','".$password."',"."'defaultHead.jpg','".$email."','".$phone."'");
        if ($login){
            echo '注册成功';
            $_SESSION["username"] = $username;
            $_SESSION["isRegister"]="注册成功";
            echo '<script> alert("注册成功");  </script>';
            echo "<script language='javascript'>location=\"../UploadeHeadImage.php\";</script>";
        }else{
            $_SESSION["isRegister"]="注册失败";
            echo "<script language='javascript'>location=\"../register.php\";</script>";
        }
    }else{
        $_SESSION["isRegister"]="验证码错误";
        echo "<script language='javascript'>location=\"../register.php\"</script>";
    }

}
?>

