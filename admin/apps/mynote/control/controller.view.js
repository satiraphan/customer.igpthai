
	
	const displayDate = (dateString) => {
		const targetDate = moment(dateString);
		const now = moment();

		// 1. ถ้าเป็นวันนี้
		if (targetDate.isSame(now, 'day')) {
			return targetDate.format('hh:mm A');
		}

		// 2. ถ้าเป็นเมื่อวาน
		if (targetDate.isSame(now.clone().subtract(1, 'days'), 'day')) {
			return "Yesterday";
		}

		// 3. ถ้าเป็นภายในปีเดียวกัน (แต่ไม่ใช่ วันนี้/เมื่อวาน)
		if (targetDate.isSame(now, 'year')) {
			return targetDate.format('MMM DD'); // เช่น Sep 30
		}

		// 4. ถ้าเกิน 1 ปีขึ้นไป
		return targetDate.format('DD/MM/YYYY'); // เช่น 30/12/2000
	};
	fn.app.mynote.list_note = function(config={}){
		let search = $("input[name=note_search]").val();
		let show_archived = $('input[name=show_archived]').is(':checked') ? true : false;
		let show_deleted = $('input[name=show_deleted]').is(':checked') ? true : false;
		App.startLoading();
		$.post('apps/mynote/xhr/action-list-note.php',{
			search:search,
			show_archived:show_archived,
			show_deleted:show_deleted
		},function(response){
			App.stopLoading();
			if(response.success){
				let s = '';
					for(i in response.notes){
						let archived = response.notes[i].archived;
						let pinned = response.notes[i].pinned;
						let deleted = response.notes[i].deleted;
						const result = displayDate(response.notes[i].created);
						s += '<a href="javascript:;" onclick="fn.app.mynote.load_note(this)"  data-id="' + response.notes[i].id + '" class="list-group-item list-group-item-action">';
							s += '<div class="media">';
								if(archived){
									s += '<div class="text-secondary text-muted"><i class="fa-regular fa-2xl fa-box-archive"></i></div>';
								}else if(pinned){
									s += '<div class="text-primary"><i class="fa-solid fa-2xl fa-thumbtack"></i></div>';
								}else if(pinned){
									s += '<div class="text-primary"><i class="fa-solid fa-2xl fa-thumbtack"></i></div>';
								}else if(deleted){
									s += '<div class="text-danger"><i class="fa-solid fa-2xl fa-trash"></i></div>';
								}else{	
									s += '<div class="text-dark"><i class="fa-light fa-2xl fa-note-sticky"></i></div>';
								}
								s += '<div class="media-body">';
									s += '<p class="list-note-tags text-dark m-0">';
									if(response.notes[i].tags.length > 0){
										for(j in response.notes[i].tags){
											s += '<span class="badge badge-secondary mr-1">'+response.notes[i].tags[j]+'</span>';
										}
									}
									s += '</p>';
									s += '<p class="msg-preview'+(archived?' text-muted':'')+(deleted?' text-muted':'')+'">' + response.notes[i].title + '</p>';
								s += '</div>';
								s += '<small class="msg-preview-time">' + result + '</small>';
							s += '</div>';
						s += ' </a>';
					}
				$('#note-list').html(s);
				if(config.default){
					$('#note-list a[data-id="'+config.default+'"]').addClass('active');
					fn.app.mynote.load_note($('#note-list a[data-id="'+config.default+'"]'),true);
				}
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},'json');
		return false;
	};

	function adjustHeightToWindow() {
        var windowHeight = $(window).height();
        var offsetTop = $('.note-editor').offset().top; // ตำแหน่งจากขอบบนถึงตัว Editor
        var paddingBottom = 98; // เว้นระยะขอบล่างไว้นิดหน่อยเพื่อความสวยงาม
        
        // คำนวณความสูงที่ควรจะเป็น: ความสูงจอ - ระยะห่างจากด้านบน - พื้นที่แถบเครื่องมือ
        var newHeight = windowHeight - offsetTop - paddingBottom;

        // ปรับความสูงขั้นต่ำ (ไม่ให้เล็กจนพิมพ์ไม่ได้)
        if (newHeight < 200) newHeight = 200;

        // สั่งปรับความสูงที่ตัวพื้นที่พิมพ์โดยตรง
        $('.note-editable').css('height', newHeight + 'px');
    }

	fn.app.mynote.load_note = function(element, new_note = false){
		$(element).addClass('active').siblings().removeClass('active');
		App.startLoading();
		$.post('apps/mynote/xhr/action-load-note.php',{note_id:$(element).data('id')},function(response){
			App.stopLoading();
			if(response.success){
				let archived = response.note.archived;

				let s = '';
				s += '<form name="form_mynote" onsubmit="return false;">';
				s += '<input type="hidden" name="id" value="'+response.note.id+'" tabindex="0">';
				s += '<div class="inner-main-header">';
					s += '<a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar">';
						s += '<i class="material-icons">arrow_forward_ios</i>';
					s += '</a>';
					s += '<div class="media">';
							s += '<label class="mt-2 mr-2">Title</label>';
							s += '<input class="form-control mr-2" name="title" value="'+response.note.title+'" onchange="fn.app.mynote.autosave();fn.app.mynote.list_note({default:'+response.note.id+'});" tabindex="0">';
						s += '<label class="mt-3 mr-2 small text-muted text-nowrap">Updated : <span id="note-updated">'+response.note.updated+'</span></label>';
					s += '</div>';
					s += '<button class="btn btn-icon btn-sm ml-auto" type="button" data-toggle="dropdown">';
						s += '<i class="material-icons">more_vert</i>';
					s += '</button>';
					s += '<div class="dropdown-menu dropdown-menu-right font-size-sm">';
						if(response.note.pinned){
							s += '<button class="dropdown-item has-icon text-secondary" type="button" onclick="fn.app.mynote.unpin('+response.note.id+')"><i class="material-icons mr-2">push_pin</i>Unpin</button>';
						}else{
							s += '<button class="dropdown-item has-icon text-primary" type="button" onclick="fn.app.mynote.pin('+response.note.id+')"><i class="material-icons mr-2">push_pin</i>Pin</button>';
						}
						if(archived){
							s += '<button class="dropdown-item has-icon text-secondary" type="button" onclick="fn.app.mynote.unarchive('+response.note.id+')"><i class="material-icons mr-2">archive</i>Unarchive</button>';
						}else{
							s += '<button class="dropdown-item has-icon text-primary" type="button" onclick="fn.app.mynote.archive('+response.note.id+')"><i class="material-icons mr-2">archive</i>Archive</button>';
						}

						s += '<button class="dropdown-item has-icon text-danger" type="button" onclick="fn.app.mynote.remove('+response.note.id+')"><i class="material-icons mr-2">delete</i>Delete Note</button>';
					s += '</div>';
					
					s += '<button class="btn btn-icon btn-sm btn-primary" type="button" onclick="fn.app.mynote.edit()">';
						s += '<i class="fa fa-floppy-disk"></i>';
					s += '</button>';
				s += '</div>';

				s += '<div class="inner-main-body p-0 bg-white">';
					s += '<div class="editor-wrapper">';
						s += '<textarea name="content" class="form-control" tabindex="0" data-timer="null" data-content="'+response.note.content+'"></textarea>';
					s += '</div>';
				s += '</div>';
				s += '<div class="inner-main-footer p-1">';
						s += '<select id="note_tag" name="tags[]" multiple="multiple" style="width:100%;">';
							for(i in response.tags){
								s += '<option value="'+response.tags[i]+'" selected="selected">'+response.tags[i]+'</option>';
							}
						s += '</select>';
				s += '</div>';

          
				s += '</form>';
				$('#note-screen').html(s);
				$("textarea[name=content]").val(response.note.content);
				$("textarea[name=content]").summernote({
				placeholder: 'เขียนเนื้อหาที่นี่...',
					height: 400,      // ห้ามระบุ height เป็นตัวเลข
					minHeight: 200,    // กำหนดความสูงเริ่มต้น (เช่น 200px)
					maxHeight: null,   // ปล่อยให้ยืดได้ไม่จำกัด หรือใส่ตัวเลขถ้าอยากให้หยุดยืดที่จุดหนึ่ง
					focus: true,
					tabsize: 2, // กำหนดระยะ Tab
					followingToolbar: true, // เปิดโหมดให้ Toolbar เลื่อนตาม (Default คือ true อยู่แล้ว)
					disableResizeEditor: true, // ปิดการลากปรับขนาดด้านล่าง
					callbacks: {
						onChange: function(contents, $editable) {
							if($editable.data('content') === contents) return;
							if(fn.app.mynote.const.autosave){
								clearTimeout($editable.data('timer'));
								$editable.data('timer', setTimeout(function() {
									fn.app.mynote.autosave();
									$editable.data('content', contents);
								}, fn.app.mynote.const.autosave_interval));
							}
							
						},
						onKeydown: function (e) {
							if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
								e.preventDefault(); // หยุดเบราว์เซอร์ไม่ให้ Save หน้าเว็บ
								fn.app.mynote.autosave(); // เรียกใช้ฟังก์ชันบันทึกโน้ต
							}
							
							if (e.keyCode === 9) { // 9 คือปุ่ม Tab
								e.preventDefault();
								// ใส่คำสั่งให้พิมพ์ช่องว่างแทนการย้าย Focus
								document.execCommand('insertText', false, '\t'); 
							}
						}
					}
				});

				adjustHeightToWindow();
				$(window).off('resize');
				$(window).on('resize', function() {
					adjustHeightToWindow();
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


				if(new_note){
					$("input[name=title]").select().focus();
				}
				
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},'json');
		return false;
	};
	

	fn.app.mynote.list_note();