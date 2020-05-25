<?php
	include('./conn.php');
	$json = file_get_contents("php://input");   // empty($json) 为 0
	$data = json_decode($json,true);
	$params  = array( 1 ,  "some data" );
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql="select * from Engineer_table";
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
	}
	//释放资源
	sqlsrv_free_stmt($stmt);
	//关闭连接
	sqlsrv_close($conn );
	$data = $users;
	//打开请求头
	$filename = "工程师信息(".date("Ymd").")";
	//设置浏览器信息
	header("Content-type:application/vnd.ms-excel;charset=UTF-8");
	header("Content-Disposition:filename=".$filename.".xls");
	ob_clean();	//清空缓冲区
	echo '<meta http-equiv="Content-Type" content="text/html; charset=GBK" />';
	$content = '<table border="1" cellspacing="0">';	// width="70%"
	$content .='<tr >';//style="font-size: 16px;font-weight: 800;"
	$content .='<th align="center" height="20" width="120">'.mb_convert_encoding("ID",'GBK').'</th>';
	$content .='<th align="center" height="20" width="120">'.mb_convert_encoding("姓名",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("性别",'GBK').'</th>';
	// $content .='<th align="center" height="30" width="150">'.mb_convert_encoding("生日",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("籍贯",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("学历",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("地址",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("电话",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("工龄",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("基本薪水",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("月工作天数",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("月绩效",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("月保险金",'GBK').'</th>';
	$content .='<th align="center" height="20" width="150">'.mb_convert_encoding("月工资",'GBK').'</th>';
	
	$content .='</tr>';
	
	foreach ($data as $k => $v){
		 // if(is_array($v)){
			 $content .='<tr>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_id'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_name'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_sex'],'GBK').'</td>';
			 // $content .='<td height="30" align="center">'.mb_convert_encoding($v['E_birth'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_nativeplace'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_education'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_address'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_phone'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_workingyears'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_base_salary'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_workday'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_monthly_benefit'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_monthly_premium'],'GBK').'</td>';
			 $content .='<td height="20" align="center">'.mb_convert_encoding($v['E_monthly_salary'],'GBK').'</td>';
			 $content .='</tr>';
		 // }

	}
	$content .='</table>';
	// $content = mb_convert_encoding($content, "UTF-8","auto");
	echo $content;

?>