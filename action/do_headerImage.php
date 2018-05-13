<?php
/**
 * Created by PhpStorm.
 * User: 黄旭钕
 * Date: 2018/1/2
 * Time: 15:00
 */

include "../otherClass/SqlFunction.php";
session_start(); //启动Session 的初始化
$headerImage=$_SESSION["headerImage"];
$userName=$_SESSION["username"];
$sqlFunction=new SqlFunction("JerryZheng_Blog");
if($sqlFunction->doUpdate("login","headImage = '$headerImage'","userName='$userName'")){
    echo '<script> alert("头像上传成功！请登录！");  </script>';
    echo "<script language='javascript'>location=\"../index.php\"</script>";
}

