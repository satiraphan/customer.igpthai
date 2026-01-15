<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../include/db.php";
	include_once "../../../../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	if($dbc->HasRecord("db_subdistricts","name = '".$_POST['name']."' AND id != ".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'subdistrict Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_POST['name'],
			'#district' => $_POST['district'],
			'#city' => $_POST['city'],
			'#country' => $_POST['country']
		);
		
		if($dbc->Update("db_subdistricts",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$subdistrict = $dbc->GetRecord("db_subdistricts","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"subdistrict-edit",$_POST['id'],array("db_subdistricts" => $subdistrict));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}
	
	$dbc->Close();
?>