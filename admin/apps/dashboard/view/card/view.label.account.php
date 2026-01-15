<?php
    $total_account = $dbc->GetCount("os_accounts","status > 0");

?>
<div class="card h-100">
    <div class="card-body">
        <div class="flex-center justify-content-start mb-2">
            <i class="mr-2 fa fa-building"></i>
            <h3 class="card-title mb-0 mr-auto"><?php echo $total_account; ?></h3>
            <span id="pageLikes">10,500,400,200,300</span>
        </div>
        <h6 class="text-info">บัญชี</h6>
        <p class="small text-secondary mb-0">บัญชีทั้งหมดในระบบ</p>
    </div>
</div>