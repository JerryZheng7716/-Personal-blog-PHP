<?php
/**
 * Created by PhpStorm.
 * User: 黄旭钕
 * Date: 2018/1/7
 * Time: 15:46
 */
session_start();
$_SESSION['username']=null;
echo '<script> alert("注销成功"); location="../index.php" </script>';