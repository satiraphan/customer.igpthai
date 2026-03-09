	fn.app.tag.tag.dialog_remove = function() {
		var item_selected = $("#tblTag").data("selected");
		$.ajax({
			url: "apps/tag/view/dialog.tag.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_tag").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_tag").modal("show");
				$("#dialog_remove_tag .btnConfirm").click(function(){
					fn.app.tag.tag.remove();
				});
			}
		});
	};

	fn.app.tag.tag.remove = function(){
		var item_selected = $("#tblTag").data("selected");
		$.post("apps/tag/xhr/action-remove-tag.php",{items:item_selected},function(response){
			$("#tblTag").data("selected",[]);
			$("#tblTag").DataTable().draw();
			$("#dialog_remove_tag").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.tag.tag.dialog_remove()",
		caption : "Remove"
	}));
