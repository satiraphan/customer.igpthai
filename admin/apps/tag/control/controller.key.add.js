	fn.app.tag.key.dialog_add = function() {
		$.ajax({
			url: "apps/tag/view/dialog.key.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_key"});
			}
		});
	};

	fn.app.tag.key.add = function(){
		$.post("apps/tag/xhr/action-add-key.php",$("form[name=form_addkey]").serialize(),function(response){
			if(response.success){
				$("#tblKey").DataTable().draw();
				$("#dialog_add_key").modal("hide");
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
		onclick : "fn.app.tag.key.dialog_add()",
		caption : "Add"
	}));
