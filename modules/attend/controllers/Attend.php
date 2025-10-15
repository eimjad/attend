<?php


class Attend extends Trongate {
// office center latitude/longitude and allowed radius (meters)
private $office_lat = 6.476; // change to your office latitude
private $office_lng = 100.366; // change to your office longitude
private $allowed_radius_m = 100; // meters
private $template_to_use = 'public';


public function index() {
// show the attendance page
$data['module_path'] = BASE_URL."modules/attend";
$this->template($this->template_to_use, $data);
}


public function submit() {
// accepts AJAX POST with action=in|out, name, device, lat, lng
if (!$this->is_ajax_request()) {
$this->response(['status' => 'error', 'message' => 'Bad request'], 400);
}


$payload = json_decode(file_get_contents('php://input'), true);
$action = ($payload['action'] ?? '') === 'out' ? 'out' : 'in';
$name = trim($payload['name'] ?? '');
$device = trim($payload['device'] ?? '');
$lat = isset($payload['lat']) ? floatval($payload['lat']) : null;
$lng = isset($payload['lng']) ? floatval($payload['lng']) : null;


if ($name === '' || $device === '') {
$this->response(['status' => 'error', 'message' => 'Missing name or device'], 422);
}


// Check location radius server-side if lat/lng provided
$in_radius = false;
if ($lat !== null && $lng !== null) {
$distance = $this->get_distance_m($lat, $lng, $this->office_lat, $this->office_lng);
$in_radius = ($distance <= $this->allowed_radius_m);
}


$this->load->model('attend/Attend_model');


$record_id = $this->Attend_model->create_record([
'user_name' => $name,
'device_name' => $device,
'action' => $action,
'ts' => date('Y-m-d H:i:s'),
'lat' => $lat,
'lng' => $lng,
'in_radius' => $in_radius ? 1 : 0,
]);


if ($record_id) {
$this->response(['status' => 'success', 'message' => 'Recorded', 'in_radius' => $in_radius]);
} else {
$this->response(['status' => 'error', 'message' => 'Failed to save'], 500);
}
}


public function monthly_report($year = '', $month = '') {
// return JSON or render view with monthly report
$year = $year ?: date('Y');
$month = $month ?: date('m');


$this->load->model('attend/Attend_model');
$report = $this->Attend_model->monthly_report($year, $month);


if ($this->is_ajax_request()) {
$this->response(['status' => 'success', 'report' => $report]);
}


$data['report'] = $report;
$data['year'] = $year;
$data['month'] = $month;
$this->template('attend/report', $data);
}


// ---- helpers ----
private function is_ajax_request() {
return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false);
}


private function response($payload, $status_code = 200) {
http_response_code($status_code);
header('Content-Type: application/json');
echo json_encode($payload);
exit;
}


private function get_distance_m($lat1, $lng1, $lat2, $lng2) {
// Haversine formula
$earthRadius = 6371000; // meters
$dLat = deg2rad($lat2 - $lat1);
$dLon = deg2rad($lng2 - $lng1);
$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
$c = 2 * atan2(sqrt($a), sqrt(1-$a));
return $earthRadius * $c;
}
}