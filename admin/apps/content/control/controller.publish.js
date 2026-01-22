	fn.app.content.dialog_publish = function() {
		var item_selected = $("#tblContent").data("selected");
		$.ajax({
			url: "apps/content/view/dialog.publish.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_publish_content"});
			}
		});
	};

	fn.app.content.publish = function(){
		$.post("apps/content/xhr/action-publish.php",$("form[name=form_publish_content]").serialize(),function(response){
			if(response.success){
				$("#tblContent").data("selected",[]);
				$("#tblContent").DataTable().draw();
				$("#dialog_publish_content").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
