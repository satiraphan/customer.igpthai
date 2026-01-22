	fn.app.content.lookup = function(){
		$.post("apps/content/xhr/action-lookup.php",$("form[name=form_lookup_content]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
