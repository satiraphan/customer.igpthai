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

	if($dbc->HasRecord("db_tags","name = '".$_POST['name']."' AND id !=".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Tag Name is already exist.'
		));
	}else{
		$data = array(
			"#id" =>"DEFAULT",
			"name" => $_POST['name']
		);

		if($dbc->Update("db_tags",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$tag = $dbc->GetRecord("db_tags","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"tag-edit",$_POST['id'],array("tags" => $tag));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
