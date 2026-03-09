	fn.app.note.edit = function(){
		$.post("apps/note/xhr/action-edit.php",$("form[name=form_edit_note]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	$("textarea[name=content]").summernote({
		height: 300,
	});