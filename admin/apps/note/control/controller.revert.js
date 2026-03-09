	fn.app.note.dialog_revert = function() {
		var item_selected = $("#tblNote").data("selected");
		$.ajax({
			url: "apps/note/view/dialog.revert.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_revert_note"});
			}
		});
	};

	fn.app.note.revert = function(){
		$.post("apps/note/xhr/action-revert.php",$("form[name=form_revert_note]").serialize(),function(response){
			if(response.success){
				$("#tblNote").data("selected",[]);
				$("#tblNote").DataTable().draw();
				$("#dialog_revert_note").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
