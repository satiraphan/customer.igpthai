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
	//$os->initial_lang("lang");
	$panel = new ipanel($dbc,$os->auth);
	
	$panel->setApp("info","Information");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'about');
	
	$panel->setMeta(array(
		array('about'	,"About",	'fa fa-lg fa-info'),
		array('license'	,"License",	'fa fa-lg fa-info'),
		array('document',"Document",	'fa fa-lg fa-info'),
		array('help'	,"Help",	'fa fa-lg fa-info'),
	));
	
	$panel->PageBreadcrumb();
?>
<div class="row">
	<div class="col-xl-12">
	<?php
		switch($panel->getView()){
			case "about":
				include "view/about.php";
				break;
			case "license":
				include "view/license.php";
				break;
			case "document":
				$panel->setSection(isset($_GET['section'])?$_GET['section']:'main');
				switch($panel->getSection()){
					case "001":
						include "view/document/001.php";
						break;
					default:
						include "view/document/main.php";
						break;
				}
				break;
			case "help":
				include "view/help.php";
				break;
		}
	?>
	</div>
</div>
<script>
	App.stopLoading()
</script>
