
fn.app.setting.notify = {
	set_enabled : function(type,element){
		$.post('apps/notify/setting/xhr/action-set-enable.php',{
			'type' : type,
			'enable' : $(element).is(':checked') ? true : false
		},function(json){
			if(json.success){
				new Noty({text: json.msg,timeout: 1000}).show();
			}else{
				fn.notify.warnbox(json.msg,"Oops...");
			}
		},'json');
	},dialog_setting_email : function(){
		$.post('apps/notify/setting/view/dialog.email.php',{},function(html){
			$('body').append(html);
			$('#dialog_notify_setting_email').modal('show');
		},'html');
	},
	save_setting_email : function(){
		$.post('apps/notify/setting/xhr/action-save-setting-email.php',$('form[name=form_notify_setting_email]').serialize(),function(json){
			if(json.success){
				$("#dialog_notify_setting_email").modal('hide').remove();
				fn.dialog.successbox("Your email setting has been saved.","Success",function(){
					window.location.reload();
				});
			}else{
				fn.notify.warnbox(json.msg,"Oops...");
			}
		},'json');
	},
	save_setting : function(){
		Swal.fire({
			title: 'Please confirm to save?',
			text: "This action may affect the your structure! Are you sure to confirm this action?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, save it!'
		}).then((result) => {
			if (result.value) {
				$.post('apps/accctrl/setting/xhr/action-save-system-auth.php',$('form[name=form_auth]').serialize(),function(response){
					if(response.success){
						fn.navigate("setting","view=system&section=auth");
					}else{
						fn.notify.warnbox(response.msg,"Oops...");
					}
				},'json');
			}
		});
	}
}



