<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../../config/define.php";
	include "../../../include/db.php";
	include "../../../include/oceanos.php";
	include "../../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	$note = $dbc->GetRecord("os_notes","*","id=".$_GET['id']);
?>
<form id="form_edit_note" class="form-horizontal" onsubmit="return false;">
	<input type="hidden" name="id" value="<?php echo $note['id']; ?>" />
	<div class="card border-dark">
		<div class="card-header border-bottom">
			<input class="form-control" type="text" name="title" value="<?php echo $note['title']; ?>" placeholder="Note Title" />
		</div>
		<div class="card-body">
			<textarea class="form-control" name="content" style="height:400px;" placeholder="Note Content"><?php echo $note['content']; ?></textarea>
			<select id="note_tag" name="tags[]" class="form-control" multiple="multiple">
			<?php
				$sql = "SELECT t.* FROM os_note_tags nt LEFT JOIN db_tags t ON nt.tag_id = t.id WHERE nt.note_id=".$note['id'];
				$rst = $dbc->Query($sql);
				while($tag = $dbc->Fetch($rst)){
					echo '<option value="'.$tag['name'].'" selected="selected">'.$tag['name'].'</option>';
				}

			?>
			</select>
		</div>
		<div class="card-bottom border-top">
			<div class="m-2 float-right">
				<span>Last Update <?php echo $note['updated']; ?> : </span>
				<button class="btn btn-outline-dark" onclick="fn.app.note.save()"><i class="fa-solid fa-save mr-1"></i> Save</button>
			</div>
			<div class="m-2">
				<button class="btn btn-outline-dark" onclick=""><i class="fa-solid fa-up-left mr-1"></i> Close</button>
			</div>
		</div>
	</div>
</form>