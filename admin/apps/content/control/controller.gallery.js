
	fn.app.content.edit = function(){
		$.post("apps/content/xhr/action-edit.php",$("form[name=form_edit_content]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	$('textarea[name=data]').summernote({
		height: 200
	});

	fn.app.content.gallery.save = function(input){
		$.post("apps/content/xhr/action-save-gallery.php",$("#form_gallery").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	}


	fn.app.content.gallery.upload_image = function(input){
		var data = new FormData($("#form_upload_image")[0]);
		jQuery.ajax({
			url: 'apps/content/xhr/action-upload-image.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.failed.length>0){
					fn.notify.warnbox(response.failed[0],"Oops...");
				}else{
					let s = '';
					for(let i=0;i<response.path.length;i++){
						s += '<div class="img-block col-md-3 mb-3">';
						s += '	<div class="card">';
						s += '		<img src="'+response.path[i]+'" class="card-img-top" alt="...">';
						s += '		<div class="card-body">';
						s += '			<input type="hidden" name="images[]" value="'+response.path[i]+'">';
						s += '			<input type="hidden" name="content_img_id[]" value="">';
						s += '			<textarea name="captions[]" class="form-control" placeholder="Caption"></textarea>';
						s += '			<button class="btn btn-danger btn-sm mt-2" onclick="$(this).closest(\'.col-md-3\').remove();">Remove</button>';
						s += '		</div>';
						s += '	</div>';
						s += '</div>';
					}
					s += '</div>';
					$("#gallery_images").append(s);

				}
			}		
		});
	}



	$("#gallery_images").sortable({
		items: ".img-block",
		cursor: "move",
		//opacity: 0.8
	});