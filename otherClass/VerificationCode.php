<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/12/5
 * Time: 13:49
 */

session_start();
//A-Z 65-90
//a-z 97-122
//0-9 48-57
// 创建一个变量存储产生的验证码数据，便于用户提交核对
$captcha = "";
$x=-15;
$image = imagecreatetruecolor(200,80);
$blue = imagecolorallocate($image,rand(170,230),rand(170,230),rand(170,230));
imagefill($image,0,0,$blue);
$white = imagecolorallocate($image,255,255,255);
imagestring($image,1,0,0,"JerryZheng",$white);
$dir = dirname(__FILE__)."\\2.ttf";
imagettftext($image,28,0,0,50,$white,$dir,"JerryZheng");

for($i=0;$i<4;$i++){
    $angle=rand(0,30);
    $size=rand(40,60);
    $font="\\".rand(1,5).".ttf";
    $dir = dirname(__FILE__).$font;
    $x=$x+40;
    $ascii=rand(48,122);
    $color = imagecolorallocate($image,rand(0,150),rand(0,150),rand(0,150));

    if ($ascii>90&&$ascii<97){
        $ascii=$ascii+6;
    }
    if ($ascii>57&&$ascii<65){
        $ascii=$ascii+7;
    }
    $text=chr($ascii);
    $captcha.=$text;
    imagettftext($image,$size,$angle,$x,70,$color,$dir,$text);
    for($j=0;$j<3;$j++){
        $x1=rand(0,200);
        $y1=rand(0,80);
        $x2=rand(0,200);
        $y2=rand(0,80);
        $color1 = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
        imageline($image,$x1,$y1,$x2,$y2,$color1);
        imageellipse($image,$x1,$y1,30,30,$color1);
        imagefill($image,$x1+1,$y1+1,$color1);
    }
}
$_SESSION["captcha"] = $captcha;
header("Content-Type: image/png");
//imagettftext($image,20,130,180,180,$white,"msyh.ttc","郑健磊大帅逼");
imagepng($image);
?>