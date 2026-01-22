<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_content");

	$content = $dbc->GetRecord("os_users","*","id=".$_GET['id']);

	$modal->SetVariable(array(
		array("id",$content['id']),
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Content Name",
				"value" => $content['name']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Edit Content</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.content.edit()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
