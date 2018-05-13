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
    <title>登录我的博客</title>
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
if ( isset($_SESSION["isLogin"])&&$_SESSION["isLogin"]!=""){
    echo '<script> alert("'.$_SESSION["isLogin"].'");  </script>';
    if($_SESSION["isLogin"]=="登录成功"){
        echo "<script language='javascript'>location=\"../article.php\"</script>";
        $_SESSION["isLogin"]="";
    }
    $_SESSION["isLogin"]="";
}

?>

<div class="page-container">
    <h1>登录</h1>
    <form action="action/do_login.php" method="post">
        <input type="text" name="username" class="username" placeholder="您的用户名">
        <input type="password" name="password" class="password" placeholder="您的密码">
        <div class="verificationCodeDiv">
            <input type="text" name="verificationCode" class="verificationCode" placeholder="验证码" >
<!--            <img src="otherClass/VerificationCode.php " class="code">-->
            <img id="inChkCode" class="code" src="otherClass/VerificationCode.php " alt="点此刷新" style="cursor:pointer;" onclick='javascript:this.src="otherClass/VerificationCode.php?rnd="+Math.random();'>
        </div>
        <button type="submit">登录我的博客</button>
        <div class="error"><span>+</span></div>
    </form>
    <div class="connect">
        <div class="connectCd">
            <a href="register.php" class="register">注册新用户</a>
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
