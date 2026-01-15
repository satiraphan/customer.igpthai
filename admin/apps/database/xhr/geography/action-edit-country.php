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
	
	if($dbc->HasRecord("db_countries","name = '".$_REQUEST['name']."' AND id != ".$_REQUEST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'country Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_REQUEST['name'],
			'local_name' => $_REQUEST['local_name'],
			'iso' => $_REQUEST['iso'],
			'iso3' => $_REQUEST['iso3'],
			'phonecode' => $_REQUEST['phonecode']
		);
		
		if($dbc->Update("db_countries",$data,"id=".$_REQUEST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$country = $dbc->GetRecord("db_countries","*","id=".$_REQUEST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"country-edit",$_REQUEST['id'],array("db_countries" => $country));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}
	
	$dbc->Close();
?>