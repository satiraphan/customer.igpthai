<?php
    $total_address = $dbc->GetCount("os_address");

?>
<div class="card h-100">
    <div class="card-body">
        <div class="flex-center justify-content-start mb-2">
            <i class="mr-2 fa fa-map-marker-alt"></i>
            <h3 class="card-title mb-0 mr-auto"><?php echo $total_address; ?></h3>
            <span id="pageLikes">10,500,400,200,300</span>
        </div>
        <h6 class="text-info">ที่อยู่</h6>
        <p class="small text-secondary mb-0">ที่อยู่ทั้งหมดในระบบ</p>
    </div>
</div>