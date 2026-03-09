
	
	fn.app.profile.dialog_setting = function() {
		$.ajax({
			url: "apps/profile/view/dialog.profile.setting.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_setting"});
			}	
		});
	};
	
	fn.app.profile.save_setting = function(){
		$.post('apps/profile/xhr/action-save-setting.php',$('form[name=form_savesetting]').serialize(),function(response){
			if(response.success){
				$("#dialog_edit_setting").modal('hide');
				fn.dialog.successbox("Your settings has been saved.","Saved",function(){
					window.location.reload();
				});
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
			
		},'json');
		return false;
	};

	fn.app.profile.save_setting_email = function(){
		$.post('apps/profile/xhr/action-save-setting-email.php',$('form[name=form_savesetting]').serialize(),function(response){
			if(response.success){
				$("#dialog_edit_setting").modal('hide');
				fn.dialog.successbox("Your settings has been saved.","Saved",function(){
					window.location.reload();
				});
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
			
		},'json');
		return false;
	};

	
	