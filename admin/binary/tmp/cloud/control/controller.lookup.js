	fn.app.cloud.lookup = function(){
		$.post("apps/cloud/xhr/action-lookup.php",$("form[name=form_lookup_cloud]").serialize(),function(response){
			if(response.success){
				$("#tblCloud").data("selected",[]);
				$("#tblCloud").DataTable().draw();
				$("#dialog_lookup_cloud").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
