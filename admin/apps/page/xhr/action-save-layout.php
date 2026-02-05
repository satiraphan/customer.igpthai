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
		'layout' => $_POST['layout'],
		'#updated' => 'NOW()',
	);

	if($dbc->Update("cms_pages",$data,"id=".$_POST['id'])){
		echo json_encode(array(
			'success'=>true
		));
		$page = $dbc->GetRecord("cms_pages","*","id=".$_POST['id']);
		$os->save_log(0,$_SESSION['auth']['user_id'],"page-edit",$_POST['id'],array("cms_pages" => $page));
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "No Change"
		));
	}
	

	$dbc->Close();
?>
