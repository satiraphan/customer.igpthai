fn.ui.datatable.init();
$("#tblNote").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/note/store/store-note.php",	
		"data": function ( d ) {
			d.account = $('#tblNote').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center text-nowrap",	"sWidth": "80px"  },
		{"bSort":true					,"data":"title"	,"class":"text-center",	},
		{"bSort":true					,"data":"created"	,"class":"text-center",	},
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('note','view=edit&id="+data[0]+"')");
		//s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('note','view=lookup&id="+data[0]+"')");
		$("td", row).eq(0).html(s);
	}
});

fn.app.note.load_note = function(){
	var table = $('#tblNote').DataTable();
	var data = table.row('.selected').data();
	if(data){
		$.ajax({
			url: 'apps/note/view/view.note.php',
			type: 'GET',
			dataType: 'html',
			data: {
				id: data.id
			},
			success: function(html){
				$('#note_screen').html(html);
				
				//$("textarea[name=content]").val(response.note.content);
				$("textarea[name=content]").summernote({
				placeholder: 'เขียนเนื้อหาที่นี่...',
					height: 400,      // ห้ามระบุ height เป็นตัวเลข
					minHeight: 200,    // กำหนดความสูงเริ่มต้น (เช่น 200px)
					maxHeight: null,   // ปล่อยให้ยืดได้ไม่จำกัด หรือใส่ตัวเลขถ้าอยากให้หยุดยืดที่จุดหนึ่ง
					focus: true,
					tabsize: 2, // กำหนดระยะ Tab
					followingToolbar: true, // เปิดโหมดให้ Toolbar เลื่อนตาม (Default คือ true อยู่แล้ว)
					disableResizeEditor: true, // ปิดการลากปรับขนาดด้านล่าง
				});

				$('#note_tag').select2({
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
			}
		});
	}else{
		$('#note_screen').html('');
		var $selectElement = $("select[name=tags]");

		// 1. ยกเลิก Event ทั้งหมดที่ผูกไว้ (เช่น select2:select, select2:unselect)
		$selectElement.off(); 

		// 2. ทำลาย Select2 Instance เพื่อคืนค่ากลับเป็น HTML Select ปกติ
		$selectElement.select2('destroy');

		// (Optional) หากต้องการล้างค่าที่เลือกไว้ในช่องออกด้วย
		$selectElement.val(null).trigger('change');
		
	}
}

$('#tblNote tbody').on( 'click', 'tr', function () {
	if($(this).hasClass('selected')){
		$(this).removeClass('selected');
		$('#note_screen').html('');
	}else{
		$('#tblNote tbody').find('tr.selected').removeClass('selected');
		$(this).toggleClass('selected');
		fn.app.note.load_note();
	}
});

