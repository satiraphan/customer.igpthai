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
	
?>
<div>
	<div>
		<button class="btn btn-primary" onclick='$("form[name=uploader] input[name=file]").click();'>Upload Data</button>
	</div>
	<hr>
	<pre id="output">
	</pre>
	<form name="uploader" class="d-none">
		<input type="file" name="file">
	</form>
</div>
<script>
	var plugins = [
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js'
	];
	
	function load_location(){
		$.post("apps/sandbox/xhr/load-location.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	function prepare_tag(){
		$.post("apps/sandbox/xhr/action-insert-tag.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	function load_location_cost(){
		$.post("apps/sandbox/xhr/load-location-cost.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	function load_supplier_cost(){
		$.post("apps/sandbox/xhr/load-supplier-cost.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	
	function load_tag(){
		$.post("apps/sandbox/xhr/load-tag.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	function load_data(){
		$.post("apps/sandbox/xhr/load-data.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	
	function load_data2(){
		$.post("apps/sandbox/xhr/load-data2.php",function(html){
			$("#output").html(html);
		},"html");
	}
	
	
	
	var contents = [];
	var iterator = 0;
	
	function load_item(){
		$.post("apps/sandbox/xhr/load-json.php",function(json){
			contents = [];
			
			for(i in json){
				if(json[i].images.length > 0 && json[i].name != ""){
					var img = [];
					for(j in json[i].images){
						img.push({
							"main" : json[i].images[j]['2048x2048'],
							"thumbnail" : json[i].images[j].woocommerce_thumbnail
						});
					}
					
					contents.push({
						"sku" : json[i].sku,
						"img" : img,
						"name" : json[i].name
					})
					
				}
			}
			console.log(contents);
			$("#output").html(contents.length);
			iterator;
			process();
		},"json");
	}

	
	
	function process(){
		$.post("apps/sandbox/xhr/action-upload.php",contents[iterator],function(html){
			$("#output").append(html);
			iterator++;
			if(iterator < contents.length){
				process();
			}
		},"html");
		
	}
	
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()

		$("form[name=uploader] input[name=file]").change(function(){
			var data = new FormData($("form[name=uploader]")[0]);
			App.startLoading();
			$("#ajaxloader").html("Loading");
			jQuery.ajax({
				url: 'apps/sandbox/xhr/action-upload-ocr.php',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				dataType: 'json',
				success: function(response){
					App.stopLoading();
					if(response.success){
						$("#output").html(response.text);
					}else{
						fn.notify.warnbox(response.msg,"Oops...");
					}	
				}
			});
		});



	}).then(() => App.stopLoading())
</script>