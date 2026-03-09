<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_file");

	$file = $dbc->GetRecord("os_files","*","id=".$_GET['id']);

	$modal->SetVariable(array(
		array("id",$file['id']),
	));

	$tags = array();
	$sql = "SELECT t.id,t.name FROM os_file_tags AS ft LEFT JOIN db_tags AS t ON t.id=ft.tag_id WHERE ft.file_id=".$file['id'];
	$rst = $dbc->Query($sql);
	while($line = $dbc->Fetch($rst)){
		array_push($tags, $line['name']);
	}

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "tags[]",
				"caption" => "Tags",
				"placeholder" => "Tags",
				"multiple" => "multiple",
				"source" => $tags,
				"value" => implode(",",$tags)
			)
		)
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Edit File</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.file.edit()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
