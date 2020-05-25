<?php
	include('./conn.php');
	session_start();
	@$category=$_SESSION['category'];
	@$imformation=$_SESSION['information'];
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	//接受数据
	$id = $data['id'];
	$name = $data['name'];
	// $sex = $data['sex'];
	if($data['sex']=='男'){
		$sex='1';
	}else{
		$sex='0';
	}
	$nativeplace = $data['nativeplace'];
	// $education = $data['education'];
	if($data['education']=='高中'){
		$education='0';
	}else if($data['education']=='学士'){
		$education='1';
	}else if($data['education']=='硕士'){
		$education='2';
	}else if($data['education']=='博士'){
		$education='3';
	}else{	
		$education='4';
	}
	$address = $data['address'];
	$phone = $data['phone'];
	$workingyears = $data['workingyears'];
	$salary = $data['salary'];
	$birth = $data['birth'];
	$E_workday = $data['E_workday'];
	$E_monthly_benefit = $data['E_monthly_benefit'];
	$E_monthly_premium = $data['E_monthly_premium'];
	if($category==0){
		$sql="  UPDATE Engineer_table SET E_id='$id',E_name='$name',E_sex='$sex',E_birth='$birth',E_nativeplace='$nativeplace',E_education='$education',
		E_address='$address',E_phone='$phone',E_workingyears='$workingyears',E_base_salary='$salary',E_workday=$E_workday,E_monthly_benefit=$E_monthly_benefit,E_monthly_premium=$E_monthly_premium where E_id='$imformation'";
		
	}else{
		$sql="  UPDATE Engineer_table SET E_id='$id',E_name='$name',E_sex='$sex',E_birth='$birth',E_nativeplace='$nativeplace',E_education='$education',
		E_address='$address',E_phone='$phone',E_workingyears='$workingyears',E_base_salary='$salary',E_workday=$E_workday,E_monthly_benefit=$E_monthly_benefit,E_monthly_premium=$E_monthly_premium  where E_name='$imformation'";
	}
	
	// echo $sql."<br/>";
	$sql = iconv("utf-8", "gbk", $sql);
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt  =  sqlsrv_query (  $conn ,  $sql ,  $params ,$options);
	if(  $stmt  ==  false  ) {
	     $arr=["errcode"=>1005,"msg"=>"更新失败"];
	     echo json_encode($arr);
	}else{
		$arr=["errcode"=>0,"msg"=>"更新成功"];
		echo json_encode($arr);
	}
?>