<?php
	include('./conn.php');
	$sql="CREATE TABLE Engineer_table
(
E_id varchar(4) primary key,
E_name nvarchar(20) not null,
E_sex char(1) not null default('1'),
E_birth date,
E_nativeplace nvarchar(20) not null,
E_education char(1),
E_address nvarchar(30) not null,
E_phone varchar(15) not null,
E_workingyears int check(E_workingyears>0 and E_workingyears<=50), 
E_base_salary int,
E_monthly_benefit int,
E_workday int,
E_monthly_premium int,
E_monthly_salary int
)";
	$params  = array( 1 ,  "some data" );
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params );
	if($stmt){
		$arr=["errcode"=>0,"msg"=>"数据表创建成功"];
		echo json_encode($arr);
	}else{
		$arr=["errcode"=>1009,"msg"=>"数据表创建失败或已存在"];
		echo json_encode($arr);
	}
?>