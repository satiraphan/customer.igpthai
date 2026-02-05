	fn.app.page.edit = function(){
		$.post("apps/page/xhr/action-edit.php",$("form[name=form_edit_page]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
	fn.app.page.layout.load_layout = function(layoutData) {
		
		if(!layoutData || !layoutData.rows) return;
		
		let contents = $("#designer-view").data("contents");

		// วน loop สร้าง rows
		layoutData.rows.forEach(function(rowData, rowIndex) {
			let s = '';
			s += '<div class="block-row">';
				s += '<div class="designer-row">';
					s += '<div class="block-actions">';
						s += '<div class="move-anchor"><i class="fa-solid fa-arrows-alt"></i></div>';
						s += '<button class="action-btn" onclick="fn.app.page.layout.remove_row(this)" title="ลบ"><i class="fa-solid fa-trash"></i></button>';
						s += '<select class="" onchange="fn.app.page.layout.change_column(this)" title="เปลี่ยนคอลัมน์">';
							s += '<option value="12" '+(rowData.layout=='12'?'selected':'')+'>1 คอลัมน์</option>';
							s += '<option value="6-6" '+(rowData.layout=='6-6'?'selected':'')+'>2 คอลัมน์ เท่ากัน</option>';
							s += '<option value="4-4-4" '+(rowData.layout=='4-4-4'?'selected':'')+'>3 คอลัมน์ เท่ากัน</option>';
							s += '<option value="8-4" '+(rowData.layout=='8-4'?'selected':'')+'>2 คอลัมน์ 8:4</option>';
							s += '<option value="4-8" '+(rowData.layout=='4-8'?'selected':'')+'>2 คอลัมน์ 4:8</option>';
							s += '<option value="3-3-3-3" '+(rowData.layout=='3-3-3-3'?'selected':'')+'>4 คอลัมน์ เท่ากัน</option>';
						s += '</select>';
					s += '</div>';
					s += '<div class="row block-content">';
					
					// วน loop สร้าง columns
					if(rowData.columns && rowData.columns.length > 0) {
						rowData.columns.forEach(function(colData) {
							s += '<div class="col-'+colData.width+' designer-col">';
							// สร้าง content blocks
							s += '<div class="content-block col-12 no-move">';
								s += '<div class="hr-plus">';
									s += '<button type="button" class="btn-plus" onclick="fn.app.page.layout.append_content(this)">+</button>';
								s += '</div>';
							s += '</div>';
							if(colData.contents && colData.contents.length > 0) {
								colData.contents.forEach(function(contentItem) {
									s += fn.app.page.layout.content.create(contentItem);
								});
							}
							
							// เพิ่ม default block สำหรับเพิ่ม content ใหม่
							
							s += '</div>'; // close designer-col
						});
					}
					
					s += '</div>'; // close block-content
				s += '</div>'; // close designer-row
				s += '<div class="hr-plus"><button type="button" class="btn-plus" onclick="fn.app.page.layout.append_row(this)">+</button></div>';
			s += '</div>'; // close block-row
			
			$("#designer-view").append(s);
		});
		
		// เพิ่ม row แรกถ้ายังไม่มี
		if(!layoutData.rows || layoutData.rows.length === 0) {
			let defaultBlock = '<div class="hr-plus"><button type="button" class="btn-plus" onclick="fn.app.page.layout.append_row(this)">+</button></div>';
			$("#designer-view").append(defaultBlock);
		}
		
		// Initialize sortable หลังจาก load layout เสร็จ
		if(typeof fn.app.page.layout.init_content_sortable === 'function') {
			fn.app.page.layout.init_content_sortable();
		}
	};

	fn.app.page.save_layout = function(id){
		let layout = {
			rows: []
		};

		// วน loop ผ่าน block-row ทั้งหมด
		$("#designer-view .block-row").each(function(rowIndex) {
			let $row = $(this);
			let $columns = $row.find('.designer-col');
			
			// หา layout type จาก select
			let layoutType = $row.find('.block-actions select').val();
			
			let rowData = {
				layout: layoutType,
				columns: []
			};

			// วน loop ผ่านแต่ละ column
			$columns.each(function(colIndex) {
				let $col = $(this);
				let colWidth = '';
				
				// หาความกว้างของ column
				if($col.hasClass('col-12')) colWidth = '12';
				else if($col.hasClass('col-8')) colWidth = '8';
				else if($col.hasClass('col-6')) colWidth = '6';
				else if($col.hasClass('col-4')) colWidth = '4';
				else if($col.hasClass('col-3')) colWidth = '3';

				let columnData = {
					width: colWidth,
					contents: []
				};

				// วน loop ผ่าน content-block ในแต่ละ column (ยกเว้น .no-move)
				$col.find('.content-block:not(.no-move)').each(function(contentIndex) {
					let $content = $(this);
					let content_id = $content.find('select[name="content_id"]').val();
					let type = $content.find('select[name="type"]').val();
					
					columnData.contents.push({
						type: type,
						content_id: content_id,
						order: contentIndex
					});
				
				});

				rowData.columns.push(columnData);
			});

			layout.rows.push(rowData);
		});

		//console.log('Layout JSON:', JSON.stringify(layout, null, 2));
		$.post("apps/page/xhr/action-save-layout.php",{id:id, layout: JSON.stringify(layout)},function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	fn.app.page.layout.load_content = function() {
		let data = [];
		$.post("apps/page/xhr/action-load-content.php",function(response){
			if(response.success){
				for(i in response.contents){
					data.push({
						id:response.contents[i].id,
						type:response.contents[i].type,
						code:response.contents[i].code,
						title:response.contents[i].title,
						text:response.contents[i].code + " : " + response.contents[i].title + " (" + response.contents[i].type + ")"
					});
				}
				$("#designer-view").data("contents",data);
			}else{
				fn.notify.warnbox(response.msg,"Oops...");	
			}
		},"json");
		return false;
	}

	fn.app.page.layout.remove_content = function(me) {
		fn.dialog.confirmbox("ลบคอนเทนต์ ?","ยืนยันการลบคอนเทนต์ออกจากรายการ",function(){
			let item = $(me).closest('.content-block');
			item.remove();
			
			// Re-initialize sortable หลังจากลบ content (เพื่ออัพเดท min-height)
			if(typeof fn.app.page.layout.init_content_sortable === 'function') {
				fn.app.page.layout.init_content_sortable();
			}
		});
	};

	fn.app.page.layout.remove_row = function(me) {
		fn.dialog.confirmbox("ลบแถวนี้ ?","ยืนยันการลบแถวนี้ออกจากหน้าเพจ",function(){
			let desginerrow = $(me).closest('.block-row');
			let hrplus = desginerrow.next('.hr-plus');
			desginerrow.remove();
			hrplus.remove();
		});
	};


	fn.app.page.layout.content.create = function(data) {
		let contents = $("#designer-view").data("contents");
		let type = (typeof data !== 'undefined') ? data.type : 'content';
		var s = '';
		s += '<div class="content-block col-12">';
			s += '<div class="content-item">';
				s += '<div class="block-actions">';
						s += '<div class="move-anchor-content"><i class="fa-solid fa-arrows-alt"></i></div>';
						s += '<button class="action-btn" onclick="fn.app.page.layout.remove_content(this)" title="ลบ"><i class="fa-solid fa-trash"></i></button>';
						s += '<select name="type" class="form-control">';
							s += '<option value="content"'+(type === 'content' ? ' selected' : '')+'>Content</option>';
							s += '<option value="article"'+(type === 'article' ? ' selected' : '')+'>บทความ</option>';
							s += '<option value="carousel"'+(type === 'carousel' ? ' selected' : '')+'>Carousel</option>';
						s += '</select>';
				s += '</div>';
				s += '<div class="row">';
						s += '<div class="col-12">';	
						s += '<select name="content_id" class="form-control">';
							s += '<option value="">-- เลือกเนื้อหา --</option>';
							for(i in contents){
								let selected = (typeof data !== 'undefined' && contents[i].id == data.content_id) ? 'selected' : '';
								s += '<option value="'+contents[i].id+'" '+selected+'>'+contents[i].text+'</option>';
							}
						s += '</select>';
					s += '</div>';
				s += '</div>';
			s += '</div>';
			s += '<div class="hr-plus"><button type="button" class="btn-plus" onclick="fn.app.page.layout.append_content(this)">+</button></div>';
		s += '</div>';
		return s;
	};

	fn.app.page.layout.append_content = function(me) {
		var s = fn.app.page.layout.content.create();
		$(me).closest('.content-block').after(s);

		// Re-initialize sortable หลังจากเพิ่ม content
		if(typeof fn.app.page.layout.init_content_sortable === 'function') {
			fn.app.page.layout.init_content_sortable();
		}
	};

	fn.app.page.layout.change_column = function(me) {
		let value = $(me).val();
		fn.dialog.confirmbox("ต้องการที่จะเปลี่ยน Layout ?","การเปลี่ยนแปลงจะต้องใส่ความระมัดระวัง เนื่องจากอาจส่งผลต่อการแสดงผลของหน้าเพจ",function(){
			let default_block = '';
			default_block += '<div class="content-block col-12 no-move">';
				default_block += '<div class="hr-plus">';
					default_block += '<button type="button" class="btn-plus" onclick="fn.app.page.layout.append_content(this)">+</button>';
				default_block += '</div>';
			default_block += '</div>';
			var s = '';
			switch(value){
				case '12':
					s += '<div class="col-12 designer-col col-12">'+default_block+'</div>';
					break;
				case '6-6': 
					s += '<div class="col-6 designer-col">'+default_block+'</div>';
					s += '<div class="col-6 designer-col">'+default_block+'</div>';
					break;
				case '4-4-4': 
					s += '<div class="col-4 designer-col">'+default_block+'</div>';
					s += '<div class="col-4 designer-col">'+default_block+'</div>';
					s += '<div class="col-4 designer-col">'+default_block+'</div>';
					break;
				case '8-4': 
					s += '<div class="col-8 designer-col">'+default_block+'</div>';
					s += '<div class="col-4 designer-col">'+default_block+'</div>';
					break;
				case '4-8': 
					s += '<div class="col-4 designer-col">'+default_block+'</div>';
					s += '<div class="col-8 designer-col">'+default_block+'</div>';
					break;
				case '3-3-3-3': 
					s += '<div class="col-3 designer-col">'+default_block+'</div>';
					s += '<div class="col-3 designer-col">'+default_block+'</div>';
					s += '<div class="col-3 designer-col">'+default_block+'</div>';
					s += '<div class="col-3 designer-col">'+default_block+'</div>';
					break;
			}
			$(me).closest('.designer-row').find('.block-content').html(s);
			
			// Re-initialize sortable หลังจากเปลี่ยน column
			if(typeof fn.app.page.layout.init_content_sortable === 'function') {
				fn.app.page.layout.init_content_sortable();
			}
		});
	};

	fn.app.page.layout.append_row = function(hline){
		let s = '';
		s += '<div class="block-row">';
			s += '<div class="designer-row">';
				s += '<div class="block-actions">';
					s += '<div class="move-anchor"><i class="fa-solid fa-arrows-alt"></i></div>';
					s += '<button class="action-btn" onclick="fn.app.page.layout.remove_row(this)" title="ลบ"><i class="fa-solid fa-trash"></i></button>';
					s += '<select class="" onchange="fn.app.page.layout.change_column(this)" title="เปลี่ยนคอลัมน์">';
						s += '<option value="12">1 คอลัมน์</option>';
						s += '<option value="6-6">2 คอลัมน์ เท่ากัน</option>';
						s += '<option value="4-4-4">3 คอลัมน์ เท่ากัน</option>';
						s += '<option value="8-4">2 คอลัมน์ 8:4</option>';
						s += '<option value="4-8">2 คอลัมน์ 4:8</option>';
						s += '<option value="3-3-3-3">4 คอลัมน์ เท่ากัน</option>';
					s += '</select>';
				s += '</div>';
				s += '<div class="row block-content">';
					s += '<div class="col-12 designer-col" data-col="12">';
						s += '<select class="form-control">';
							s += '<option value="header">Header</option>';
							s += '<option value="footer">Footer</option>';
							s += '<option value="sidebar">Sidebar</option>';
							s += '<option value="content">Content</option>';
						s += '</select>';
					s += '</div>';
				s += '</div>';
			s += '</div>';
			s += '<div class="hr-plus"><button type="button" class="btn-plus" onclick="fn.app.page.layout.append_row(this)">+</button></div>';
		s += '</div>';
		$(hline).parent().after(s);
		
		// Re-initialize sortable หลังจากเพิ่ม row
		if(typeof fn.app.page.layout.init_content_sortable === 'function') {
			fn.app.page.layout.init_content_sortable();
		}
	};




	// Function สำหรับ initialize sortable บน content blocks
	fn.app.page.layout.init_content_sortable = function() {
		// ทำลาย sortable เก่าก่อน (ถ้ามี)
		try {
			$(".designer-col").sortable("destroy");
		} catch(e) {}
		
		// สร้าง sortable ใหม่บนแต่ละ designer-col
		$(".designer-col").sortable({
			items: ".content-block:not(.no-move)",
			handle: ".move-anchor-content",
			connectWith: ".designer-col",  // เชื่อมต่อทุก designer-col เข้าด้วยกัน
			cursor: "move",
			placeholder: "sortable-placeholder",
			tolerance: "pointer",  // ใช้ pointer สำหรับการตรวจจับ drop zone
			dropOnEmpty: true,     // อนุญาตให้ drop ลงใน container ว่าง
			//opacity: 0.8
		});
		
		// เพิ่ม min-height ให้ designer-col ที่ว่างเปล่า
		$(".designer-col").each(function() {
			if($(this).find(".content-block:not(.no-move)").length === 0) {
				$(this).css("min-height", "80px");
			} else {
				$(this).css("min-height", "");
			}
		});
	};

	fn.app.page.layout.load_content();
	fn.app.page.layout.load_layout($("#designer-view").data("layout"));

	// Sortable สำหรับ block-row
	$("#designer-view").sortable({
		items: ".block-row",
		handle: ".move-anchor",
		cursor: "move",
		//opacity: 0.8
	});

	// Initialize content sortable
	fn.app.page.layout.init_content_sortable();
