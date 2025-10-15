<?php
// records.php — displays all attendance records
?>

<h2>All Attendance Records</h2>

<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%;">
  <thead>
    <tr style="background: #eee;">
      <th>ID</th>
      <th>User</th>
      <th>Device</th>
      <th>Action</th>
      <th>Date/Time</th>
      <th>Latitude</th>
      <th>Longitude</th>
      <th>In Radius</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($records)): ?>
      <?php foreach ($records as $r): ?>
        <tr>
          <td><?= $r->id ?></td>
          <td><?= htmlentities($r->user_name) ?></td>
          <td><?= htmlentities($r->device_name) ?></td>
          <td><?= htmlentities($r->action) ?></td>
          <td><?= htmlentities($r->ts) ?></td>
          <td><?= htmlentities($r->lat) ?></td>
          <td><?= htmlentities($r->lng) ?></td>
          <td><?= $r->in_radius ? '✅' : '❌' ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="8" style="text-align:center;">No records found</td></tr>
    <?php endif; ?>
  </tbody>
</table>
