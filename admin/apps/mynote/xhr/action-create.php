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
		'#id' => "DEFAULT",
		"title" => "New : " . date("Y-m-d H:i:s"),
		"content" => addslashes(""),
		'#created' => 'NOW()',
		'#updated' => 'NOW()',
		"#deleted" => 'NULL',
		"#user_id" => $os->auth['id'],
		"#pinned" => 'NULL'
	);

	if($dbc->Insert("os_notes",$data)){
		$note_id = $dbc->GetID();
		echo json_encode(array(
			'success'=>true,
			'note_id'=> $note_id,
			'msg'=> $note_id
		));

		$note = $dbc->GetRecord("os_notes","*","id=".$note_id);
		$os->save_log(0,$_SESSION['auth']['user_id'],"note-create",$note_id,array("os_notes" => $note));
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "Insert Error"
		));
	}
	

	$dbc->Close();
?>
