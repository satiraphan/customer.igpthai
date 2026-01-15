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
	$os->initial_lang("lang");
	$panel = new ipanel($dbc,$os->auth);
	
	$panel->setApp("user","User");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');
	
	$panel->setMeta(array(
		array('view' ,$os->tr('main.appname'),	'far fa-eye'),
		array('add'	 ,$os->tr('main.add'),	'far fa-pen'),
		array('edit' ,$os->tr('main.edit'),	'far fa-cut')
	));
	$panel->PageBreadcrumb();
	$panel->EchoViewInterface();
?>

<script>
	var plugins = [
		'apps/engine/include/interface.js',
		'apps/contact/include/interface.js',
		'apps/user/include/interface.js',
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
				include "../contact/control/controller.contact.view.js";
				include "../contact/control/controller.address.js";
				include "../contact/control/controller.organization.lookup.js";
		switch($panel->getView()){
			case "view":
				include "control/controller.view.js";
				if($os->allow("user","remove"))include "control/controller.remove.js";
				if($os->allow("user","edit"))include "../engine/control/controller.file.upload.js";
				break;
			case "add":
				if($os->allow("user","add"))include "control/controller.add.js";
				break;
			case "edit":
				if($os->allow("user","edit"))include "control/controller.edit.js";
				break;
		}
		?>
	}).then(() => App.stopLoading())
</script>
<?php
	$dbc->Close();
?>