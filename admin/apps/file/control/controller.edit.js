	fn.app.file.edit = function(){
		$.post("apps/file/xhr/action-edit.php",$("form[name=form_edit_file]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	$('select[name="tags[]"]').select2({
		tags: true, // อนุญาตให้เพิ่มค่าใหม่ได้
		tokenSeparators: [',', ' ','/t'], // พิมพ์ , หรือ Space เพื่อสร้าง Tag
		ajax: {
			url: 'apps/tag/xhr/action-get-tags.php', // URL ของ API ที่ใช้ค้นหา
			dataType: 'json',
			delay: 250, // หน่วงเวลาพิมพ์ 250ms เพื่อลดภาระ Server
			data: function (params) {
				return {
					key: params.term // ส่งค่าที่พิมพ์ไปที่ตัวแปร q
				};
			},
			processResults: function (data) {
				let data_set = [];
				for(i in data.results){
					data_set.push({
						id: data.results[i].text,
						text: data.results[i].text
					});
				}
				return {
					results: data_set // รูปแบบ JSON ที่ส่งกลับมาต้องมี id และ text
				};
			}
		},
		insertTag: function (data, tag) {
			// เพิ่มคำว่า (ใหม่) ต่อท้ายเพื่อให้ User รู้ว่ากำลังจะเพิ่ม Tag ใหม่
			tag.text = tag.text + " (สร้างใหม่)";
			data.push(tag);
		}
	});