<?php namespace App\Models;

use Codeigniter\Model;

class Pendaftaran extends Model {
  protected $table = 'tbl_pendaftarans';
  protected $allowedFields = ['id_user', 'id_puskesmas', 'tgl_daftar', 'tgl_digunakan', 'nama', 'no_hp', 'keterangan', 'diagnosis', 'obat'];


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


  public function get_pasien($puskesmas_id) {
    return $this->db->table($this->table)
    ->join('tbl_users', 'tbl_users.id=tbl_pendaftarans.id_user')->where('tbl_pendaftarans.id_puskesmas', $puskesmas_id)->get()->getResultArray();
  }

  public function get_jadwal($user_id, $lewat='') {
    $data = $this->db->table($this->table)
    ->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_pendaftarans.id_puskesmas')
    ->join('tbl_users', 'tbl_users.id=tbl_pendaftarans.id_user')
    ->join('tbl_antrians', 'tbl_antrians.id_pendaftaran=tbl_pendaftarans.id');
    if($lewat) {
      $data = $data->where([
        'id_user' => $user_id,
        'tgl_digunakan <' =>  date('Y-m-d'),
      ]);
    } else {
      $data = $data->where([
        'id_user' => $user_id,
        'tgl_digunakan >' =>  date('Y-m-d'),
      ]);
    }

    return $data->select('tbl_puskesmas.nama_puskesmas, tbl_users.nama, tbl_pendaftarans.*, tbl_antrians.no_antrian')
    ->get();


  }

  public function count_jadwal($user_id) {
    return $this->db->table($this->table)
    ->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_pendaftarans.id_puskesmas')
    ->join('tbl_users', 'tbl_users.id=tbl_pendaftarans.id_user')
    ->where([
			'id_user' => $user_id,
			'tgl_digunakan >' => date('Y-m-d')
    ])
    ->select('tbl_puskesmas.nama_puskesmas, tbl_users.nama, tbl_pendaftarans.*')
    ->countAllResults();
  }

  public function statistik_count($id) {
    return $this->db->table($this->table)
    ->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_pendaftarans.id_puskesmas')
    ->join('tbl_users', 'tbl_users.id=tbl_pendaftarans.id_user')
    ->select('tbl_puskesmas.nama_puskesmas, tbl_users.nama, tbl_pendaftarans.*')
    ->where('id_puskesmas', $id);
    
  }


  public function get_data($id) {
    return $this->db->table($this->table)
    ->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_pendaftarans.id_puskesmas')
    ->join('tbl_users', 'tbl_users.id=tbl_pendaftarans.id_user')
    ->select('tbl_users.nama, tbl_users.jenis_kelamin, tbl_users.tgl_lahir, tbl_users.desa, tbl_users.alamat, tbl_pendaftarans.*,')
    ->where('id_puskesmas', $id);
    
  }


}

?>