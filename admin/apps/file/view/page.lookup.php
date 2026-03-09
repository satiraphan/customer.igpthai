<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_file");

	$file = $dbc->GetRecord("os_files","*","id=".$_GET['id']);

	/*
	$modal->SetVariable(array(
		array("id",$file['id']),
	));

	$blueprint = array(
		array(
			array(
				"name" => "tag",
				"caption" => "Tags"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	*/
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>File Lookup</h5>
	</div>
	<div class="card-body">
		<table>
			<tbody>
				<tr><td>File Name</td><td>: <?php echo $file['name'];?></td></tr>
				<tr><td>Size</td><td>: <?php echo $file['size'];?></td></tr>
				<tr><td>Updated</td><td>: <?php echo $file['uploaded'];?></td></tr>
				<tr><td>Mine</td><td>: <?php echo $file['mime'];?></td></tr>
				<tr><td>Upload By</td><td>: <?php echo $file['uploader'];?></td></tr>
				<tr><td>Path</td><td>: <?php echo $file['path'];?></td></tr>
			</tbody>
		</table>
		<div class="preview mt-3 mb-3">
		<?php
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$img_ext = array("jpg","jpeg","png","gif","bmp","webp","tiff","svg");
			if(in_array(strtolower($ext),$img_ext)){
				echo '<img src="'.$file['path'].'" class="img-fluid" />';
			}else if(strtolower($ext) == 'pdf'){
				echo '<iframe src="'.$file['path'].'" style="width:100%;height:600px;" frameborder="0"></iframe>';
			}
			else{
				echo 'No Preview Available.';
			}

		?>
		</div>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<a class="btn btn-outline-dark" target="_blank" href="<?php echo $file['path'];?>" download="<?php echo $file['name'];?>"><i class="fa-solid fa-download mr-1"></i> Download</a>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
