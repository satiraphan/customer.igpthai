	fn.app.menu.dialog_remove = function(id) {
		$.ajax({
			url: "apps/menu/view/dialog.remove.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_menu"});
			}
		});
	};

	fn.app.menu.remove = function(id){
		$.post("apps/menu/xhr/action-remove.php",{id:id},function(response){
			if(response.success){
				window.location.reload();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
