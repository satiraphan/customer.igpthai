
$("form[name=form_uploader] input[name=file]").change(function(){
	var data = new FormData($("form[name=form_uploader]")[0]);
	jQuery.ajax({
		url: 'apps/setting/xhr/action-upload-patch.php',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		type: 'POST',
		dataType: 'json',
		success: function(response){
			if(response.success){
				bootbox.confirm('Are your sure to upgrade system?', function(result){
					if(result){
						$.post('apps/setting/xhr/action-update.php',function(response){
							if(response.success){
								window.location.reload();
							}else{
								fn.notify.warnbox(response.msg,"Oops...");
							}
						},'json');
					}
				});
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}	
		}
	});
});