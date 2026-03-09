
fn.app.mail.gmail._loadMailRequest = null;

fn.app.mail.gmail.is_valid_msg_id = function(id) {
    return /^[A-Za-z0-9_-]{10,200}$/.test((id || '').toString());
};

fn.app.mail.gmail.sanitize_mail_html = function(unsafeHtml) {
    if( !unsafeHtml ) return '';
    const parser = new DOMParser();
    const doc = parser.parseFromString('<div>' + unsafeHtml + '</div>', 'text/html');
    const root = doc.body.firstElementChild || doc.body;
    const blockedSelector = 'script,style,iframe,object,embed,form,meta,link,base';
    root.querySelectorAll(blockedSelector).forEach(function(node){ node.remove(); });
    root.querySelectorAll('*').forEach(function(el){
        for (const attr of Array.from(el.attributes)) {
            const name = attr.name.toLowerCase();
            const value = (attr.value || '').trim();
            if( name.indexOf('on') === 0 ){
                el.removeAttribute(attr.name);
                continue;
            }
            if( ['href','src','xlink:href','formaction','action'].indexOf(name) >= 0 ){
                if( !/^(https?:|mailto:|data:image\/|cid:|\/|#)/i.test(value) ){
                    el.removeAttribute(attr.name);
                }
            }
        }
    });
    return root.innerHTML;
};

fn.app.mail.gmail.load_mail = function(id) {
    id = (id || '').toString().trim();
    if( !fn.app.mail.gmail.is_valid_msg_id(id) ){
        fn.notify.warnbox('Invalid message id');
        return;
    }
    if( fn.app.mail.gmail._loadMailRequest && fn.app.mail.gmail._loadMailRequest.readyState !== 4 ){
        fn.app.mail.gmail._loadMailRequest.abort();
    }
    const n = new Noty({
        text: '<i class="fa fa-refresh fa-spin"></i> กำลังดึงข้อมูลจาก Gmail...',
        type: 'info',
        layout: 'topRight',
        timeout: false, // สำคัญ: ตั้งเป็น false เพื่อไม่ให้มันปิดเอง
        progressBar: false,
        closeWith: [] // ป้องกันไม่ให้ user กดปิดเองได้ก่อนเสร็จ
    }).show();
    fn.app.mail.gmail._loadMailRequest = $.ajax({
        url: 'apps/mail/xhr/action-gmail-load-mail.php',
        dataType: 'json',
        data: {msg_id: id},
        type: 'post',
        success: function(response){
            if( response.success ){
                let mail = response.data;
                $("#email-screen").data("msg_id", mail.id );
                $("#email-screen .mail-item-from").text( mail.from || '' );
                $("#email-screen .mail-item-to").text( mail.to || '' );
                $("#email-screen .mail-item-date").text( mail.date || '' );
                $("#email-screen .mail-item-subject").text( mail.subject || '' );
                $("#email-screen .mail-item-content").html( fn.app.mail.gmail.sanitize_mail_html(mail.content || '') );
                $("#email-screen img.mail-item-avatar").attr('src', mail.avatar );
            }else{
                fn.alert.error( response.msg );
            }
        },
        error: function(xhr, status){
            if(status !== 'abort'){
                fn.notify.warnbox('ไม่สามารถโหลดอีเมลได้ กรุณาลองใหม่');
            }
        },
        complete: function(){
            n.close();
        }
    });
};

fn.app.mail.gmail.star = function(me) {
    const id = $("#email-screen").data("msg_id");
    let btn = $(me);
    if( btn.hasClass("active") ){
        fn.app.mail.gmail.star_mail( id );
    }else{
        fn.app.mail.gmail.unstar_mail( id );
    }
};

fn.app.mail.gmail.star_mail = function(id) {
    const n = new Noty({
        text: '<i class="fa fa-refresh fa-spin"></i> ส่งคำสั่งติดดาว Gmail...',
        type: 'info',
        layout: 'topRight',
        timeout: false, // สำคัญ: ตั้งเป็น false เพื่อไม่ให้มันปิดเอง
        progressBar: false,
        closeWith: [] // ป้องกันไม่ให้ user กดปิดเองได้ก่อนเสร็จ
    }).show();
    $.ajax({
        url: 'apps/mail/xhr/action-gmail-star.php',
        dataType: 'json',
        data: {msg_id: id},
        type: 'post',
        success: function(response){
            if( response.success ){
                n.close();
            }else{
                fn.alert.error( response.msg );
            }
        }
    });
};

fn.app.mail.gmail.unstar_mail = function(id) {
    const n = new Noty({
        text: '<i class="fa fa-refresh fa-spin"></i> ส่งคำสั่งเอาดาวออก Gmail...',
        type: 'info',
        layout: 'topRight',
        timeout: false, // สำคัญ: ตั้งเป็น false เพื่อไม่ให้มันปิดเอง
        progressBar: false,
        closeWith: [] // ป้องกันไม่ให้ user กดปิดเองได้ก่อนเสร็จ
    }).show();
    $.ajax({
        url: 'apps/mail/xhr/action-gmail-unstar.php',
        dataType: 'json',
        data: {msg_id: id},
        type: 'post',
        success: function(response){
            if( response.success ){
                n.close();
            }else{
                fn.alert.error( response.msg );
            }
        }
    });
};

fn.app.mail.gmail.send_mail = function() {
    const n = new Noty({
        text: '<i class="fa fa-refresh fa-spin"></i> กำลังส่งอีเมล...',
        type: 'info',
        layout: 'topRight',
        timeout: false, // สำคัญ: ตั้งเป็น false เพื่อไม่ให้มันปิดเอง
        progressBar: false,
        closeWith: [] // ป้องกันไม่ให้ user กดปิดเองได้ก่อนเสร็จ
    }).show();
    const form = $("form[name=form-email-compose]");
    $.ajax({
        url: 'apps/mail/xhr/action-gmail-send-mail.php',
        dataType: 'json',
        data: form.serialize(),
        type: 'post',
        success: function(response){   
            if( response.success ){
                n.close();
                $("#composeModal").modal('hide');
                fn.app.mail.gmail.list_mail('SENT');
                fn.notify.successbox( response.msg );
            }
            else{
                n.close();
                fn.notify.warnbox( response.msg );
            }       
        }
    });
};

fn.app.mail.gmail.list_mail_next_page = function() {
    let page = $("#main-inbox").data("paginate-page") || 1;
    let pageTokens = $("#main-inbox").data("paginate-pagetoken") || {};
    let nextPage = page + 1;
    if( pageTokens[nextPage] === undefined ){
        return;
    }
    $("#main-inbox").data("paginate-page", nextPage);
    let label = $(".btn-mail-label.active").data('label') || 'INBOX';
    fn.app.mail.gmail.list_mail(label);
};

fn.app.mail.gmail.list_mail_prev_page = function() {
    let page = $("#main-inbox").data("paginate-page") || 1;
    if(page > 1){
        page--;
        $("#main-inbox").data("paginate-page", page);
        let label = $(".btn-mail-label.active").data('label') || 'INBOX';
        fn.app.mail.gmail.list_mail(label);
    } 
}

fn.app.mail.gmail.list_mail = function( label,button ) {
    if( label === undefined ){label = $("#main-inbox").data('label') || 'INBOX';}
    let per_page = $("#main-inbox").data("paginate-perpage") || 10;
    let page = $("#main-inbox").data("paginate-page") || 1;
    
    if( button ){
        page = 1;
        $("#main-inbox").data("label", label);
        $("#main-inbox").data("paginate-page", page);
        $("#main-inbox").data("paginate-pagetoken", {});
        $(".btn-mail-label").removeClass("active");
        $(button).addClass("active");
    }
    
    let pageTokens = $("#main-inbox").data("paginate-pagetoken") || {};
    let pageToken = pageTokens[page] || null;
    App.startLoading();
    $.ajax({
        url: 'apps/mail/xhr/action-gmail-list-mail.php',
        data: {label: label,max: per_page,pageToken: pageToken,search: $("input[name=main-inbox-search]").val()},
        dataType: 'json',
        type: 'post',
        success: function(response){
            if( response.success ){
                delete pageTokens[page + 1];
                if( response.nextPageToken ){
                    pageTokens[page + 1] = response.nextPageToken;
                }
                $("#main-inbox").data("paginate-pagetoken", pageTokens);
                if(response.caption !== undefined)$("#main-inbox .main-inbox-label").text(response.caption);
                if(response.unreadMessages !== undefined)$("#main-inbox .main-inbox-label-unread").html( response.unreadMessages + ' unread messages' );
                if(response.totalMessages !== undefined){
                    let start = ((page - 1) * per_page) + 1;
                    let end = Math.min(page * per_page, response.totalMessages);
                    $("#main-inbox .main-inbox-pageinfo").text( start + '-' + end + ' of ' + response.totalMessages );
                    if(page == 1){$("#btn-mail-prev").prop('disabled', true);}else{$("#btn-mail-prev").prop('disabled', false);}
                }
                $("#btn-mail-next").prop('disabled', !response.nextPageToken);
                let s = '';
                for( let i in response.data ){
                    let item = response.data[i];
                    let mail_id = item.id;
                    let unread = item.labels.indexOf('UNREAD') >= 0 ? true : false;
                    let li_class = 'list-group-item mail-item'+(unread?' unread ':'')+(item.stared?'starred ':'');
                    s += '<li data-id="'+mail_id+'" class="'+li_class+'">';
                    //s += '" onclick="fn.app.mail.gmail.load_mail(\''+item.id+'\')" data-id="'+item.id+'">';
                    //s += '" data-toggle="collapse" data-target="#mail-content-'+mail_id+'" aria-expanded="false" aria-controls="mail-content-'+mail_id+'">';
                    s += '  <div class="media">';
                    s += '    <div class="d-flex">';
                    s += '      <div class="custom-control custom-control-nolabel custom-checkbox mr-2">';
                    s += '        <input type="checkbox" class="custom-control-input" id="inbox-'+mail_id+'">';
                    s += '        <label for="inbox-'+mail_id+'" class="custom-control-label"></label>';
                    s += '      </div>';
                    s += '      <button type="button" class="btn-starred btn btn-icon btn-xs mr-2 '+(item.stared?'active':'')+'" data-toggle="button" aria-pressed="'+(item.stared?'true':'false')+'">';
                    s += '        <i class="fa fa-star"></i>';
                    s += '      </button>';
                    s += '    </div>';
                    s += '    <div class="media-body" data-toggle="collapse" data-target=".mail-content">';
                    s += '      <div class="mail-item-from">';
                    s +=            item.from;
                    s += '      </div>';
                    s += '      <div class="mail-item-subject"> ';
                    if( item.labels.indexOf('UNREAD') >= 0 ){
                        s += '<span class="badge badge-danger">New</span> ';
                    }
                    s +=            item.subject;
                    s += '        <span class="mail-item-summary text-secondary"> - '+item.snippet+'</span>';
                    s += '      </div>';
                    s += '    </div>';
                    s += '    <div class="d-flex small text-muted mt-2 mt-sm-0 align-self-start align-self-sm-center"> <time>'+item.date+'</time>';
                    s += '    </div>';
                    s += '  </div>';
                    s += '</li>';
                }
                
                $("#mail-item-wrapper").html(s);
                App.stopLoading();

            }else{
                fn.alert.error( response.msg );
            }
        }
    });
};




fn.app.mail.gmail.list_label = function() {
    const n = new Noty({
        text: '<i class="fa fa-refresh fa-spin"></i> กำลังดึงข้อมูลจาก Gmail...',
        type: 'info',
        layout: 'topRight',
        timeout: false, // สำคัญ: ตั้งเป็น false เพื่อไม่ให้มันปิดเอง
        progressBar: false,
        closeWith: [] // ป้องกันไม่ให้ user กดปิดเองได้ก่อนเสร็จ
    }).show();
    $.ajax({
        url: 'apps/mail/xhr/action-gmail-list-label.php',
        dataType: 'json',
        type: 'post',
        success: function(response){
            if( response.success ){

                for( let i in response.aLabelMain ){
                    let label = response.aLabelMain[i];
                    let badge = 'badge-primary';

                    let item = $("[data-label='"+label[0]+"']");
                    item.data('caption', label[1]);
                    item.data('total', label[4]);
                    item.data('unread', label[3]);
                    if(item.find('.badge').length > 0 ){
                        if(label[3] == 0){
                            item.find('.badge').remove();
                        }else{
                            item.find('.badge').text(label[3]);
                        }
                    }else{
                        let s = '<span data-label="'+label[0]+'" data-total="'+label[4]+'" data-unread="'+label[3]+'" data-caption="'+label[1]+'" class="badge badge-pill '+badge+' ml-auto">'+label[3]+'</span>';
                        item.append(s);
                    }
                }
                for( let i in response.aLabelCategory ){
                    let label = response.aLabelCategory[i];
                    let badge = 'badge-secondary';
                    let item = $("[data-label='"+label[0]+"']");
                    item.data('total', label[4]);
                    item.data('unread', label[3]);
                    item.data('caption', label[1]);
                    if(item.find('.badge').length > 0 ){
                        if(label[3] == 0){
                            item.find('.badge').remove();
                        }else{
                            item.find('.badge').text(label[3]);
                        }
                    }else{
                        let s = '<span data-label="'+label[0]+'" data-total="'+label[4]+'" data-unread="'+label[3]+'" data-caption="'+label[1]+'" class="badge badge-pill '+badge+' ml-auto">'+label[3]+'</span>';
                        item.append(s);
                    }
                }
                for( let i in response.aLabelUser ){
                    let label = response.aLabelUser[i];
                    let s = '<button class="btn btn-xs btn-light has-icon" type="button"><i class="mr-1" data-feather="tag"></i>'+label[1]+'</button>';
                    $(".list-with-gap").append(s);
                }

                n.close();

            }else{
                fn.alert.error( response.msg );
            }
        }
    });
};

	fn.app.mail.gmail.dialog_remove = function() {
        let selected = [];
        $(".mail-item input[type=checkbox]:checked").each(function(){
            selected.push( $(this).closest(".mail-item").data("id") );
        });
        if( selected.length == 0 ){
            fn.notify.warnbox("กรุณาเลือกอีเมลที่ต้องการลบอย่างน้อย 1 ฉบับ");
            return;
        }

		$.ajax({
			url: "apps/mail/view/dialog.remove.php",
			type: "POST",
			data: {item:selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_mail"});
			}
		});
	};

	fn.app.mail.gmail.remove = function(){
		$.post("apps/mail/xhr/action-gmail-remove.php",$("form#form-remove-mail").serialize(), function(response){
			if(response.success){
                fn.app.mail.gmail.list_mail();
				$("#dialog_remove_mail").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

    fn.app.mail.gmail.set_label = function(label) {
       let selected = [];
       let currentLabel = $(".btn-mail-label.active").data('label') || 'INBOX';

       if( label == currentLabel ){
            fn.notify.warnbox("กรุณาเลือกป้ายกำกับที่แตกต่างจากปัจจุบัน");
            return;
       }
        $(".mail-item input[type=checkbox]:checked").each(function(){
            selected.push( $(this).closest(".mail-item").data("id") );
        });
        if( selected.length == 0 ){
            fn.notify.warnbox("กรุณาเลือกอีเมลที่ต้องการลบอย่างน้อย 1 ฉบับ");
            return;
        }

		$.post("apps/mail/xhr/action-gmail-set-label.php",{item:selected,label:label}, function(response){
			if(response.success){
                fn.app.mail.gmail.list_mail();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};


fn.app.mail.gmail.list_label();
fn.app.mail.gmail.list_mail('INBOX','.btn-mail-label[data-label="INBOX"]');

$(document).off('click.mailOpen').on('click.mailOpen', '#mail-item-wrapper .mail-item .media-body', function(e){
    if( $(e.target).closest('a,button,input,label,.custom-control,.btn-starred').length ){return;}
    let id = $(this).closest('.mail-item').data('id');
    if( !fn.app.mail.gmail.is_valid_msg_id(id) ){return;}
    fn.app.mail.gmail.load_mail(id);
});


