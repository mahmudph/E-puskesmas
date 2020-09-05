<?php namespace App\Models;
use CodeIgniter\Model;


class PengumumanModel extends Model {
  protected $table = 'tbl_pengumumans';
  protected $allowedFields = ['judul','tgl_pengumuman', 'isi'];


  public function __construct() {
    parent::__construct();
  }


  public function insertData($data) {
    $this->db->insert($data);
  }
  public function deleteByid($id) {
    $this->db->delete(['id' => $id]);
  }
  public function updateById($data, $id) {
    return $this->db->update($data. ['id' => $id]);
  }

  public function get_pengumuman($id=null) {
    $data = $this->db->table($this->table)
    ->join('tbl_penerima_pengumumans penerima','penerima.id_pengumuman=tbl_pengumumans.id')
    ->join('tbl_puskesmas puskes', 'puskes.id=penerima.id_puskes')
    ->join('tbl_users usr', 'usr.id=puskes.admin_puskesmas');
    if($id) {
      $data->where('usr.id', $id);
    }
    return $data->get()->getResultArray();
  }

  public function get_count_pengumuman($id) {
    return $this->db->table($this->table)
    ->join('tbl_penerima_pengumumans penerima','penerima.id_pengumuman=tbl_pengumumans.id')
    ->join('tbl_puskesmas puskes', 'puskes.id=penerima.id_puskes')
    ->join('tbl_users usr', 'usr.id=puskes.admin_puskesmas')
    ->where('usr.id', $id)->countAll();
  }
  public function get_pengumumans($id) {
    return $this->db->table($this->table)
    ->join('tbl_penerima_pengumumans penerima','penerima.id_pengumuman=tbl_pengumumans.id')
    ->join('tbl_puskesmas puskes', 'puskes.id=penerima.id_puskes')
    ->join('tbl_users usr', 'usr.id=puskes.admin_puskesmas')
    ->where('puskes.id', $id);
  }


}

?>