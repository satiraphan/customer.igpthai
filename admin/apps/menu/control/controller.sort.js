	fn.app.menu.dialog_sort = function() {
		var item_selected = $("#tblMenu").data("selected");
		$.ajax({
			url: "apps/menu/view/dialog.sort.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_sort_menu"});
			}
		});
	};

	fn.app.menu.sort = function(){
		$.post("apps/menu/xhr/action-sort.php",$("form[name=form_sort_menu]").serialize(),function(response){
			if(response.success){
				$("#tblMenu").data("selected",[]);
				$("#tblMenu").DataTable().draw();
				$("#dialog_sort_menu").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
