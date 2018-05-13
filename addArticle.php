<?php
/**
 * Created by PhpStorm.
 * User: 黄旭钕
 * Date: 2018/1/2
 * Time: 15:28
 */
session_start();
include "./otherClass/SqlFunction.php";
?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="utf-8">
    <title>添加文章</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/supersized.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<br>
<br>
<h1 style="margin-bottom: 20px">添加文章 <a href="article.php" style="font-size: 20px;color: white">博客列表</a></h1>
<?php
if (!isset($_SESSION["username"])){
    echo '<script> alert("请先登录！");  </script>';
    echo "<script language='javascript'>location=\"../index.php\"</script>";
}
$sqlFunction=new SqlFunction("JerryZheng_Blog");
$userName=$_SESSION["username"];
$headerImage=".\\headerImage\\".$sqlFunction->doSelect("SELECT headImage FROM login WHERE userName='$userName'",1)[0][0];

?>
<div class="loginUser" style="position: absolute;right: 30px;top: 30px">
    <p class="myName"><?php echo $userName ?></p>
    <img src="<?php echo $headerImage ?>" width="50px" height="50px"><br>
    <a href="action/exitUser.php">注销</a>&nbsp <a href="UploadeHeadImage.php">修改头像</a>
</div >

<form style="width: 100%" action="action/do_comment.php?id=add" method="post">
    文章标题：<input type="text" style="width: 30%;height: 50px" name="title"><br>
<!--    文章内容：<input type="text" style="width: 54%;height: 50px" name="con"><br>-->
    <textarea name="con" rows="15" cols="65" style="margin-left: 80px;margin-top: 50px"></textarea><br>
    <input type="submit" value="添加文章"  style="width: 100px;height: 30px;margin-right: -30%;margin-top: 10px">
</form>
<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/supersized.3.2.7.min.js"></script>
<script src="assets/js/supersized-init.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>