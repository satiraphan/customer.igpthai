<?php
	global $os,$dbc;
	$content = $dbc->GetRecord("cms_contents","*","id=".$_GET['id']);
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Gallery Lookup</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
			<button class="btn btn-outline-warning" onclick="fn.app.content.gallery.save()"><i class="fa-solid fa-floppy-disk mr-1"></i> Save</button>
			<button class="btn btn-outline-primary" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Sort</button>
			<button class="btn btn-outline-primary" onclick="$('#form_upload_image input[type=file]').click();"><i class="fa-solid fa-up-left mr-1"></i> Upload Photos</button>
		</div>
		<div>
		</div>
		<?php
			echo '<dl class="row">';
				echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$content['id'].'</dd>';
				echo '<dt class="col-sm-3">Name</dt><dd class="col-sm-9">'.$content['name'].'</dd>';
			echo '</dl>';
		?>
		<form id="form_gallery" onsubmit="return false;">
			<input type="hidden" name="content_id" value="<?php echo $content['id']; ?>">
			<div id="gallery_images" class="row">
				<?php
					$sql = "SELECT * FROM cms_content_imgs WHERE content_id=".$content['id']." ORDER BY ordinal ASC";
					$rst = $dbc->Query($sql);
					while($images = $dbc->Fetch($rst)){
						echo '<div class="img-block col-md-3 mb-3">';
						echo '	<div class="card">';
						echo '		<input type="hidden" name="images[]" value="'.$images['path'].'">';
						echo '		<img src="'.$images['path'].'" class="card-img-top" alt="...">';
						echo '		<div class="card-body">';
						echo '			<input type="hidden" name="content_img_id[]" value="'.$images['id'].'">';
						echo '			<textarea name="captions[]" class="form-control" placeholder="Caption">'.$images['caption'].'</textarea>';
						echo '			<button class="btn btn-primary btn-sm mt-2" onclick="fn.app.content.gallery.save_caption(this);">Save Caption</button>';
						echo '			<button class="btn btn-danger btn-sm mt-2" onclick="$(this).closest(\'.col-md-3\').remove();">Remove</button>';
						echo '		</div>';
						echo '	</div>';
						echo '</div>';
					}
					
				?>

			</div>
		</form>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
<form enctype="multipart/form-data" id="form_upload_image" method="post" onsubmit="return false;">
	<input type="hidden" name="content_id" value="<?php echo $content['id']; ?>">
	<input type="file" name="file[]" style="display:none;" multiple onchange="fn.app.content.gallery.upload_image(this);">
</form>
