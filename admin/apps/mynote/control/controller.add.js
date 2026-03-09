
	fn.app.mynote.create = function(){
		App.startLoading();
		$.post('apps/mynote/xhr/action-create.php',function(response){
			App.stopLoading();
			if(response.success){
				fn.app.mynote.list_note({
					default: response.note_id
				});
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},'json');
		return false;
	};
	