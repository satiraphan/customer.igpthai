	fn.app.schedule.add = function(){
		$.post("apps/schedule/xhr/action-add.php",$("form[name=form_add_schedule]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
