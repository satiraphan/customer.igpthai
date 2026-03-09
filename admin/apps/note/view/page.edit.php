<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_note");

	$note = $dbc->GetRecord("os_notes","*","id=".$_GET['id']);

	$modal->SetVariable(array(
		array("id",$note['id']),
	));

	$blueprint = array(
		array(
			array(
				"name" => "title",
				"caption" => "Title",
				"placeholder" => "Note Title",
				"value" => $note['title']
			)
		),array(
			array(
				"type" => "textarea",
				"name" => "content",
				"caption" => "Content",
				"placeholder" => "Note Content",
				"value" => $note['content']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Edit Note</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.note.edit()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
