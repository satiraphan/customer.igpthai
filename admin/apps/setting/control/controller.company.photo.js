
	
	fn.app.setting.company.dialog_photo = function(id) {
		$.ajax({
			url: "apps/setting/view/dialog.photo.php",
			data: {list:$("[name=aExampleImgs]").val()},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_photo"});
				
				$("form[name=uploader] input[type=file]").unbind().change(function(){
					
					var data = new FormData($("form[name=uploader]")[0]);
					jQuery.ajax({
						url: 'apps/setting/xhr/action-upload-photo.php',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						type: 'POST',
						dataType: 'json',
						success: function(json){
							var s ='';
							
							for(i in json.path){
								s += '<div>';
									s += '<img class="img-thumbnail" src="'+json.path[i]+'">';
									//s += '<input xname="img" type="hidden" name="img" value="'+json.path[i]+'">';
								s += '</div>';
								
							}
							
							$("#imgList").append(s);
							
							
							
						}
					});
				});
				
			}
		});
	};
	
	fn.app.setting.company.save_photo = function(){

		var path = [];
		$("#imgList img").each(function(){
			path.push($(this).attr("src"));
		});
		var myJSON = JSON.stringify(path);
		$("[name=aExampleImgs]").val(myJSON);
		
		$("#dialog_photo").modal('hide');
	};
	

	
	/*
	fn.app.accctrl.account.edit = function(){
		$.post('apps/accctrl/xhr/action-edit-account.php',$('form[name=form_editaccount]').serialize(),function(response){
			if(response.success){
				$("#tblAccount").DataTable().draw();
				$("#dialog_edit_account").modal('hide');
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
			
		},'json');
		return false;
	};
	*/
	
	/*
	fn.app.setting.company.save_core = function(){
		bootbox.confirm('Please confirm to save?', function(result){
			if(result){
				$.post('apps/setting/xhr/action-save-company-core.php',$('form[name=form_setting]').serialize(),function(response){
					if(response.success){
						window.location.reload();
					}else{
						fn.notify.warnbox(response.msg,"Oops...");
					}
				},'json');
			}
		});
	};
	*/
	
	
		
	
	