	fn.app.file.dialog_upload = function() {
		var item_selected = $("#tblFile").data("selected");
		$.ajax({
			url: "apps/file/view/dialog.upload.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_upload_file"});
			}
		});
	};

	fn.app.file.upload = function(){
		var form = $("#form_upload_file");
		var fileInput = $("#file_upload_file")[0];
		if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
			fn.notify.warnbox("Please select a file to upload.","Oops...");
			return false;
		}

		var formData = new FormData(form[0]);
		formData.set("file", fileInput.files[0]);

		$.ajax({
			url: "apps/file/xhr/action-upload.php",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function(response){
				if(response && response.success){
					$("#tblFile").data("selected",[]);
					$("#tblFile").DataTable().draw();
					$("#dialog_upload_file").modal("hide");
				}else{
					var msg = (response && (response.msg || response.message)) || "Upload failed";
					fn.notify.warnbox(msg,"Oops...");
				}
			},
			error: function(){
				fn.notify.warnbox("Upload failed.","Oops...");
			}
		});
		return false;
	};
