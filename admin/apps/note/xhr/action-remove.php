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

	foreach($_POST['items'] as $item){
		$note = $dbc->GetRecord("os_notes","*","id=".$item);
		$dbc->Update("os_notes",array("#deleted" => "NOW()"),"id=".$item);
		$os->save_log(0,$_SESSION['auth']['user_id'],"note-delete",$item,array("notes" => $note));
	}
	echo json_encode(array(
		'success'=>true
	));
	$dbc->Close();
?>
