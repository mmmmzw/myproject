<?php
	include('./conn.php');
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	//接受数据
	$information = $data['information'];
	$category = $data['category'];
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	// @$information=$_POST['information'];
	// @$category=$_POST['category'];
	if($category==0){
		$sql="select * from Engineer_table where E_id='$information'";
		$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
		if(  sqlsrv_num_rows($stmt)==0  ) {
		    $arr=["errcode"=>1002,"msg"=>"无对象可删除"];
		    echo json_encode($arr);
			exit();
		}else{
			$sql2="DELETE FROM Engineer_table WHERE E_id='$information'";			
		}
	}else{
		$sql="select * from Engineer_table where E_name='$information'";
		$sql = iconv("utf-8", "gbk", $sql);
		$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
		if(  sqlsrv_num_rows($stmt)==0  ) {
		    $arr=["errcode"=>1002,"msg"=>"无对象可删除"];
		    echo json_encode($arr);
			exit();
		}else{
			$sql2="DELETE FROM Engineer_table WHERE E_name='$information'";			
		}
		
	}
	
	@$sql3 = iconv("utf-8", "gbk", $sql2);
	$stmt  =  sqlsrv_query (  $conn ,  $sql3 ,  $params );
	if($stmt) {
	    $arr=["errcode"=>0,"msg"=>"删除成功"];
	    echo json_encode($arr);
	}else{
		$arr=["errcode"=>1003,"msg"=>"删除失败"];
		echo json_encode($arr);
	}
?>