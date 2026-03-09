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
	
	$user = $dbc->GetRecord("os_users","*","id=".$_POST['user_id']);
	$setting = json_decode($user['setting'],true);

	$mail = array(
		"email" => $_POST['setting']['mail']['email'],
		"in" => array(
			"type" => $_POST['setting']['mail']['in']['type'],
			"server" => $_POST['setting']['mail']['in']['server'],
			"username" => $_POST['setting']['mail']['in']['username'],
			"password" => $_POST['setting']['mail']['in']['password'],
			"security" => $_POST['setting']['mail']['in']['security'],
			"port" => $_POST['setting']['mail']['in']['port']
		),
		"out" => array(
			"type" => $_POST['setting']['mail']['out']['type'],
			"server" => $_POST['setting']['mail']['out']['server'],
			"username" => $_POST['setting']['mail']['out']['username'],
			"password" => $_POST['setting']['mail']['out']['password'],
			"security" => $_POST['setting']['mail']['out']['security'],
			"port" => $_POST['setting']['mail']['out']['port']
		)
	);
	$setting['mail'] = $mail;

	$data = array(
		"setting" => json_encode($setting),
		"#updated" => "NOW()"
	);
	
	if($dbc->Update("os_users", $data,"id=".$_POST['user_id'])){
		
		echo json_encode(array(
			'success'=>true
		));

		$user = $dbc->GetRecord("os_users","*","id=".$_POST['user_id']);
		$os->save_log(0,$os->auth["id"],"user-save-setting-email",$_POST['user_id'],array("users" => $user));
	
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "Update Error"
		));
	}
	
	$dbc->Close();
?>