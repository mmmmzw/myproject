<?php
include('./conn.php');
if($conn){
	$arr=["errcode"=>0,"msg"=>"连接成功"];
	echo json_encode($arr);
}else{
	$arr=["errcode"=>1008,"msg"=>"数据库连接失败"];
	echo json_encode($arr);
}
?>