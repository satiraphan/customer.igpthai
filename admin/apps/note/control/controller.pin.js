	fn.app.note.dialog_pin = function() {
		var item_selected = $("#tblNote").data("selected");
		$.ajax({
			url: "apps/note/view/dialog.pin.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_pin_note"});
			}
		});
	};

	fn.app.note.pin = function(){
		$.post("apps/note/xhr/action-pin.php",$("form[name=form_pin_note]").serialize(),function(response){
			if(response.success){
				$("#tblNote").data("selected",[]);
				$("#tblNote").DataTable().draw();
				$("#dialog_pin_note").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
