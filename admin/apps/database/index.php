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
	
	$panel->setApp("database","Database");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'geography');
	
	$panel->setMeta(array(
		array('geography' ,"Geography ", 'fa fa-lg fa-globe'),
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
			'apps/database/include/interface.js',
			'apps/contact/include/interface.js',
			'plugins/datatables/dataTables.bootstrap4.min.css',
			'plugins/datatables/responsive.bootstrap4.min.css',
			'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
			'plugins/select2/css/select2.min.css',
			'plugins/select2/js/select2.min.js',
			'plugins/moment/moment.min.js',
			'iface/startup.php'
	];
	
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
		<?php
		switch($panel->getView()){
			case "geography":
				include "../contact/control/controller.address.js";
				switch($panel->getSection()){
					case "country":
						include "control/geography/controller.country.view.js";
						if($os->allow("database","add"))include "control/geography/controller.country.add.js";
						if($os->allow("database","edit"))include "control/geography/controller.country.edit.js";
						if($os->allow("database","remove"))include "control/geography/controller.country.remove.js";
						break;
					case "city":
						include "control/geography/controller.city.view.js";
						if($os->allow("database","add"))include "control/geography/controller.city.add.js";
						if($os->allow("database","edit"))include "control/geography/controller.city.edit.js";
						if($os->allow("database","remove"))include "control/geography/controller.city.remove.js";
						break;
					case "district":
						include "control/geography/controller.district.view.js";
						if($os->allow("database","add"))include "control/geography/controller.district.add.js";
						if($os->allow("database","edit"))include "control/geography/controller.district.edit.js";
						if($os->allow("database","remove"))include "control/geography/controller.district.remove.js";
						break;
					case "subdistrict":
						include "control/geography/controller.subdistrict.view.js";
						if($os->allow("database","add"))include "control/geography/controller.subdistrict.add.js";
						if($os->allow("database","edit"))include "control/geography/controller.subdistrict.edit.js";
						if($os->allow("database","remove"))include "control/geography/controller.subdistrict.remove.js";
						break;
				}
				break;
			
		}
		?>
	}).then(() => App.stopLoading())
</script>
