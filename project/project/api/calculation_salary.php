<?php
	include('./conn.php');
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="update Engineer_table set E_monthly_salary=((E_base_salary+10*E_monthly_benefit+E_workday*E_workingyears/100)*0.9-E_monthly_premium)";
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	$sql="select * from Engineer_table";
	$sql=iconv("utf-8", "gbk", $sql);
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	$users;
	$user;
	$i=0;

		while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
		{
			// E_id char(4) primary key,
			// E_name nvarchar(20) not null,
			// E_sex char(1) not null default('1'),
			// E_birth date,
			// E_nativeplace nvarchar(20) not null,
			// E_education char(1),
			// E_address nvarchar(30) not null,
			// E_phone char(15) not null,
			// E_workingyears int check(E_workingyears>0 and E_workingyears<=50), 
			// E_salary int
			$user["E_id"]=iconv("gbk", "utf-8", $row["E_id"]);
			$id=$user["E_id"];
			$user["E_name"]=iconv("gbk", "utf-8", $row["E_name"]);
			$user["E_sex"]=iconv("gbk", "utf-8", $row["E_sex"]);
			$user["E_workingyears"]=iconv("gbk", "utf-8", $row["E_workingyears"]);
			$user["E_base_salary"]=iconv("gbk", "utf-8", $row["E_base_salary"]);
			$user["E_monthly_benefit"]=iconv("gbk", "utf-8", $row["E_monthly_benefit"]);
			$user["E_monthly_premium"]=iconv("gbk", "utf-8", $row["E_monthly_premium"]);
			$user["E_workday"]=iconv("gbk", "utf-8", $row["E_workday"]);
			$user["E_monthly_salary"]=iconv("gbk", "utf-8", $row["E_monthly_salary"]);
			$users[$i++]=$user;
		}
		echo json_encode($users);
	//释放资源
	sqlsrv_free_stmt($stmt);
	//关闭连接
	sqlsrv_close($conn );

?>