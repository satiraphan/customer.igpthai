	fn.app.tag.key.dialog_edit = function(id) {
		$.ajax({
			url: "apps/tag/view/dialog.key.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_key"});
			}
		});
	};

	fn.app.tag.key.edit = function(){
		$.post("apps/tag/xhr/action-edit-key.php",$("form[name=form_editkey]").serialize(),function(response){
			if(response.success){
				$("#tblKey").DataTable().draw();
				$("#dialog_edit_key").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
