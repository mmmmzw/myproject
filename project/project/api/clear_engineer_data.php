<?php
	include('./conn.php');
	$sql="TRUNCATE TABLE Engineer_table";
	$params  = array( 1 ,  "some data" );
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params );
	if(  $stmt  ===  false  ) {
	     $arr=["errcode"=>1007,"msg"=>"清空失败"];
	     echo json_encode($arr);
	}else{
		$arr=["errcode"=>0,"msg"=>"清空成功"];
		echo json_encode($arr);
	}
?>