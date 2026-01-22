<?php
	global $os,$dbc;
	$datetime = $os->LoadSetting('datetime');
	$user = $dbc->GetRecord("os_users","*","id=".$os->auth['id']);

	$setting = json_decode($user['setting'],true);

	$form = new iform($dbc,$os->auth);
	$form->setForm("form_savesetting");

	$form->SetVariable(array(
		array("user_id",$user['id'])
	));

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "theme",
				"caption" => "Theme",
				"source" => array(
					array("default","Default"),
					array("blue","Blue"),
					array("cyan","Cyan"),
					array("dark","Dark"),
					array("gray","Gray"),
					array("green","Green"),
					array("pink","Pink"),
					array("purple","Purple"),
					array("red","Red"),
					array("royal","Royal"),
					array("ash","Ash"),
					array("crimson","Crimson"),
					array("namn","Namn"),
					array("frost","Frost")
				),
				"value" => isset($setting['theme']) ? $setting['theme'] : "default"
			)
		),
		array(
			array(
				"flex"=> 4,
				"type" => "textbox",
				"name" => "date_format",
				"caption" => "Date Format",
				"placeholder" => "Date Format",
				"value" => isset($setting['date_format']) ? $setting['date_format'] : "Y-m-d"
			),
			array(
				"flex"=> 4,
				"type" => "textbox",
				"name" => "time_format",
				"caption" => "Time Format",
				"placeholder" => "Time Format",
				"value" => isset($setting['time_format']) ? $setting['time_format'] : "H:i:s"
			)
		)
	);

	$form->setBlueprint($blueprint);
	
?>
<div class="row gutters-sm">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<?php
					$form->EchoInterface();
				?>
			</div>
			<div class="btn_group m-3">
				<button type="button" class="btn btn-primary" onclick="fn.app.profile.save_setting();"><i class="fa fa-save"></i> Save Settings</button>
				<button type="button" class="btn btn-secondary" onclick="$('form[name=form_savesetting]')[0].reset();"><i class="fa fa-undo"></i> Reset</button>	
			</div>
		</div>
	</div>
</div>