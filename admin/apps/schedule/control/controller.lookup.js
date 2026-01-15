	fn.app.schedule.lookup = function(){
		$.post("apps/schedule/xhr/action-lookup.php",$("form[name=form_lookup_schedule]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
