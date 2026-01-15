	fn.app.page.add = function(){
		$.post("apps/page/xhr/action-add.php",$("form[name=form_add_page]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
