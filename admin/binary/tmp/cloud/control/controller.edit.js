	fn.app.cloud.edit = function(){
		$.post("apps/cloud/xhr/action-edit.php",$("form[name=form_edit_cloud]").serialize(),function(response){
			if(response.success){
				$("#tblCloud").data("selected",[]);
				$("#tblCloud").DataTable().draw();
				$("#dialog_edit_cloud").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
