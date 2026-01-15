	fn.app.authentication.concurrent.dialog_add = function() {
		$.ajax({
			url: "apps/authentication/view/dialog.concurrent.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_concurrent"});
			}
		});
	};

	fn.app.authentication.concurrent.add = function(){
		$.post("apps/authentication/xhr/action-add-concurrent.php",$("form[name=form_addconcurrent]").serialize(),function(response){
			if(response.success){
				$("#tblConcurrent").DataTable().draw();
				$("#dialog_add_concurrent").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "add_circle_outline",
		onclick : "fn.app.authentication.concurrent.dialog_add()",
		caption : "Add"
	}));
