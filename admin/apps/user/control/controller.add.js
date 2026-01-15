
	fn.app.user.add = function(){
		App.startLoading();
		$.post('apps/user/xhr/action-add-user.php',$('form[name=form_adduser]').serialize(),function(response){
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
		"form[name=form_adduser] select[name=country]",
		"form[name=form_adduser] select[name=city]",
		"form[name=form_adduser] select[name=district]",
		"form[name=form_adduser] select[name=subdistrict]");
	fn.app.contact.address.load_country("form[name=form_adduser] select[name=country]");
	
	//$("select[name=country]").attr("multiple","multiple");
	$("select[name=country]").select2();