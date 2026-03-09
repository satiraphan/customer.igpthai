	fn.app.note.add = function(){
		$.post("apps/note/xhr/action-add.php",$("form[name=form_add_note]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
