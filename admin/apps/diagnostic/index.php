<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/abox.php";
	include "../../include/widgeteer.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$df = disk_free_space("/");

	
?>
<script src="apps/logger/include/interface.js"></script>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h2>Diagnostic Tools</h2>
		<div>
			Harddisk : <?php echo (($df/1024)/1024)." MB";?>
		</div>
		<button id="txtBlockUI" class="btn btn-outline-dark">Test Block UI</button>
	</div>
</div>
<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
		
		</article>
	</div>
</section>
<script>
	pageSetUp();
	loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
	loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
	loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
	loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
	loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js",function(){
		$("#txtBlockUI").click(function(){
			//fn.blockUI();
		});
		
	});});});});});
</script>