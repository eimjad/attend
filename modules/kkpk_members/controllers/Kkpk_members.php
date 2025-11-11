<?php
class Kkpk_members extends Trongate {

  function __construct() {
    parent::__construct();
    $this->module = 'kkpk_members';
    $this->model = $this->load_model($this->module);
  }

  function login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $no_kp = post('no_kp');
      $password = post('password');

      $member = $this->model->get_where_custom('no_kp', $no_kp)->row();
      if ($member && password_verify($password, $member->password)) {
        load('tokens');
        $token_data = [
          'user_id' => $member->id,
          'user_type' => 'kkpk_member'
        ];
        $token = $this->tokens->_generate_token($token_data);
        set_cookie('kkpk_token', $token, 86400 * 30); // 30 days
        redirect('kkpk_members/profile');
      } else {
        set_flashdata('error', 'Invalid login credentials.');
        redirect('kkpk_members/login');
      }
    } else {
      $this->view('login');
    }
  }

  function logout() {
    delete_cookie('kkpk_token');
    redirect('kkpk_members/login');
  }

  function profile() {
    $member_id = $this->_get_logged_in_member_id();
    if (!$member_id) {
      redirect('kkpk_members/login');
    }

    $data['member'] = $this->model->get_where($member_id);
    $data['view_module'] = $this->module;
    $data['view_file'] = 'profile';
    $this->template('public', $data);
  }

  function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = $this->_get_data_from_post();
      $data['password'] = password_hash(post('password'), PASSWORD_DEFAULT);
      $this->model->insert($data);
      redirect('kkpk_members/login');
    } else {
      $this->view('create');
    }
  }

  function manage() {
    $data['members'] = $this->model->get('id');
    $data['view_module'] = $this->module;
    $data['view_file'] = 'manage';
    $this->template('admin', $data); // or 'public' depending on your layout
  }



  private function _get_member_id() {
    $token = get_cookie('kkpk_token');
    if ($token) {
      load('tokens');
      $token_data = $this->tokens->_get_token_data($token);
      if ($token_data && $token_data['user_type'] == 'kkpk_member') {
        return $token_data['user_id'];
      }
    }
    return false;
  }

  private function _get_data_from_post() {
    $fields = [
      'no_kkpk', 'no_kp', 'jawatan_kkpk', 'nama_penuh', 'no_telefon', 'emel',
      'alamat', 'nama_syarikat_perniagaan', 'jenis_industri', 'pekerjaan_jawatan',
      'kepakaran', 'tujuan', 'referral', 'syer_1000', 'syer_100', 'daftar_20', 'status', 'catatan'
    ];
    $data = [];
    foreach ($fields as $field) {
      $data[$field] = post($field);
    }
    return $data;
  }

  private function _get_logged_in_member_id() {
    $token = get_cookie('kkpk_token');
    if (!$token) {
      return false;
    }

    load('tokens');
    $token_data = $this->tokens->_get_token_data($token);
    if ($token_data && isset($token_data['user_id']) && $token_data['user_type'] == 'kkpk_member') {
      return $token_data['user_id'];
    }

    return false;
  }


}
