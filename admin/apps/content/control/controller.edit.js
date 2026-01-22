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
