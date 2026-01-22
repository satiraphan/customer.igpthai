	fn.app.menu.dialog_add = function() {
		var item_selected = $("#tblMenu").data("selected");
		$.ajax({
			url: "apps/menu/view/dialog.add.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_menu"});
			}
		});
	};

	fn.app.menu.add = function(){
		$.post("apps/menu/xhr/action-add.php",$("form[name=form_add_menu]").serialize(),function(response){
			if(response.success){
				window.location.reload();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
