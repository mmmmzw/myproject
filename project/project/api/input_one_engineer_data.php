<?php
	include('./conn.php');
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	//接受数据
	$_data[0]=$data['id'];
	$_data[1]=$data['name'];
	if($data['sex']=='男'){
		$_data[2]=1;
	}else{
		$_data[2]=0;
	}
	$_data[3]=$data['date1'];
	$_data[4]=$data['nativeplace'];
	$_data[5]=$data['education'];
	$_data[6]=$data['address'];
	$_data[7]=$data['phone'];
	$_data[8]=$data['workingyears'];
	$_data[9]=$data['base_salary'];
	$_data[10]=$data['workday'];
	$_data[11]=$data['monthly_benefit'];
	$_data[12]=$data['monthly_premium'];
	
	
	// print_r($_data) ;

	$sql="INSERT INTO Engineer_table(E_id,E_name,E_sex,E_birth,E_nativeplace,E_education,E_address,E_phone,E_workingyears,E_base_salary,E_workday,E_monthly_benefit,E_monthly_premium) VALUES
	('$_data[0]','$_data[1]',$_data[2],'$_data[3]','$_data[4]',$_data[5],'$_data[6]',$_data[7],$_data[8],$_data[9],$_data[10],$_data[11],$_data[12])";
	// echo $sql."<br/>";
	$sql = iconv("utf-8", "gbk", $sql);
	//删除数据库
	//$sql  =  "DROP DATABASE my firstdb" ;
	//查询第一部分代码
	// $sql  =  "select * from test" ;
	// $options  =  array(  "Scrollable"  =>  SQLSRV_CURSOR_KEYSET  );
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	if(  $stmt  ===  false  ) {
	     $arr=["errcode"=>1001,"msg"=>"添加失败(可能ID重复或工龄不在0~50年内)"];
	     echo json_encode($arr);
	}else{
		$arr=["errcode"=>0,"msg"=>"添加成功"];
		echo json_encode($arr);
	}
?>