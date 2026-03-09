<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	//$os->initial_lang("lang");
	$panel = new ipanel($dbc,$os->auth);
	
	$panel->setApp("mynote","My Note");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');
	
    /*
	$panel->setMeta(array(
		array('view' ,$os->tr('main.appname'),	'far fa-eye'),
		array('add'	 ,$os->tr('main.add'),	'far fa-pen'),
		array('edit' ,$os->tr('main.edit'),	'far fa-cut')
	));
	$panel->PageBreadcrumb();
	$panel->EchoViewInterface();
    */
?>
<div class="inner-wrapper chat-wrapper">
    <!-- Chat sidebar -->
    <div class="inner-sidebar">
        <!-- Chat sidebar header -->
        <div class="inner-sidebar-header">
            <div class="mr-3 collapsible collapse">
                <a href="#" class="nav-link nav-icon" data-toggle="collapse" data-target=".collapsible">
                    <i class="material-icons">chevron_left</i>
                </a>
            </div>
            <form class="form-inline flex-nowrap">
                <span class="input-icon mr-1">
                    <i class="material-icons">search</i>
                    <input name="note_search" type="text" onkeyup="fn.app.mynote.list_note()" placeholder="Search..." class="form-control w-100 bg-gray-100 border-gray-100">
                </span>
                <a  class="btn btn-outline-dark" id="btnSettings" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                <div class="dropdown-menu dropdown-menu-right font-size-sm pl-2" id="myDropdownMenu">
                    <div class="custom-control custom-checkbox dropdown-item">
                        <input type="checkbox" name="show_archived" class="custom-control-input" id="show_archived" onchange="fn.app.mynote.list_note()">
                        <label class="custom-control-label" for="show_archived"> Show Archive</label>
                    </div>
                    <div class="custom-control custom-checkbox dropdown-item">
                        <input type="checkbox" name="show_deleted" class="custom-control-input" id="show_deleted" onchange="fn.app.mynote.list_note()">
                        <label class="custom-control-label" for="show_deleted"> Show Deleted</label>
                    </div>
                </div>
            </form>
        </div>
        <!-- /Chat sidebar header -->

        <div class="inner-sidebar-body p-0">
            <div class="h-100" data-simplebar>
                <div class="list-group list-group-borderless list-group-flush collapsible collapse show" id="note-list">
                    <!-- สำหรับใส่รายการโน้ต -->
                </div>
            </div>
        </div>

        <!-- Chat sidebar footer -->
        <div class="inner-sidebar-footer">
         <button class="btn btn-success btn-block" type="button" onclick="fn.app.mynote.create()">สร้าง Note</button>
        </div>
    <!-- /Chat sidebar footer -->

</div>
<!-- /Chat sidebar -->


<div id="note-screen" class="inner-main">
    <div class="inner-main-header">
        <a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar">
            <i class="material-icons">arrow_forward_ios</i>
        </a>
        <lable>Select Note</lable>
    </div>
</div>
<script>
	var plugins = [
		'apps/note/include/interface.js',
		'apps/mynote/include/interface.js',
		'plugins/datatables/dataTables.bootstrap4.min.css',
		'plugins/datatables/responsive.bootstrap4.min.css',
		'plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js',
		'plugins/select2/css/select2.min.css',
		'plugins/select2/js/select2.min.js',
		'plugins/moment/moment.min.js',
        'plugins/autosize/autosize.min.js',
		'plugins/summernote/summernote-bs4.min.css',
		'plugins/summernote/summernote-bs4.min.js'
	];
	
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll()
		<?php
		switch($panel->getView()){
			case "view":
				include "control/controller.view.js";

				if($os->allow("mynote","add"))include "control/controller.add.js";
				if($os->allow("mynote","edit"))include "control/controller.edit.js";
				if($os->allow("mynote","remove"))include "control/controller.remove.js";
                

				break;
		}


       
		?>

        $('#btnSettings').dropdown({
            autoClose: false
        });

        // สำหรับ Bootstrap 4 (ถ้าคำสั่งบนไม่ทำงาน) ให้ใช้การดัก Event แทน:
        $(document).on('click.bs.dropdown.data-api', '.dropdown-menu', function (e) {
            e.stopPropagation(); // ไม่ให้ปิดเมื่อคลิกข้างใน
        });

        // ส่วนการกดด้านนอกแล้วไม่ให้ปิด:
        $(document).on('hide.bs.dropdown', function (e) {
            // ตรวจสอบว่าถ้าเป็นการคลิกข้างนอก ให้ยกเลิกการปิด (Prevent Default)
            // ยกเว้นว่ากดที่ปุ่ม cog (ซึ่ง Bootstrap จะจัดการ toggle ให้เอง)
            if (e.clickEvent && !$(e.clickEvent.target).closest('#btnSettings').length) {
                e.preventDefault();
            }
        });


   
	}).then(() => App.stopLoading())
</script>
<?php
	$dbc->Close();
?>

<style>
    .main-body {
        padding: 0;
    }

    .note-statusbar {
        display: none;
    }

    .msg-preview, .msg-preview-time, .note-content {
        /*color : #333333*/
    }

     .msg-preview{
        color : #333333
    }

    .list-note-tags{
        width: 200px;          /* กำหนดความกว้างของกล่องข้อความ */
        white-space: nowrap;      /* สั่งให้ข้อความไม่ขึ้นบรรทัดใหม่ */
        overflow: hidden;         /* ซ่อนส่วนที่เกินออกมา */
        text-overflow: ellipsis;  /* เติมจุดไข่ปลา ... เมื่อข้อความยาวเกิน */
        color: #000000;
    }

    .dropdown-menu.show {
    display: block;
}
</style>
