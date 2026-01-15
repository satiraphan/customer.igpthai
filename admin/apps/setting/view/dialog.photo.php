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
	
?>

<div class="modal fade" id="dialog_photo" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_setting" class="form-horizontal" role="form" onsubmit="fn.app.setting.company.save_photo();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Photo</h4>
      		</div>
		    <div class="modal-body">
				<div id="imgList">
				<?php
				if($_POST['list']!=""){
					$list = json_decode($_POST['list'],true);
					foreach($list as $li){
						echo '<div>';
							echo '<img src="'.$li.'">';
						echo '</div>';
					}
				}
					
				?>
				</div>

				
				</div>
			<div class="modal-footer">
				<a class="btn btn-outline-primary" onclick='$("form[name=uploader] input[type=file]").click();'>Upload Photo</a>
				<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
		<form class="d-none" name="uploader" enctype="multipart/form-data">
			<input type="file" name="file[]" multiple>
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
	$dbc->Close();
?>