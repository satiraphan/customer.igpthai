	fn.app.file.dialog_remove = function(id) {
		$.ajax({
			url: "apps/file/view/dialog.remove.php",
			type: "POST",
			data: {id:id},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_file"});
			}
		});
	};

	fn.app.file.remove = function(){
		$.post("apps/file/xhr/action-remove.php",$("form[name=form_remove_file]").serialize(),function(response){
			if(response.success){
				$("#tblFile").data("selected",[]);
				$("#tblFile").DataTable().draw();
				$("#dialog_remove_file").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
