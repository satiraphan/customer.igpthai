<?php
    $total_user = $dbc->GetCount("os_users","status > 0");

    $sql = "SELECT DATE(datetime),COUNT(*) FROM os_logs
            WHERE datetime >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            GROUP BY DATE(datetime)
            ORDER BY datetime ASC";
    $rst = $dbc->Query($sql);
    $dates = [];
    $counts = [];

    $labels = array();
    $datasets = array();

    while($line = $dbc->Fetch($rst)){
        array_push($labels, $line[0]);
        array_push($datasets, intval($line[1]));
    }

?>
<div class="card">
    <div class="card-body">
        <canvas id="chart-activty-users" style="height: 400px;" data-label='<?php echo json_encode($labels,JSON_UNESCAPED_UNICODE); ?>' data-data="<?php echo json_encode($datasets); ?>">

        </canvas>
    </div>
</div>