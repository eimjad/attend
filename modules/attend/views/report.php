<?php
// expects $report array, $year, $month
?>

<h2>Report for <?=$month?>/<?=$year?></h2>
<table class="attend-report-table">
<thead>
<tr><th>User</th><th>Device</th><th>Date</th><th>In</th><th>Out</th><th>Hours</th></tr>
</thead>
<tbody>
<?php foreach ($report as $row): ?>
<tr>
<td><?=htmlspecialchars($row['user_name'])?></td>
<td><?=htmlspecialchars($row['device_name'])?></td>
<td><?=$row['day']?></td>
<td><?=$row['first_in'] ?? '-'?></td>
<td><?=$row['last_out'] ?? '-'?></td>
<td><?=$row['worked_hours']?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>