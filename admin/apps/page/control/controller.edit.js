	fn.app.page.edit = function(){
		$.post("apps/page/xhr/action-edit.php",$("form[name=form_edit_page]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
