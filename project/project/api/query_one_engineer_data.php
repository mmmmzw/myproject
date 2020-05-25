<?php
	include('./conn.php');
	session_start();
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	$information = $data['information'];
	$category = $data['category'];
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	if($category==0){
		$sql="select * from Engineer_table where E_id='$information'";
		
	}else{
		$sql="select * from Engineer_table where E_name='$information'";
	}
	$sql=iconv("utf-8", "gbk", $sql);
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	if(  sqlsrv_num_rows($stmt)==0  ) {
	    $arr=["errcode"=>1004,"msg"=>"未查询到该工程师"];
	    echo json_encode($arr);
	}else{
		$_SESSION['information']=$information;
		$_SESSION['category']=$category;
		$_SESSION['sql']=$sql;
		$arr=["errcode"=>0,"msg"=>"查找成功"];
		echo json_encode($arr);
	}
	//释放资源
	sqlsrv_free_stmt($stmt);
	//关闭连接
	sqlsrv_close($conn );

?>