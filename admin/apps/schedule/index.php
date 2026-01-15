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

	$panel->setApp("schedule","Schedule");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');

	$panel->setMeta(array(
		array("view","View","fa fa-wrench"),
		array("add","add","fa fa-plus"),
		array("edit","Edit","fa fa-pencil"),
		array("lookup","Lookup","fa fa-eye"),
		array("schedule","Schedule","fa fa-schedule"),
	));
	$panel->PageBreadcrumb();
	$panel->EchoViewInterface();
?>
<script>
	var plugins = [
		'apps/schedule/include/interface.js',
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js',
		'plugins/jquery-ui-1.12.1.custom/jquery-ui.css',
		'plugins/jquery-ui-1.12.1.custom/jquery-ui.js',
		'plugins/datetimepicker-master/build/jquery.datetimepicker.min.css',
		'plugins/datetimepicker-master/build/jquery.datetimepicker.full.min.js',
		
		
		
		//'plugins/bootstrap-datetimepicker-0.0.11/css/bootstrap-datetimepicker.min.css',
		//'plugins/bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js',
		//'plugins/jquery-ui-bootstrap/css/custom-theme/jquery-ui-1.9.2.custom.css',
		//'plugins/jquery-ui-bootstrap/js/jquery-ui-1.9.2.custom.min'
		
	];
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
	<?php
		switch($panel->getView()){
			case "view":
				include "control/controller.view.js";
				if($os->allow("schedule","remove"))include "control/controller.remove.js";
				break;
			case "add":
				if($os->allow("schedule","add"))include "control/controller.add.js";
				break;
			case "edit":
				if($os->allow("schedule","edit"))include "control/controller.edit.js";
				break;
			case "lookup":
				if($os->allow("schedule","view"))include "control/controller.lookup.js";
				break;
			case "schedule":
				if($os->allow("schedule","edit"))include "control/controller.schedule.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
