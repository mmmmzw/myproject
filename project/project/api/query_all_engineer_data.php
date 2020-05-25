<?php
	include('./conn.php');
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select E_id,E_name,E_sex,E_birth,E_nativeplace,E_education,E_address,E_phone,E_workingyears from Engineer_table";
	$sql=iconv("utf-8", "gbk", $sql);
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	$users;
	$user;
	$i=0;
	if(  sqlsrv_num_rows($stmt)==0  ) {
	    $arr=["errcode"=>1006,"msg"=>"无信息"];
	    echo json_encode($arr);
	}else{
		while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
		{
			$user["E_id"]=iconv("gbk", "utf-8", $row["E_id"]);
			$user["E_name"]=iconv("gbk", "utf-8", $row["E_name"]);
			$user["E_sex"]=iconv("gbk", "utf-8", $row["E_sex"]);
			$user["E_birth"]= $row["E_birth"];
			// print_r( $user["E_birth"]);
			$user["E_nativeplace"]=iconv("gbk", "utf-8", $row["E_nativeplace"]);
			$user["E_education"]=iconv("gbk", "utf-8", $row["E_education"]);
			$user["E_address"]=iconv("gbk", "utf-8", $row["E_address"]);
			$user["E_phone"]=iconv("gbk", "utf-8", $row["E_phone"]);
			$user["E_workingyears"]=iconv("gbk", "utf-8", $row["E_workingyears"]);
			// $user["E_salary"]=iconv("gbk", "utf-8", $row["E_salary"]);
			$users[$i++]=$user;
		}
		
		// $arr=["errcode"=>0,"msg"=>"查找成功"];
		echo json_encode($users);
	}
	//释放资源
	sqlsrv_free_stmt($stmt);
	//关闭连接
	sqlsrv_close($conn );

?>