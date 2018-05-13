<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/12/24
 * Time: 19:57
 */

?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="utf-8">
    <title>注册新用户</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/supersized.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<?php
session_start();
if ( isset($_SESSION["isRegister"])&&$_SESSION["isRegister"]!=""){
    echo $_SESSION["isRegister"];
    echo '<script> alert("'.$_SESSION["isRegister"].'");  </script>';
    if($_SESSION["isRegister"]=="注册成功"){
        echo "<script language='javascript'>location=\"UploadeHeadImage.php\"</script>";
    }
    $_SESSION["isRegister"]="";
}
?>

<div class="page-container">
    <h1 style="margin-top: -80px">注册新用户</h1>
    <form action="action/do_register.php" method="post">
        <input type="text" name="username" class="username" placeholder="您的用户名">
        <input type="password" name="password" class="password" placeholder="您的密码">
        <input type="password" name="rePassword" class="rePassword" placeholder="再次输入密码">
        <input type="text" name="email" class="email" placeholder="您的邮箱">
        <input type="text" name="tel" class="tel" placeholder="您的电话">
        <div class="verificationCodeDiv">
            <input type="text" name="verificationCode" class="verificationCode2" placeholder="验证码" >
            <img src="otherClass/VerificationCode.php " class="code">
        </div>
        <button type="submit">确认并提交信息</button>
        <div class="error"><span>+</span></div>
        <div class="error2" id="error2" style="width: 150px;right: -170px;padding-top: 10px;height: 30px"></div>
    </form>
    <div class="connect">
        <div class="connectCd">
            <a href="index.php" class="register">已拥有账户</a>
            <a href="" class="rememberPassword">忘记密码？</a>
        </div>

        <p>
            <a class="facebook" href=""></a>
            <a class="twitter" href=""></a>
        </p>
    </div>
</div>

<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/supersized.3.2.7.min.js"></script>
<script src="assets/js/supersized-init.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>
