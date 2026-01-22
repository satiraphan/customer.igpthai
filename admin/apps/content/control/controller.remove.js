	fn.app.content.dialog_remove = function() {
		var item_selected = $("#tblContent").data("selected");
		$.ajax({
			url: "apps/content/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_content"});
			}
		});
	};

	fn.app.content.remove = function(){
		$.post("apps/content/xhr/action-remove.php",$("form[name=form_remove_content]").serialize(),function(response){
			if(response.success){
				$("#tblContent").data("selected",[]);
				$("#tblContent").DataTable().draw();
				$("#dialog_remove_content").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
