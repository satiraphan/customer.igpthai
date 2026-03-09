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

	$data = array(
		'key_id' => $_POST['key_id']
	);

	if($dbc->Update("db_tags",$data,"id=".$_POST['id'])){
		echo json_encode(array(
			'success'=>true
		));
		$tag = $dbc->GetRecord("db_tags","*","id=".$_POST['id']);
		$os->save_log(0,$_SESSION['auth']['user_id'],"tag-mapping",$_POST['id'],array("tags" => $tag));
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "No Change"
		));
	}
	

	$dbc->Close();
?>
