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


	if(!isset($_POST['images'])) {
		echo json_encode(array(
			'success'=>false,
			'msg'=>'No Image in List'
		));
	}else{
		for($i =0; $i < count($_POST['images']); $i++) {
			if($_POST['content_img_id'][$i] == "") {
				$data = array(
					"#id" => "DEFAULT",
					"#content_id" => $_POST['content_id'],
					"#uploader" => $os->auth['id'],
					"#uploaded" => "NOW()",
					"caption" => addslashes($_POST['captions'][$i]),
					"#ordinal" => $i+1,
					"#status" => 1,
					"path" => $_POST['images'][$i],
				);
				$dbc->Insert("cms_content_imgs",$data);
				$img_id = $dbc->GetID();
				$os->save_log(0,$_SESSION['auth']['user_id'],"content-image-add",$img_id,array("cms_content_imgs" => $data) );
			} else {
				$data = array(
					"caption" => addslashes($_POST['captions'][$i]),
					"#ordinal" => $i+1
				);
				$dbc->Update("cms_content_imgs",$data,"id=".$_POST['content_img_id'][$i]);
				$os->save_log(0,$_SESSION['auth']['user_id'],"content-image-edit",$_POST['content_img_id'][$i],array("cms_content_imgs" => $data) );
			}
		}
		
		echo json_encode(array(
			'success'=>true
		));

		$os->save_log(0,$_SESSION['auth']['user_id'],"content-gallery-save",$_POST['id'],array("cms_contents" => $content));
	
	}

	$dbc->Close();
?>
