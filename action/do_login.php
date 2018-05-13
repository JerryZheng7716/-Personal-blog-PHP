<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/11/7
 * Time: 14:44
 */
include "../otherClass/SqlFunction.php";
$sqlFunction = new SqlFunction("JerryZheng_Blog");
$username = $_POST['username'];
$password = $_POST['password'];
$verificationCode = $_POST['verificationCode'];
session_start(); //启动Session 的初始化
if(isset($_POST['exit'])){
    session_destroy();
    unset($_SESSION['username']);
    setCookie(session_name(), "" , time()-1000);
    echo '成功注销';
}else{
    if($password!=""&&$username!=""){//登陆界面已经限制不为空，这个可以省略。
        $sql = "SELECT * FROM login WHERE userName='".$username."' AND passWord='".$password."';";
        $login=$sqlFunction->doSelect($sql,1);
        if (strcasecmp($_SESSION["captcha"],$verificationCode)==0){
            if ($login[0][0]!=null){
                $_SESSION["isLogin"]="登录成功";
                $_SESSION["username"] = $username;
                echo "<script language='javascript'>location=\"../index.php\"</script>";
            }else{
                $_SESSION["isLogin"]="登录失败,密码或用户名错误";
                echo "<script language='javascript'>location=\"../index.php\"</script>";
            }
        }else{
            $_SESSION["isLogin"]="验证码错误";
            echo "<script language='javascript'>location=\"../index.php\"</script>";
        }

    }
}
?>
