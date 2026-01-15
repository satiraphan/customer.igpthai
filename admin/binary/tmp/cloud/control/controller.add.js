	fn.app.cloud.add = function(){
		$.post("apps/cloud/xhr/action-add.php",$("form[name=form_add_cloud]").serialize(),function(response){
			if(response.success){
				$("#tblCloud").data("selected",[]);
				$("#tblCloud").DataTable().draw();
				$("#dialog_add_cloud").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
