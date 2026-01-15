<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	if($dbc->HasRecord("os_variable","name='bMenu'")){
		$dbc->Update("os_variable",array(
			"value" => $_POST['available'],
			"#updated" => "NOW()",
		),"name='bMenu'");
	}else{
		$dbc->Insert("os_variable",array(
			"#id" => "DEFAULT",
			"name" => "bMenu",
			"value" => $_POST['available'],
			"#updated" => "NOW()"
		));
	}
	
	
	if($dbc->HasRecord("os_variable","name='aMenu'")){
		$dbc->Update("os_variable",array(
			"value" => $_POST['data'],
			"#updated" => "NOW()",
		),"name='aMenu'");
	}else{
		$dbc->Insert("os_variable",array(
			"#id" => "DEFAULT",
			"name" => "aMenu",
			"value" => $_POST['data'],
			"#updated" => "NOW()"
		));
	}
	$variable = $dbc->GetRecord("os_variable","*","name='aMenu'");
	$variable2 = $dbc->GetRecord("os_variable","*","name='bMenu'");
	$os->save_log(0,$_SESSION['auth']['user_id'],"variable-edit",$item[0],array("variable" => $variable,"variable2" => $variable2));
	
	echo json_encode(array(
		'success'=>true,
		'msg'=> "Passed"
	));
	
	$dbc->Close();
?>