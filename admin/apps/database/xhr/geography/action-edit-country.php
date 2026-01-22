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
	
	if($dbc->HasRecord("db_countries","name = '".addslashes($_POST['name'])."' AND id != ".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'country Name is already exist.'
		));
	}else{
		$data = array(
			'name' => addslashes($_POST['name']),
			'local_name' => addslashes($_POST['local_name']),
			'iso' => addslashes($_POST['iso']),
			'iso3' => addslashes($_POST['iso3']),
			'phonecode' => addslashes($_POST['phonecode'])
		);
		
		if($dbc->Update("db_countries",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$country = $dbc->GetRecord("db_countries","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"country-edit",$_POST['id'],array("db_countries" => $country));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}
	
	$dbc->Close();
?>