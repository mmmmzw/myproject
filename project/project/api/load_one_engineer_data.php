<?php
	include('./conn.php');
	session_start();
	@$sql = $_SESSION['sql'];
	// echo $sql;
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	
	while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
		$user["E_id"]=iconv("gbk", "utf-8", $row["E_id"]);
		$user["E_name"]=iconv("gbk", "utf-8", $row["E_name"]);
		$user["E_sex"]=iconv("gbk", "utf-8", $row["E_sex"]);
		$user["E_birth"]= $row["E_birth"];
		$user["E_nativeplace"]=iconv("gbk", "utf-8", $row["E_nativeplace"]);
		$user["E_education"]=iconv("gbk", "utf-8", $row["E_education"]);
		$user["E_address"]=iconv("gbk", "utf-8", $row["E_address"]);
		$user["E_phone"]=iconv("gbk", "utf-8", $row["E_phone"]);
		$user["E_workingyears"]=iconv("gbk", "utf-8", $row["E_workingyears"]);
		$user["E_base_salary"]=iconv("gbk", "utf-8", $row["E_base_salary"]);
		$user["E_monthly_premium"]=iconv("gbk", "utf-8", $row["E_monthly_premium"]);
		$user["E_monthly_benefit"]=iconv("gbk", "utf-8", $row["E_monthly_benefit"]);
		$user["E_workday"]=iconv("gbk", "utf-8", $row["E_workday"]);
		
	}
	
	// print_r($user);
	echo json_encode($user);
	//关闭连接
	sqlsrv_close($conn);

?>