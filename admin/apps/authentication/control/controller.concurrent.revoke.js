	fn.app.authentication.concurrent.dialog_revoke = function(id) {
		$.ajax({
			url: "apps/authentication/view/dialog.concurrent.revoke.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_revoke_concurrent"});
			}
		});
	};

	fn.app.authentication.concurrent.revoke = function(){
		$.post("apps/authentication/xhr/action-revoke-concurrent.php",$("form[name=form_revokeconcurrent]").serialize(),function(response){
			if(response.success){
				$("#tblConcurrent").DataTable().draw();
				$("#dialog_revoke_concurrent").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
