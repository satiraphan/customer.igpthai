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

	$panel->setApp("tag","Tag");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'tag');

	$panel->setMeta(array(
		array("tag","Tag","far fa-user"),
		array("key","Key","far fa-user"),
	));
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
		'apps/tag/include/interface.js',
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
			case "tag":
				include "control/controller.tag.view.js";
				if($os->allow("tag","add"))include "control/controller.tag.add.js";
				if($os->allow("tag","edit"))include "control/controller.tag.edit.js";
				if($os->allow("tag","remove"))include "control/controller.tag.remove.js";
				if($os->allow("tag","edit"))include "control/controller.tag.mapping.js";
				break;
			case "key":
				include "control/controller.key.view.js";
				if($os->allow("tag","add"))include "control/controller.key.add.js";
				if($os->allow("tag","edit"))include "control/controller.key.edit.js";
				if($os->allow("tag","remove"))include "control/controller.key.remove.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
