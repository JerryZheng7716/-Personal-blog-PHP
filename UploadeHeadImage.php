<?php
/**
 * Created by PhpStorm.
 * User: 黄旭钕
 * Date: 2017/12/31
 * Time: 23:01
 */
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="utf-8">
    <title>上传您的头像</title>
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
<h1>上传您的头像 <a href="index.php" style="font-size: 20px;color: white">跳过</a></h1>
<?php

function thumb($filename){
    list($width_orig,$height_orig) = getimagesize($filename);
    //根据参数$width和$height值，换算出等比例缩放的高度和宽度

    //将原图缩放到这个新创建的图片资源中
    $image_p = imagecreatetruecolor(100, 100);
    //获取原图的图像资源
    $image = imagecreatefromjpeg($filename);

    //使用imagecopyresampled()函数进行缩放设置
    imagecopyresampled($image_p,$image,0,0,0,0,100,100,$width_orig,$height_orig);
    //将缩放后的图片$image_p保存，100(质量最佳，文件最大)
    imagejpeg($image_p,$filename);
    imagedestroy($image_p);
    imagedestroy($image);
}


$to_dir="./headerImage/";
$new_fileName=null;
$alllowFileTypeImage = array('image/gif','image/png','image/jpeg');
if (isset($_POST['upload'])){
    if ($_FILES["userFile"]["error"]==0){
        if (is_uploaded_file($_FILES["userFile"]["tmp_name"])){
            if (in_array($_FILES["userFile"]["type"],$alllowFileTypeImage)){
                $fileName=$_FILES["userFile"]["name"];
                echo $fileName." "." ";
                $pos = strrpos($fileName,'.',0);
                $t = substr($fileName,$pos);
                $new_fileName=time().rand(100,999).$t;
                thumb($_FILES["userFile"]["tmp_name"],100,100);
//                imagecopyresampled($_FILES["userFile"]["tmp_name"],$_FILES["userFile"]["tmp_name"], 0, 0, 7, 174, 120, 42, 100, 100);
                if (move_uploaded_file($_FILES["userFile"]["tmp_name"],$to_dir.$new_fileName)){

                    echo "上传成功";
                    echo "<br>";
                }else{
                    echo "移动文件失败";
                }
            }
            else{
                echo "亲亲，只能上传这些格式哦，gif, png, jpg";
                echo "<br>";
            }

        }

    }else if( $_FILES["userFile"]["error"]==2){
        echo "上传失败,文件超过6M";
        echo "<br>";
    }
    else if( $_FILES["userFile"]["error"]==3){
        echo "上传失败,文件只被部分上载";
        echo "<br>";
    }
    else if( $_FILES["userFile"]["error"]==4){
        echo "上传失败,没有上载任何文件";
        echo "<br>";
    }
}

//先判断指定的路径是不是一个文件夹
if ($new_fileName!=null){
    echo '<br>';
    echo '<img src="'.$to_dir.$new_fileName.'" width="50px"/> ';
    session_start(); //启动Session 的初始化
    $_SESSION["headerImage"]=$new_fileName;
    echo '<form action="action/do_headerImage.php" method="post">';
    echo '<input type="submit" value="确定上传" name="yesDo">';
}
?>

<form enctype="multipart/form-data" action=" " method="post">
    <!--    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>-->
    <!--    上传文件：-->
    <!--    <input type="file" name="userFile" style="text-align:center;vertical-align:middle"/>-->
    <!--    <input type="submit" value="上传文件" name="upload">-->

    <input type="text" size="20" name="upfile" id="upfile" style="border:1px dotted #ccc">
    <input type="button" value="浏览" onclick="path.click()" style="solid #000">
    <input type="file" id="path" style="display:none" onchange="upfile.value=this.value" name="userFile">
    <input type="submit" value="上传头像" name="upload">
</form>


<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/supersized.3.2.7.min.js"></script>
<script src="assets/js/supersized-init.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>

