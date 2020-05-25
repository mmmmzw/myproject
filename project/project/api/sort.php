<?php
	include('./conn.php');
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	$sort = $data['sort'];
	$order = $data['order'];
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select * from Engineer_table order by $sort $order";
	// echo $sql
	$sql=iconv("utf-8", "gbk", $sql);
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	$users;
	$user;
	$i=0;

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
			$user["E_base_salary"]=iconv("gbk", "utf-8", $row["E_base_salary"]);
			$user["E_workday"]=iconv("gbk", "utf-8", $row["E_workday"]);
			$user["E_monthly_benefit"]=iconv("gbk", "utf-8", $row["E_monthly_benefit"]);
			$user["E_monthly_premium"]=iconv("gbk", "utf-8", $row["E_monthly_premium"]);
			$user["E_monthly_salary"]=iconv("gbk", "utf-8", $row["E_monthly_salary"]);
			$users[$i++]=$user;
		}
		echo json_encode($users);
	//释放资源
	sqlsrv_free_stmt($stmt);
	//关闭连接
	sqlsrv_close($conn );

?>