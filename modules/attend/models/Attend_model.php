<?php


class Attend_model extends Model {
protected $table = 'attend_records';


public function create_record($data) {
$db_data = [
'user_name' => $data['user_name'] ?? null,
'device_name' => $data['device_name'] ?? null,
'action' => $data['action'] ?? 'in',
'ts' => $data['ts'] ?? date('Y-m-d H:i:s'),
'lat' => $data['lat'] ?? null,
'lng' => $data['lng'] ?? null,
'in_radius' => isset($data['in_radius']) ? intval($data['in_radius']) : 0,
];

$data = $this->insert( $db_data, $this->table,);
return $data;
}


public function monthly_report($year, $month) {
// returns grouped report per day per user
$start = "$year-$month-01 00:00:00";
$end = date('Y-m-d H:i:s', strtotime("$start +1 month"));


$sql = "SELECT user_name, device_name, DATE(ts) AS day,
MIN(CASE WHEN action='in' THEN ts END) AS first_in,
MAX(CASE WHEN action='out' THEN ts END) AS last_out
FROM {$this->table}
WHERE ts >= ? AND ts < ?
GROUP BY user_name, device_name, DATE(ts)
ORDER BY user_name, day";


$query = $this->query($sql);
$rows = $query->result_array();


// calculate worked hours (if both in and out present)
$report = [];
foreach ($rows as $r) {
$worked_seconds = 0;
if (!empty($r['first_in']) && !empty($r['last_out'])) {
$t1 = strtotime($r['first_in']);
$t2 = strtotime($r['last_out']);
$worked_seconds = max(0, $t2 - $t1);
}


$report[] = [
'user_name' => $r['user_name'],
'device_name' => $r['device_name'],
'day' => $r['day'],
'first_in' => $r['first_in'],
'last_out' => $r['last_out'],
'worked_seconds' => $worked_seconds,
'worked_hours' => round($worked_seconds / 3600, 2),
];
}


return $report;
}
}