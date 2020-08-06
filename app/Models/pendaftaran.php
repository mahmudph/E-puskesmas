<?php namespace App\Models;

use Codeigniter\Model;

class AntrianModel extends Model {
  protected $table = 'tbl_pendaftaran';

  public function insertData($data) {
    $this->db->insert($data);
  }

  public function deleteByid($id) {
    $this->db->delete(['id' => $id]);
  }

  public function updateById($data, $id) {
    return $this->db->update($data. ['id' => $id]);
  }
}

?>