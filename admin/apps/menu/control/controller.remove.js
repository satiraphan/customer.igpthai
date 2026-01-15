	fn.app.menu.dialog_remove = function() {
		var item_selected = $("#tblMenu").data("selected");
		$.ajax({
			url: "apps/menu/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_menu"});
			}
		});
	};

	fn.app.menu.remove = function(){
		$.post("apps/menu/xhr/action-remove.php",$("form[name=form_remove_menu]").serialize(),function(response){
			if(response.success){
				$("#tblMenu").data("selected",[]);
				$("#tblMenu").DataTable().draw();
				$("#dialog_remove_menu").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
