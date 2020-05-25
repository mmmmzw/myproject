<?php
header("Content-type:text/html;charset=utf-8");
$serverName = "DESKTOP-MKGG5SK"; //数据库服务器地址
$uid = "sa";   //数据库用户名
$pwd = "123456"; //数据库密码
$dbname="Engineer_db";
$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>$dbname);
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>