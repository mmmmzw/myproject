<?php
	include('./conn.php');
	$sql="INSERT INTO Engineer_table(E_id,E_name,E_sex,E_birth,E_nativeplace,E_education,E_address,E_phone,E_workingyears,E_base_salary,E_workday,E_monthly_benefit,E_monthly_premium) VALUES
	('0101','张彩晨',0,'1999-11-2','浙江杭州',2,'A地',13500000000,27,2000,20,10000,300),
	('0102','赵日天',1,'1970-1-30','浙江杭州',2,'A地',13500000002,8,5000,21,10000,500),
	('0103','陈虎',0,'1970-5-2','浙江杭州',4,'B地',13500000001,42,100,28,10000,500),
	('0104','孙老六',1,'1988-5-1','浙江嘉兴',1,'C地',13500000005,7,1000,16,10000,300),
	('0105','黑猫警长',1,'1990-2-20','浙江杭州',3,'A地',13500000008,4,2500,18,10000,250),
	('0106','一只耳',1,'1978-8-10','浙江杭州',4,'A地',13500000009,18,7700,14,10000,330),
	('0107','机器猫',1,'1988-8-8','浙江杭州',1,'A地',13500000010,38,5000,21,10000,1000),
	('0108','大熊',1,'1988-6-6','浙江杭州',3,'A地',13500000011,21,6600,22,10000,1111),
	('0109','钱胖胖',1,'1977-7-7','浙江杭州',2,'A地',13500000012,45,6666,23,10000,800),
	('0110','李大观',1,'1999-9-9','浙江杭州',3,'A地',13500000022,30,8888,18,10000,888)";
	// echo $sql;
	$sql = iconv("utf-8", "gbk", $sql);
	$params  = array( 1 ,  "some data" );
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params );
	if($stmt){
		$arr=["errcode"=>0,"msg"=>"数据装载成功"];
		echo json_encode($arr);
	}else{
		$arr=["errcode"=>1010,"msg"=>"数据装载失败或有重复"];
		echo json_encode($arr);
	}
?>