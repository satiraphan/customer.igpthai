	fn.app.schedule.edit = function(){
		$.post("apps/schedule/xhr/action-edit.php",$("form[name=form_edit_schedule]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
