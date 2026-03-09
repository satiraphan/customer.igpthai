	fn.app.note.dialog_remove = function() {
		var item_selected = $("#tblNote").data("selected");
		$.ajax({
			url: "apps/note/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_note"});
			}
		});
	};

	fn.app.note.remove = function(){
		var item_selected = $("#tblNote").data("selected");
		$.post("apps/note/xhr/action-remove.php", {items: item_selected}, function(response){
			if(response.success){
				$("#tblNote").data("selected",[]);
				$("#tblNote").DataTable().draw();
				$("#dialog_remove_note").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
