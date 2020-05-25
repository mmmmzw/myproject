<?php
	session_start();
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	//接受数据
	$username = $data['username'];
	$password = $data['password'];
	if($username=='admin'&&$password=='123456') {
		$_SESSION['user']=$username;
		$_SESSION['pwd']=$password;
	    $arr=["errcode"=>0,"msg"=>"登录成功"];
	    echo json_encode($arr);
	}else{
		$arr=["errcode"=>1011,"msg"=>"帐号或密码错误"];
		echo json_encode($arr);
	}
?>