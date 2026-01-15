<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_schedule");

	$schedule = $dbc->GetRecord("os_schedules","*","id=".$_GET['id']);

	$modal->SetVariable(array(
		array("id",$schedule['id']),
	));

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "type",
				"caption" => "Type",
				"source" => array(
					array("week","Weekly Schedule"),
					array("yearplan","Yearplan"),
					array("custom","Custom")
				),
				"value" => $schedule['type']
			)
		),
		"hr",
		array(
			array(
				"type" =>"custom",
				"html" => '<div class="btn-area mb-2"></div><div id="schedule_zone"></div>'
			)
		),
		array(
			array(
				"type" => "hidden",
				"name" => "data",
				"value" => htmlentities($schedule['data'])
			)
		),
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Edit Schedule</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.schedule.schedule.save()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
<style>

	#feedback { font-size: 1.4em; }
  #selectable_schedule .ui-selecting { background: #FECA40; }
  #selectable_schedule .ui-selected { background: #F39814; color: white; }
  #selectable_schedule { list-style-type: none; margin: 0; padding: 0; width: 450px; }
  #selectable_schedule li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; font-size: 4em; text-align: center; }
  
</style>