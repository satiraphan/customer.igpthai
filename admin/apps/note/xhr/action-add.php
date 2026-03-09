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


	if($_POST['title']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Note Title is required'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			"title" => addslashes($_POST['title']),
			"content" => addslashes($_POST['content']),
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
				'msg'=> $note_id
			));

			$note = $dbc->GetRecord("os_notes","*","id=".$note_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"note-add",$note_id,array("os_notes" => $note));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
