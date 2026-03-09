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
			?>
			<form id="form_upload_file" class="form-horizontal" role="form" enctype="multipart/form-data">
				<div class="form-group row">
					<label class="col-sm-3 col-form-label">Select File</label>
					<div class="col-sm-9">
						<input type="file" class="form-control" id="file_upload_file" name="file">
					</div>
				</div>
			</form>

			<?php
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_upload_file","Upload File");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Upload","fn.app.file.upload()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
