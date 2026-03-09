<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);

	class myModel extends imodal{
		function body(){
			$dbc = $this->dbc;
			$file_id = isset($this->param['id'])?$this->param['id']:array();
			$file = $dbc->GetRecord("os_files","*","id=".$file_id);
			echo '<form name="form_remove_file" class="form-horizontal" role="form">';
				echo '<input type="hidden" name="file_id" value="'.$file['id'].'">';
				echo '<div class="alert alert-danger" role="alert">';
					echo 'Are you sure you want to remove the file: '.$file['name'].'?';
					echo '<div class="custom-control custom-checkbox mt-2">';
						echo '<input type="checkbox" class="custom-control-input" id="chk_remove_physical" name="remove_physical" value="1">';
						echo '<label class="custom-control-label" for="chk_remove_physical">Also remove the physical file from the server.</label>';
					echo '</div>';
				echo '</div>';
			echo '</form>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_remove_file","Remove File");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Remove","fn.app.file.remove()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
