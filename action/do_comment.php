<?php
/**
 * Created by PhpStorm.
 * User: 黄旭钕
 * Date: 2018/1/7
 * Time: 15:02
 */
include "../otherClass/SqlFunction.php";
$sqlFunction=new SqlFunction("JerryZheng_Blog");
session_start();
$con = $_POST['con'];
if($con!=""){
    $id=$_GET['id'];
    $con = mb_substr($con,0,100);
    $con = strip_tags($con);
    $nc=$_SESSION["username"];
    $time =date('Y-m-d H:i:s');
    if ($id=="add"){
        $title = $_POST['title'];
        $title = mb_substr($title,0,100);
        $title = strip_tags($title);
        $result =$sqlFunction->doInsert("article","null,'$title' ,'0', '$nc','$time','$con'");
        if ($result==true){
            echo '<script> alert("添加成功"); location="../article.php" </script>';
        }else{
            echo '<script> alert("添加失败");  window.history.go(-1); </script>';
        }
    }
    else{
        $result =$sqlFunction->doInsert("comment","null,'$id' ,'$nc', '$time','$con'");
        if ($result==true){
            echo '<script> alert("回复成功"); location="../content.php?id='.$id.'" </script>';
        }else{
            echo '<script> alert("回复失败"); location="../content.php?id='.$id.'" </script>';
        }
    }

}else{
    echo '<script> alert("内容不能为空"); window.history.go(-1) </script>';
}