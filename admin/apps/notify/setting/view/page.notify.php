<?php
	global $os;
	$setting = json_decode($os->load_variable("aNotifySetting","json"), true);
	$aNotifyType = array(
		"email" => "Email",
		"line" => "Line",
		"instagram" => "Instagram",
		"sms" => "SMS",
		"other" => "Other"
	);

?>
<div class="card">
	<div class="card-header">
		<div class="card-title"><h2>Notification Setting</h2></div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Engine</th>
					<th>Enabled</th>
					<th>Created</th>
					<th>Updated</th>
					<th>Total Used</th>
					<th>Setting</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// Loop through each notification type
			foreach($aNotifyType as $type_key => $type_name){
				$enabled_key = "notify_" . $type_key . "_enabled";
				$created_key = "notify_" . $type_key . "_created";
				$updated_key = "notify_" . $type_key . "_updated";
				$used_key = "notify_" . $type_key . "_used";

				$enabled = isset($setting[$enabled_key]) && $setting[$enabled_key] ? true : false;
				$created = isset($setting[$created_key]) ? $setting[$created_key]	: "-";
				$updated = isset($setting[$updated_key]) ? $setting[$updated_key] : "-";
				$used = isset($setting[$used_key]) ? $setting[$used_key] : "-";
				
				echo '<tr>
					<td>'.$type_name.'</td>
					<td class="text-center">
						<div class="custom-control custom-switch">
							<input id="'.$enabled_key.'" onchange="fn.app.setting.notify.set_enabled(\''.$type_key.'\', this)" class="custom-control-input" type="checkbox" name="'.$enabled_key.'" '.($enabled ? "checked" : "").'>
							<label class="custom-control-label" for="'.$enabled_key.'"></label>
						</div>
					</td>
					<td class="text-center">'.$created.'</td>
					<td class="text-center">'.$updated.'</td>
					<td class="text-center">'.$used.'</td>
					<td class="text-center">
						<button type="button" class="btn btn-outline-dark btn-sm btn-setting" onclick="fn.app.setting.notify.dialog_setting_'.$type_key.'()" title="Setting">
							<i class="fa fa-cog"></i>
						</button>
					</td>	
				</tr>
				';
			}
			?>
			</tbody>
		</table>

	</div>
</div>