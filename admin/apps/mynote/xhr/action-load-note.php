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

	if($_POST['note_id']==""){
		echo json_encode(array(
			"success" => false,
			"msg" => "Note ID is required"
		));
	}else{
		$note = $dbc->GetRecord("os_notes","*","id=".$_POST['note_id']);
		$tags = array();

		$sql = "SELECT t.* FROM os_note_tags nt LEFT JOIN db_tags t ON nt.tag_id = t.id WHERE nt.note_id=".$note['id'];
		$rst = $dbc->Query($sql);
		while($line = $dbc->Fetch($rst)){
			array_push($tags,$line['name']);	
		}



		echo json_encode(array(
			"success" => true,
			"note" => $note,
			"tags" => $tags
		));
	}


	$dbc->Close();
?>