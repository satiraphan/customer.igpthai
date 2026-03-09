	fn.app.tag.key.dialog_remove = function() {
		var item_selected = $("#tblKey").data("selected");
		$.ajax({
			url: "apps/tag/view/dialog.key.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_key").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_key").modal("show");
				$("#dialog_remove_key .btnConfirm").click(function(){
					fn.app.tag.key.remove();
				});
			}
		});
	};

	fn.app.tag.key.remove = function(){
		var item_selected = $("#tblKey").data("selected");
		$.post("apps/tag/xhr/action-remove-key.php",{items:item_selected},function(response){
			$("#tblKey").data("selected",[]);
			$("#tblKey").DataTable().draw();
			$("#dialog_remove_key").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.tag.key.dialog_remove()",
		caption : "Remove"
	}));
