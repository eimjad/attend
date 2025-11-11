<?php
class Kkpk_members extends Trongate {

  protected $table = 'kkpk_members';

  // ========================================================
  // INSERT NEW MEMBER
  // ========================================================
  function insert_member($data) {
    return $this->insert($this->table, $data);
  }

  // ========================================================
  // UPDATE MEMBER
  // ========================================================
  function update_member($id, $data) {
    return $this->update($this->table, $id, $data);
  }

  // ========================================================
  // DELETE MEMBER
  // ========================================================
  function delete_member($id) {
    return $this->delete($this->table, $id);
  }

  // ========================================================
  // GET MEMBER BY ID
  // ========================================================
  function get_member($id) {
    return $this->get_where($this->table, $id);
  }

  // ========================================================
  // GET ALL MEMBERS (sorted by column)
  // ========================================================
  function get_all_members($order_by = 'id') {
    return $this->get($this->table, $order_by);
  }

  // ========================================================
  // FIND MEMBER BY COLUMN VALUE
  // ========================================================
  function find_member_by($column, $value) {
    return $this->get_where_custom($this->table, $column, $value)->row();
  }

  // ========================================================
  // GET MULTIPLE MEMBERS BY CUSTOM FILTER
  // ========================================================
  function filter_members($column, $value) {
    return $this->get_where_custom($this->table, $column, $value)->result();
  }

  // ========================================================
  // SEARCH MEMBERS BY NAME OR NO_KP
  // ========================================================
  function search_members($keyword) {
    $sql = "
      SELECT * FROM $this->table
      WHERE nama_penuh LIKE :keyword
      OR no_kp LIKE :keyword
      OR no_kkpk LIKE :keyword
      ORDER BY nama_penuh ASC
    ";
    $params['keyword'] = '%'.$keyword.'%';
    return $this->query($sql, $params, 'object');
  }

  // ========================================================
  // CHECK LOGIN CREDENTIAL
  // ========================================================
  function verify_login($no_kp) {
    return $this->find_member_by('no_kp', $no_kp);
  }

}
