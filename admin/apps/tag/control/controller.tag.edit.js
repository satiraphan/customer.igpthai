	fn.app.tag.tag.dialog_edit = function(id) {
		$.ajax({
			url: "apps/tag/view/dialog.tag.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_tag"});
			}
		});
	};

	fn.app.tag.tag.edit = function(){
		$.post("apps/tag/xhr/action-edit-tag.php",$("form[name=form_edittag]").serialize(),function(response){
			if(response.success){
				$("#tblTag").DataTable().draw();
				$("#dialog_edit_tag").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
