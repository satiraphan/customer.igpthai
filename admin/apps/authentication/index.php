<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	$panel = new ipanel($dbc,$os->auth);

	$panel->setApp("authentication","Authentication");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'concurrent');

	$panel->setMeta(array(
		array("concurrent","Concurrent","far fa-user"),
	));
?>
<?php
	$panel->PageBreadcrumb();
?>
<div class="row">
	<div class="col-xl-12">
	<?php
		$panel->EchoInterface();
	?>
	</div>
</div>
<script>
	var plugins = [
		'apps/authentication/include/interface.js',
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js'
	];
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
	<?php
		switch($panel->getView()){
			case "concurrent":
				include "control/controller.concurrent.view.js";
				if($os->allow("authentication","add"))include "control/controller.concurrent.add.js";
				if($os->allow("authentication","edit"))include "control/controller.concurrent.edit.js";
				if($os->allow("authentication","remove"))include "control/controller.concurrent.remove.js";
				if($os->allow("authentication","revoke"))include "control/controller.concurrent.revoke.js";
				break;
}
	?>
	}).then(() => App.stopLoading())
</script>
