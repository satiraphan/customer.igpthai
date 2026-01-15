<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
?>

<h2>Concurrent</h2>
<div class="card p-2">
	<div class="btn-area btn-group mb-2">
		<div class="custom-control custom-switch">
			<input id="realtime" class="custom-control-input" type="checkbox" name="realtime" value="yes">
			<label for="realtime" class="custom-control-label">Realtime</label>
		</div>
	</div>
	<div class="overflow-auto">
	<table id="tblConcurrent" class="table table-striped table-bordered">
		<thead>
			<th class="text-center">ID</th>
			<th class="text-center">Token</th>
			<th class="text-center">Package</th>
			<th class="text-center">Created</th>
			<th class="text-center">Updated</th>
			<th class="text-center">Status</th>
			<th class="text-center">Session ID</th>
			<th class="text-center">User ID</th>
			<th class="text-center">User Name</th>
			<th class="text-center">Device</th>
			<th class="text-center">Login</th>
			<th class="text-center">Connected</th>
			<th class="text-center">IP Address</th>
			<th class="text-center">Counter</th>
			<th class="text-center">Display</th>
		</thead>
		<tbody>
		</tbody>
	</table>
	<div>
</div>


<script>
	var plugins = [
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/moment/moment.min.js'
	];
	
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll();
		
		<?php
			include "control/controller.concurent.view.js";
		?>

	}).then(() => App.stopLoading())
</script>



<?php
	$dbc->Close();
?>