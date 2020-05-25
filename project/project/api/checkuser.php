<?php
	session_start();
	if(!isset($_SESSION['user'])){
		echo 'alert("登陆已超时，请重新登录");location.href="login.html";';
	}

?>