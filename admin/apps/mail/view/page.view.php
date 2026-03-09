<?php
    $aLabelMain = array(
		array("INBOX","Inbox","fa fa-inbox",0),
		array("STARRED","Starred","fa fa-star",'warning'),
		array("SENT","Sent","fa fa-send",0),
		array("SPAM","Spam","fa fa-exclamation-circle",0),
		array("TRASH","Trash","fa fa-trash",'secondary'),
		array("IMPORTANT","Important","fas fa-exclamation-triangle",'warning')
	);

    $aLabelCategory = array(
		array("CATEGORY_SOCIAL","Social","fa fa-users",0),
		array("CATEGORY_UPDATES","Updates","fa fa-sync-alt",0),
		array("CATEGORY_FORUMS","Forums","fa fa-comments",0),
		array("CATEGORY_PROMOTIONS","Promotions","fa fa-tag",0),
		array("CATEGORY_PERSONAL","Personal","fa fa-person",0)
	);

	$aLabelUser = array();
?>
<div class="inner-wrapper">
  <div class="inner-sidebar">
    <div class="inner-sidebar-header justify-content-center">
      <button class="btn btn-warning has-icon btn-block" type="button" data-toggle="modal" data-target="#composeModal">
        <i data-feather="plus" class="mr-2"></i> Compose
      </button>
    </div>
          <!-- Inner sidebar body -->
    <div class="inner-sidebar-body p-0">
      <div class="p-3 h-100" data-simplebar>
        <div class="list-group list-group-sm list-g list-group-borderless list-group-flush">
        <?php
          foreach($aLabelMain as $label){
            $badge = 'badge-primary';
            if(isset($label[4])) $badge = 'badge-'.$label[4];
            echo '<a data-label="'.$label[0].'" type="button" class="btn-mail-label list-group-item list-group-item-action has-icon" onclick="fn.app.mail.gmail.list_mail(\''.$label[0].'\',this)">';
              echo '<i class="mr-2 '.$label[2].'"></i>'.$label[1];
              if($label[3] > 0) echo '<span class="badge badge-pill '.$badge.' ml-auto">'.$label[3].'</span>'	;
            echo '</a>';
          }
				?>
        </div>
        <label class="small text-secondary mt-3">Categories</label>
        <div class="list-group list-group-sm list-g list-group-borderless list-group-flush">
        <?php
          foreach($aLabelCategory as $label){
            $badge = 'badge-secondary';
            if(isset($label[4])) $badge = 'badge-'.$label[4]; 
            echo '<a data-label="'.$label[0].'" type="button" class="btn-mail-label list-group-item list-group-item-action has-icon" onclick="fn.app.mail.gmail.list_mail(\''.$label[0].'\',this)">';
              echo '<i class="mr-2 '.$label[2].'"></i>'.$label[1];
              if($label[3] > 0) echo '<span class="badge badge-pill '.$badge.' ml-auto">'.$label[3].'</span>'	;
            echo '</a>';
          }
				?>
        </div>
        <label class="small text-secondary mt-3 d-block">Labels</label>
        <div class="list-with-gap"></div>
      </div>
    </div>
    <!-- /Inner sidebar body -->
  </div>
  <!-- /Inner sidebar -->
    <!-- Inner main -->
  <div id="main-inbox"  class="inner-main collapse transition-none mail-content show" data-paginate-perpage="20" data-pageinate-page="1" data-label="INBOX">
    <!-- Inner main header -->
    <div class="inner-main-header">
      <a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar"><i class="material-icons">arrow_forward_ios</i></a>
      <div class="text-nowrap mr-2">
        <h5 class="main-inbox-label mb-0">Inbox</h5>
        <span class="main-inbox-label-unread font-size-sm text-muted d-none d-sm-block">3 unread messages</span>
      </div>
      <span class="input-icon input-icon-sm ml-auto w-auto">
        <i class="material-icons">search</i>
        <input name="main-inbox-search" type="text" class="form-control form-control-sm bg-gray-200 border-gray-200" placeholder="Search mail">
      </span>
    </div>
    <!-- /Inner main header -->

    <!-- Inner main body -->
    <div class="inner-main-body p-0 bg-white">
      <div class="card rounded-0">
        <ul class="list-group list-group-sm list-group-flush sticky-top border-bottom">
          <li class="list-group-item has-icon">
            <!-- Check All -->
            <div class="custom-control custom-control-nolabel custom-checkbox mr-2" data-toggle="tooltip" data-trigger="hover" title="Select all">
              <input type="checkbox" class="custom-control-input" id="check-all" data-toggle="mail-checkbox" data-check="all-toggle">
              <label for="check-all" class="custom-control-label"></label>
            </div>
            <!-- Custom check -->
            <div class="dropdown mr-2">
              <button class="btn text-secondary dropdown-toggle btn-icon no-caret btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="chevron-down"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" data-toggle="mail-checkbox" data-check="all" type="button">All</button>
                <button class="dropdown-item" data-toggle="mail-checkbox" data-check="none" type="button">None</button>
                <button class="dropdown-item" data-toggle="mail-checkbox" data-check="read" type="button">Read</button>
                <button class="dropdown-item" data-toggle="mail-checkbox" data-check="unread" type="button">Unread</button>
                <button class="dropdown-item" data-toggle="mail-checkbox" data-check="starred" type="button">Starred</button>
                <button class="dropdown-item" data-toggle="mail-checkbox" data-check="unstarred" type="button">Unstarred</button>
              </div>
            </div>
            <!-- Refresh -->
            <button onClick="fn.app.mail.gmail.list_mail()" class="btn text-primary btn-icon btn-sm" type="button" data-toggle="tooltip" data-trigger="hover" title="Refresh"><i data-feather="rotate-cw"></i></button>
            <!-- Bulk action -->
            <div class="btn-group btn-group-sm ml-1" role="group" id="bulk-mail" hidden>
              <button type="button" class="btn has-icon text-success" data-toggle="tooltip" data-trigger="hover" title="Archive"><i data-feather="archive"></i></button>
              <button type="button" class="btn has-icon text-info" data-toggle="tooltip" data-trigger="hover" title="Report spam"><i data-feather="alert-octagon"></i></button>
              <button onclick="fn.app.mail.gmail.dialog_remove()" type="button" class="btn has-icon text-danger" data-toggle="tooltip" data-trigger="hover" title="Delete"><i data-feather="trash"></i></button>
              <button type="button" class="btn has-icon no-caret dropdown-toggle" data-toggle="dropdown" data-display="static"><i data-feather="chevron-down"></i></button>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm-left">
                <button class="dropdown-item" type="button">Move</button>
                <button class="dropdown-item" type="button">Mark as read</button>
                <button class="dropdown-item" type="button">Mark as unread</button>
                <button class="dropdown-item" type="button">Mute</button>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header text-muted">Label as</h6>
                <button class="dropdown-item" type="button">Social</button>
                <button class="dropdown-item" type="button">Promotions</button>
                <button class="dropdown-item" type="button">Updates</button>
                <button class="dropdown-item" type="button">Jobstreet</button>
              </div>
            </div>
            <!-- Caption & pagination -->
            <div class="ml-auto flex-center">
              <small class="main-inbox-pageinfo text-secondary mr-2 d-none d-sm-block">1-10 of 347</small>
              <button id="btn-mail-prev" onclick="fn.app.mail.gmail.list_mail_prev_page()" class="btn btn-sm btn-light btn-icon border-0 rounded-circle"><i class="material-icons">chevron_left</i></button>
              <button id="btn-mail-next" onclick="fn.app.mail.gmail.list_mail_next_page()" class="btn btn-sm btn-light btn-icon border-0 rounded-circle"><i class="material-icons">chevron_right</i></button>
            </div>
          </li>
        </ul>
        <ul class="list-group list-group-sm list-group-flush" id="mail-item-wrapper">
        </ul>
      </div>
    </div>
    <!-- /Inner main body -->
  </div>
        <!-- /Inner main -->

  <!-- Inner main สำหรับ หน้าปกติ -->
  <div id="email-screen" class="inner-main collapse transition-none mail-content">
    <!-- Inner main header -->
    <div class="inner-main-header">
      <button class="btn btn-light btn-sm has-icon" data-toggle="collapse" data-target=".mail-content"><i data-feather="chevron-left"></i>Inbox</button>
      <div class="btn-group btn-group-sm ml-2" role="group">
        <button type="button" class="btn has-icon text-success" data-toggle="tooltip" data-trigger="hover" title="Archive"><i data-feather="archive"></i></button>
        <button type="button" class="btn has-icon text-info" data-toggle="tooltip" data-trigger="hover" title="Report spam"><i data-feather="alert-octagon"></i></button>
        <button type="button" class="btn has-icon text-danger" data-toggle="tooltip" data-trigger="hover" title="Delete"><i data-feather="trash"></i></button>
        <button type="button" class="btn has-icon no-caret dropdown-toggle" data-toggle="dropdown" data-display="static"><i data-feather="chevron-down"></i></button>
        <div class="dropdown-menu dropdown-menu-right">
          <button class="dropdown-item" type="button">Move</button>
          <button class="dropdown-item" type="button">Mark as unread</button>
          <button class="dropdown-item" type="button">Mute</button>
          <button class="dropdown-item" type="button">Print</button>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header text-muted">Label as</h6>
          <button class="dropdown-item" type="button">Social</button>
          <button class="dropdown-item" type="button">Promotions</button>
          <button class="dropdown-item" type="button">Updates</button>
          <button class="dropdown-item" type="button">Jobstreet</button>
        </div>
      </div>
      <div class="ml-auto flex-center">
        <small class="text-secondary mr-2 d-none d-sm-block">5 of 347</small>
        <button onclick="fn.app.mail.gmail.list_mail_prev_page()" class="btn btn-sm btn-light btn-icon border-0 rounded-circle"><i class="material-icons">chevron_left</i></button>
        <button onclick="fn.app.mail.gmail.list_mail_next_page()" class="btn btn-sm btn-light btn-icon border-0 rounded-circle"><i class="material-icons">chevron_right</i></button>
      </div>
    </div>
    <!-- /Inner main header -->

    <!-- Inner main body -->
    <div class="inner-main-body p-0 bg-white">
      <div class="card rounded-0">
        <div class="card-body font-size-sm">
          <div class="media mb-3 align-items-center">
            <img src="img/user.svg" alt="User" class="rounded mail-item-avatar" width="50" height="50">
            <div class="media-body text-muted ml-3">
              <h6 class="mb-0 text-dark mail-item-from">Facebook</h6>
              <div class="small mail-item-to">to me</div>
              <div class="small mail-item-date">Aug 13, 2019 <a href="javascript:void(0)">Details</a></div>
            </div>
            <div class="btn-group">
              <button type="button" class="btn-starred btn btn-icon" data-toggle="button" aria-pressed="false" onclick="fn.app.mail.gmail.star(this)">
                <i class="fa fa-star"></i>
              </button>
              <button type="button" class="btn btn-icon"><i class="fa fa-reply"></i></button>
            </div>
          </div>
          <h5 class="mail-item-subject">Did you log into Facebook from somewhere new?</h5>
          <hr>
          <div class="mail-item-content"></div>
          <div class="btn-group-sm pt-3">
            <button class="btn btn-light has-icon justify-content-center" type="button"><i class="fa mr-2 fa-reply"></i>Reply</button>
            <button class="btn btn-light has-icon justify-content-center" type="button"><i class="fa mr-2 fa-forward"></i>Forward</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /Inner main body -->
  </div>
        <!-- /Inner main -->
</div>

      <!-- Compose Modal -->

<style>
  .main-body {
    padding: 0;
  }
</style>