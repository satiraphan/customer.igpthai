	fn.app.menu.dialog_edit = function() {
		var item_selected = $("#tblMenu").data("selected");
		$.ajax({
			url: "apps/menu/view/dialog.edit.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_menu"});
			}
		});
	};

	fn.app.menu.edit = function(){
		$.post("apps/menu/xhr/action-edit.php",$("form[name=form_edit_menu]").serialize(),function(response){
			if(response.success){
				$("#tblMenu").data("selected",[]);
				$("#tblMenu").DataTable().draw();
				$("#dialog_edit_menu").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
