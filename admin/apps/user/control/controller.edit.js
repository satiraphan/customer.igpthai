
	fn.app.user.edit = function(){
		App.startLoading();
		$.post('apps/user/xhr/action-edit-user.php',$('form[name=form_edituser]').serialize(),function(response){
			App.stopLoading();
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},'json');
		return false;
	};

	fn.app.contact.address.initial(
		"form[name=form_edituser] select[name=country]",
		"form[name=form_edituser] select[name=city]",
		"form[name=form_edituser] select[name=district]",
		"form[name=form_edituser] select[name=subdistrict]");

