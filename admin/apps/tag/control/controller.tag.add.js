	fn.app.tag.tag.dialog_add = function() {
		$.ajax({
			url: "apps/tag/view/dialog.tag.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_add_tag"});
			}
		});
	};

	fn.app.tag.tag.add = function(){
		$.post("apps/tag/xhr/action-add-tag.php",$("form[name=form_addtag]").serialize(),function(response){
			if(response.success){
				$("#tblTag").DataTable().draw();
				$("#dialog_add_tag").modal("hide");
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
		onclick : "fn.app.tag.tag.dialog_add()",
		caption : "Add"
	}));
