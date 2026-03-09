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

	if($_POST['id'] == "") {
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Invalid Note ID'
		));
	}else{
		$note = $dbc->GetRecord("os_notes","*","id=".$_POST['id']);
		$dbc->Update("os_notes",array("#archived" => "NULL"),"id=".$_POST['id']);
		$os->save_log(0,$os->auth['id'],"note-unarchive",$_POST['id'],array("notes" => $note));
		
		echo json_encode(array(
			'success'=>true
		));

	}

	$dbc->Close();
?>
