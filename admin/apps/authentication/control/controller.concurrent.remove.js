	fn.app.authentication.concurrent.dialog_remove = function() {
		var item_selected = $("#tblConcurrent").data("selected");
		$.ajax({
			url: "apps/authentication/view/dialog.concurrent.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_concurrent").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_concurrent").modal("show");
				$("#dialog_remove_concurrent .btnConfirm").click(function(){
					fn.app.authentication.concurrent.remove();
				});
			}
		});
	};

	fn.app.authentication.concurrent.remove = function(){
		var item_selected = $("#tblConcurrent").data("selected");
		$.post("apps/authentication/xhr/action-remove-concurrent.php",{items:item_selected},function(response){
			$("#tblConcurrent").data("selected",[]);
			$("#tblConcurrent").DataTable().draw();
			$("#dialog_remove_concurrent").modal("hide");
		});
	};
	$(".btn-area").append(fn.ui.button({
		class_name : "btn btn-light has-icon",
		icon_type : "material",
		icon : "delete",
		onclick : "fn.app.authentication.concurrent.dialog_remove()",
		caption : "Remove"
	}));
