
	fn.app.user.dialog_remove = function() {
		App.startLoading();
		var item_selected = $("#tblUser").data("selected");
		$.ajax({
			url: "apps/user/view/dialog.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				App.stopLoading();
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_user"});
			}	
		});
		
	};
	
	fn.app.user.remove = function(){
		var item_selected = $("#tblUser").data("selected");
		$.post('apps/user/xhr/action-remove-user.php',{items:item_selected},function(response){
			$("#tblUser").data("selected",[]);
			$("#tblUser").DataTable().draw();
			$('#dialog_remove_user').modal('hide');
		});
		
	};