
	fn.app.database.district.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/geography/dialog.district.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_district"});
				$("select[name=country]").select2({width:"100%"});
				fn.app.contact.address.auto_city(
					"form[name=form_editdistrict] select[name=country]",
					"form[name=form_editdistrict] select[name=city]");
			}	
		});
	};
	
	fn.app.database.district.edit = function(){
		$.post('apps/database/xhr/geography/action-edit-district.php',$('form[name=form_editdistrict]').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_district").modal('hide');
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
			
		},'json');
		return false;
	};
