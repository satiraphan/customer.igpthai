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
			"title" => addslashes($_POST['title']),
			"content" => addslashes($_POST['content']),
			'#updated' => 'NOW()',
		);

		if($dbc->Update("os_notes",$data,"id=".$_POST['id'])){
			$note = $dbc->GetRecord("os_notes","*","id=".$_POST['id']);

			// Update Tags
			$dbc->Delete("os_note_tags","note_id=".$note['id']);
			if(isset($_POST['tags'])){
				foreach($_POST['tags'] as $tag){
					if($dbc->HasRecord("db_tags","name='".$tag."'")){
						// แท็กมีอยู่แล้ว
						$tag_record = $dbc->GetRecord("db_tags","*","name='".$tag."'");
						$tag_id = $tag_record['id'];
						// แท็กมีอยู่แล้ว

						// ถ้าแท็กถูกลบไปแล้ว ให้ทำการกู้คืน
						if($tag_record['deleted']!=null){
							$dbc->Update("db_tags",array(
								'#deleted' => 'NULL'
							),"id=".$tag_id);
						}
					}else{
						$new_tag = array(
							"#id" => "DEFAULT",
							"name" => addslashes($tag),
							"#key_id" => "NULL",
							'#created' => 'NOW()',
							'#deleted' => 'NULL',
							"#color" => "NULL"
						);
						$dbc->Insert("db_tags",$new_tag);
						$tag_id = $dbc->GetID();
					}

					//ถ้ามีการเพิ่ม Tag แล้วต้องไม่เพิ่มออีก

					if(!$dbc->HasRecord("os_note_tags","note_id=".$note['id']." AND tag_id=".$tag_id)){
						$tag_data = array(
							"#id" => "DEFAULT",
							"note_id" => $note['id'],
							"tag_id" => $tag_id,
							"#created" => 'NOW()',
						);
						$dbc->Insert("os_note_tags",$tag_data);
					}
				}
			}



			echo json_encode(array(
				'success'=>true,
				'updated' => $note['updated'],
				"msg" => "Note has been saved"
			));
			$os->save_log(0,$_SESSION['auth']['user_id'],"note-edit",$_POST['id'],array("notes" => $note));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
