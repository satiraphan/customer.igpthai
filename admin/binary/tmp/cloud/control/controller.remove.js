	fn.app.cloud.dialog_remove = function() {
		var item_selected = $("#tblCloud").data("selected");
		$.ajax({
			url: "apps/cloud/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_cloud"});
			}
		});
	};

	fn.app.cloud.remove = function(){
		$.post("apps/cloud/xhr/action-remove.php",$("form[name=form_remove_cloud]").serialize(),function(response){
			if(response.success){
				$("#tblCloud").data("selected",[]);
				$("#tblCloud").DataTable().draw();
				$("#dialog_remove_cloud").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
