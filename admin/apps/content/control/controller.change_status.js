	fn.app.content.dialog_change_status = function() {
		var item_selected = $("#tblContent").data("selected");
		$.ajax({
			url: "apps/content/view/dialog.change_status.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_change_status_content"});
			}
		});
	};

	fn.app.content.change_status = function(){
		$.post("apps/content/xhr/action-change_status.php",$("form[name=form_change_status_content]").serialize(),function(response){
			if(response.success){
				$("#tblContent").data("selected",[]);
				$("#tblContent").DataTable().draw();
				$("#dialog_change_status_content").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
