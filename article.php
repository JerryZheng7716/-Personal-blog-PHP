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
    <title>文章列表</title>
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
<h1 style="margin-bottom: 20px">文章列表 <a href="addArticle.php" style="font-size: 20px;color: white">添加文章</a> <a href="weather.php" style="font-size: 20px;color: white">天气查询</a></h1>
<?php
if (!isset($_SESSION["username"])){
    echo '<script> alert("请先登录！");  </script>';
    echo "<script language='javascript'>location=\"../index.php\"</script>";
}
$sqlFunction=new SqlFunction("JerryZheng_Blog");
$userName=$_SESSION["username"];
$headerImage=".\\headerImage\\".$sqlFunction->doSelect("SELECT headImage FROM login WHERE userName='$userName'")[0][0];
?>
<div class="loginUser" style="position: absolute;right: 30px;top: 30px">
    <p class="myName"><?php echo $userName ?></p>
    <img src="<?php echo $headerImage ?>" width="50px" height="50px"><br>
    <a href="action/exitUser.php">注销</a>&nbsp <a href="UploadeHeadImage.php">修改头像</a>
</div>
<?php

$list=$sqlFunction->doSelect("SELECT * FROM article");
for ($i=0;$i<count($list);$i++){
    echo '<div style="background-color: rgba(255,255,255,0.6);width: 50%;margin:5px auto;padding: 10px 50px" >';
    echo '<form action="content.php?id='.$list[$i][0].'" method="post" style="width: 100%">';
    echo '<p style="color: black">文章'.$list[$i][0]. '&nbsp&nbsp'.$list[$i][1].' 文章作者：'.$list[$i][3].'</p>';
//    echo '&nbsp&nbsp';
//    echo '<p style="color: black"> 文章标题：'.$list[$i][1].' 文章作者：'.$list[$i][3].'</p>';
    echo '<br>';
    echo '<p style="color: black">'.$list[$i][5].'</p>';
    echo '<input type="submit" style="width: 150px;height: 30px;margin-right:-700px ;" value="查看详细内容">';
    echo '</form>';
    echo '</div>';
    echo '<br>';

}
?>

<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/supersized.3.2.7.min.js"></script>
<script src="assets/js/supersized-init.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>