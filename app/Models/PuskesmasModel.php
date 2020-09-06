<?php namespace App\Models;

use CodeIgniter\Model;

class PuskesmasModel extends Model {
  protected $table = 'tbl_puskesmas';
  protected $allowedFields = ['nama_puskesmas', 'status','token_aktifasi', 'alamat_puskesmas', 'admin_puskesmas', 'email_puskesmas'];
  public function insertData($data) {
    $this->db->insert($data);
  }

  public function deleteByid($id) {
    $this->db->delete(['id' => $id]);
  }

  public function updateById($data, $id) {
    $this->db->where('id',$id);
    return $this->db->update($this->table, $data);
  }

  public function getData() {
    return $this->getWhere(['status' => 1]);
  }
}

?>