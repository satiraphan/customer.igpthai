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


	if($dbc->HasRecord("db_tag_keys","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Key Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_POST['name'],
			'#created' => 'NOW()'
		);

		if($dbc->Insert("db_tag_keys",$data)){
			$key_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $key_id
			));

			$key = $dbc->GetRecord("db_tag_keys","*","id=".$key_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"key-add",$key_id,array("keys" => $key));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
