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

<form method="post" action="">
    <t3>请输入您需要获得天气的城市</t3>
    <input type="text" name="city">
        <input type="submit" name="getValues" style="width: 120px;height: 30px">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/12/5
 * Time: 13:49
 */
//初始化
if (isset($_POST['getValues'])){
    $city = $_POST['city'];
    $arry=[
        'cityname'=>$city,
        'dtype'=>'',
        'format'=>'',
        'key'=>'1d667d5981d2be8f6029ac2a73fe14b7',
    ];
    $ch = curl_init();
//设置选项，包括URL
    $base_url='http://v.juhe.cn/weather/index';
    $url=$base_url.'?'.http_build_query($arry);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
//执行并获取HTML文档内容　　
    $output = curl_exec($ch);
//释放curl句柄　
    curl_close($ch);
    $res=json_decode($output);
    if($res->error_code==0){

        echo '<br><h2>当前'.$city.'天气预报</h2>';
        echo '<table align="center" border="white 3px " style="line-height:25px;" >';
        echo '<tr><th> 温度 </th><th> 风向 </th><th> 风力 </th><th> 湿度 </th><th> 更新时间 </th></tr>';
        echo '<tr>';
        echo '<td>'.$res->result->sk->temp.'</td>';
        echo '<td>'.$res->result->sk->wind_direction.'</td>';
        echo '<td>'.$res->result->sk->wind_strength.'</td>';
        echo '<td>'.$res->result->sk->humidity.'</td>';
        echo '<td>'.$res->result->sk->time.'</td>';
        echo '<tr>';
        echo '</table>';

        echo '<br><h2>今天天气情况</h2>';
        echo '<table  align="center" border="white 3px " style="line-height:25px">';
        echo '<tr><th> 今天气温 </th><th> 天气 </th><th> 人体感受 </th><th> 紫外线等级 </th><th> 旅游指数 </th><th> 运动指数 </th></tr>';
        echo '<tr>';
        echo '<td>'.$res->result->today->temperature.'</td>';
        echo '<td>'.$res->result->today->weather.'</td>';
        echo '<td>'.$res->result->today->dressing_index.'</td>';
        echo '<td>'.$res->result->today->uv_index.'</td>';
        echo '<td>'.$res->result->today->travel_index.'</td>';
        echo '<td>'.$res->result->today->exercise_index.'</td>';
        echo '<tr>';
        echo '</table>';

        echo '<br><h2>未来天气情况</h2>';
        echo '<table align="center" border="white 3px " style="line-height:25px">';
        echo '<tr><th> 气温 </th><th> 天气情况 </th><th> 风力 </th><th> 星期 </th><th> 日期 </th></tr>';
        foreach ($res->result->future as $r){
            echo '<tr>';
            echo '<td>'.$r->temperature.'</td>';
            echo '<td>'.$r->weather.'</td>';
            echo '<td>'.$r->wind.'</td>';
            echo '<td>'.$r->week.'</td>';
            echo '<td>'.$r->date.'</td>';
            echo '<tr>';
        }
        echo '</table>';

    }
}
//print_r($output);

?>
<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/supersized.3.2.7.min.js"></script>
<script src="assets/js/supersized-init.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>