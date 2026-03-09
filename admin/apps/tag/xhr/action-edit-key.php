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

	if($dbc->HasRecord("db_tag_keys","name = '".$_POST['name']."' AND id !=".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Key Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_POST['name']
		);

		if($dbc->Update("db_tag_keys",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$key = $dbc->GetRecord("db_tag_keys","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"key-edit",$_POST['id'],array("keys" => $key));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
