	fn.app.authentication.concurrent.dialog_edit = function(id) {
		$.ajax({
			url: "apps/authentication/view/dialog.concurrent.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_concurrent"});
			}
		});
	};

	fn.app.authentication.concurrent.edit = function(){
		$.post("apps/authentication/xhr/action-edit-concurrent.php",$("form[name=form_editconcurrent]").serialize(),function(response){
			if(response.success){
				$("#tblConcurrent").DataTable().draw();
				$("#dialog_edit_concurrent").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	
	fn.app.authentication.concurrent.append_device = function(){
		let s = '';
		
		s += '<input type="text" class="form-control" name="device[]">';
		
		$("#device_list").append(s);
	}
	
