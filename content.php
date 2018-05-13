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
    <title>文章详情</title>
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
<h1 style="margin-bottom: 20px">文章详情 <a href="article.php" style="font-size: 20px;color: white">博客列表</a></h1>
<?php
if (!isset($_SESSION["username"])){
    echo '<script> alert("请先登录！");  </script>';
    echo "<script language='javascript'>location=\"../index.php\"</script>";
}
$sqlFunction=new SqlFunction("JerryZheng_Blog");
    $userName=$_SESSION["username"];
$headerImage=".\\headerImage\\".$sqlFunction->doSelect("SELECT headImage FROM login WHERE userName='$userName'",1)[0][0];
$id=$_GET["id"];
$article = $sqlFunction->doSelect("SELECT * FROM article WHERE arID = '$id'",6);
$arID=$article[0][0];
$arTitle=$article[0][1];
$arClassifyID=$article[0][2];
$arAuthor=$article[0][3];
$arTime=$article[0][4];
$arContent=$article[0][5];
?>
<div class="loginUser" style="position: absolute;right: 30px;top: 30px">
    <p class="myName"><?php echo $userName ?></p>
    <img src="<?php echo $headerImage ?>" width="50px" height="50px"><br>
    <a href="action/exitUser.php">注销</a>&nbsp <a href="UploadeHeadImage.php">修改头像</a>
</div >
<div style="background-color: rgba(255,255,255,0.6);width: 50%;margin:5px auto;padding: 10px 50px;color: black">
    <p>文章<?php echo $arID." ".$arTitle." ".$arTime ?></p><br>
    <p>作者: <?php echo $arAuthor ?></p><br>
    <p><?php echo $arContent ?></p><br>
</div>

<?php
$list=$sqlFunction->doSelect("SELECT * FROM comment WHERE coArticleID='$arID'");
for ($i=0;$i<count($list);$i++){
    if ($list[0]!=null){
    ?>
<div style="background-color: rgba(255,255,255,0.6);width: 50%;margin:5px auto;padding: 10px 50px;color: black">
    <p><?php echo $list[$i][2]."： ".$list[$i][3] ?></p>
    <p><?php echo $list[$i][4] ?></p>
    <p style="margin-right: 0px;width: 100px">第<?php echo $i+1 ?>楼</p>
</div>
<?php
    }
}
?>
<form style="width: 100%" action="action/do_comment.php?id=<?php echo $id ?>" method="post">
    <input type="text" style="width: 54%;height: 50px" name="con"><br>
    <input type="submit" value="回复文章"  style="width: 100px;height: 30px;margin-right: -50%;margin-top: 10px">
</form>
<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/supersized.3.2.7.min.js"></script>
<script src="assets/js/supersized-init.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>