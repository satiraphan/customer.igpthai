	fn.app.note.save = function(){
		$.post("apps/note/xhr/action-edit.php",$("form#form_edit_note").serialize(),function(response){
			if(response.success){
				fn.notify.successbox(response.msg,"Success");
				$('#note_screen').html('');
				$('#tblNote tbody').find('tr.selected').removeClass('selected');
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	$("textarea[name=content]").summernote({
		height: 300,
	});

