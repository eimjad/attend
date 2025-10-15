<?php
class Attend extends Trongate {

  // Office UIN
  private $office_lat = 6.229751;
  private $office_lng = 100.420016;
  // Office Tok Mat
  // private $office_lat = 6.204174;
  // private $office_lng = 100.417664;

  private $allowed_radius_m = 100;

  public function index() {
    $data['module_path'] = BASE_URL . "attend";
    $this->template('public', $data);
  }

  public function submit() {
    // Ensure JSON response
    header('Content-Type: application/json');

    if (!$this->is_ajax_request()) {
      http_response_code(400);
      echo json_encode(['status' => 'error', 'message' => 'Bad request']);
      exit;
    }

    $payload = json_decode(file_get_contents('php://input'), true);
    $action = ($payload['action'] ?? '') === 'out' ? 'out' : 'in';
    $name = trim($payload['name'] ?? '');
    $device = trim($payload['device'] ?? '');
    $lat = isset($payload['lat']) ? floatval($payload['lat']) : null;
    $lng = isset($payload['lng']) ? floatval($payload['lng']) : null;

    if ($name === '' || $device === '') {
      http_response_code(422);
      echo json_encode(['status' => 'error', 'message' => 'Missing name or device']);
      exit;
    }

    $in_radius = 0;
    if ($lat !== null && $lng !== null) {
      $distance = $this->get_distance_m($lat, $lng, $this->office_lat, $this->office_lng);
      if ($distance <= $this->allowed_radius_m) {
        $in_radius = 1;
      }
    }

    // Build insert SQL and parameters
    $sql = "
      INSERT INTO attend_records
        (user_name, device_name, action, ts, lat, lng, in_radius)
      VALUES
        (:name, :device, :action, :ts, :lat, :lng, :in_radius)
    ";
    $params = [
      'name'      => $name,
      'device'    => $device,
      'action'    => $action,
      'ts'        => date('Y-m-d H:i:s'),
      'lat'       => $lat,
      'lng'       => $lng,
      'in_radius' => $in_radius,
    ];

    try {
      $this->model->query_bind($sql, $params, 'object');  // Using Trongate’s query() method
      echo json_encode([
        'status'    => 'success',
        'message'   => 'Recorded',
        'in_radius' => $in_radius,
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['status' => 'error', 'message' => 'Failed to save']);
    }
  }

  // Optional: monthly report method (if needed)
  public function monthly_report($year = '', $month = '') {
    header('Content-Type: application/json');

    $year = $year ?: date('Y');
    $month = $month ?: date('m');

    $sql = "
      SELECT
        user_name, device_name, DATE(ts) AS day,
        MIN(CASE WHEN action = 'in' THEN ts END) AS first_in,
        MAX(CASE WHEN action = 'out' THEN ts END) AS last_out
      FROM attend_records
      WHERE YEAR(ts) = :year AND MONTH(ts) = :month
      GROUP BY user_name, device_name, DATE(ts)
      ORDER BY day
    ";
    $params = ['year' => $year, 'month' => $month];
    $rows = $this->model->query_bind($sql, $params, 'object');

    // optionally compute hours in PHP side
    $report = [];
    foreach ($rows as $r) {
      $worked_sec = 0;
      if (!empty($r->first_in) && !empty($r->last_out)) {
        $worked_sec = max(0, strtotime($r->last_out) - strtotime($r->first_in));
      }
      $worked_hours = round($worked_sec / 3600, 2);
      $report[] = [
        'user_name'    => $r->user_name,
        'device_name'  => $r->device_name,
        'day'          => $r->day,
        'first_in'     => $r->first_in,
        'last_out'     => $r->last_out,
        'worked_hours' => $worked_hours,
      ];
    }

    echo json_encode(['status' => 'success', 'report' => $report]);
  }

public function all() {
  $data['records'] = $this->model->query('SELECT * FROM attend_records ORDER BY ts ASC', 'object');
  $data['view_module'] = 'attend';
  $this->view('records', $data);
}

  // Helpers

  private function is_ajax_request() {
    return (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
             && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
      || (isset($_SERVER['CONTENT_TYPE'])
          && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false);
  }

  private function get_distance_m($lat1, $lng1, $lat2, $lng2) {
    $earthRadius = 6371000;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lng2 - $lng1);
    $a = sin($dLat / 2) * sin($dLat / 2)
        + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
        * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earthRadius * $c;
  }
}
