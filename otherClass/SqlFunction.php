<?php
/**
 * Created by PhpStorm.
 * User: 74011
 * Date: 2017/12/19
 * Time: 14:48
 */

class SqlFunction
{
    var $link;
    public function __construct($dbName) {
        $this->link = mysqli_connect("localhost", "root", "");
        if (!$this->link) {
            echo "Connect failed: ", mysqli_connect_error();
            exit();
        }else{
            mysqli_select_db($this->link,$dbName);
            mysqli_set_charset($this->link, 'utf8');
        }
    }
    public function doSelect($sqLanguage) {//传入sq语句，和需要获取的列数
        $result = mysqli_query($this->link,$sqLanguage);
        $arry=array(array());
        $i=0;
        while($r = mysqli_fetch_array($result)){
            $arry[$i]=$r;//把结果集合保存到二维数组
            $i++;
        }
        return $arry;
    }

    public function doDelete($tbName,$where="") {
        $sqLanguage = "DELETE FROM  $tbName  where  $where";
        $result = mysqli_query($this->link,$sqLanguage);
        return $result;
    }

    public function doDeleteAll($tbName ) {
        $sqLanguage = "DELETE FROM  $tbName";
        $result = mysqli_query($this->link,$sqLanguage);
        $r = mysqli_fetch_assoc($result);
        return $r;
    }

    public function doInsert($tableName, $values) {
        $sqLanguage = "INSERT INTO $tableName VALUES ($values)";
        $result = mysqli_query($this->link,$sqLanguage);
        return $result;
    }

    public function doUpdate($tableName, $set,$where) {
        $sqLanguage = "UPDATE $tableName SET $set WHERE $where";
        $result = mysqli_query($this->link,$sqLanguage);
        return $result;
    }

    public  function closeLink(){
        mysqli_close($this->link);
    }

}