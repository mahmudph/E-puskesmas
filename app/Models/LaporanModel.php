<?php namespace App\Models;

use Codeigniter\Model;

class LaporanModel extends Model {
  protected $table = 'tbl_laporans';
  protected $allowedFields = ['id_puskesmas', 'tgl_laporan', 'status_baca'];


  public function __construct() {
    parent::__construct();
  }

  public function get_laporan_data($id_user=null) {
    return $this->db->table($this->table)->where('status_baca', 0)->get()->getResultArray();
  }

  public function get_data_by_id($id) {
    return $this->db->table($this->table)->where('YEAR(tgl_laporan)', date('Y'))->where('MONTH(tgl_laporan)', date('m'))->where('id_puskesmas', $id);
      
  }

  public function get_laporan_data_count($id_user=null) {
    return $this->db->table($this->table)->where('status_baca', 0)->countAllResults();
  }
  public function generate_bulan() {
    return array (
      'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
  }

  public function get_by_id($id) {
    return $this->db->table($this->table)
      ->join('tbl_laporan_pasiens', 'tbl_laporan_pasiens.id_laporan=tbl_laporans.id')
      ->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_laporans.id_puskesmas')
      ->where('tbl_laporans.id', $id)
      ->select('count(tbl_puskesmas.id) as jmlh,tbl_puskesmas.nama_puskesmas, tbl_laporans.*')->get()->getRowArray();
      
  }

  public function get_pasien_pendaftaran($id) {
    return $this->db->table($this->table)
      ->join('tbl_laporan_pasiens', 'tbl_laporan_pasiens.id_laporan=tbl_laporans.id')
      ->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_laporans.id_puskesmas')
      ->join('tbl_pendaftarans', 'tbl_pendaftarans.id=tbl_laporan_pasiens.id_pendaftar')
      ->join('tbl_users', 'tbl_users.id=tbl_pendaftarans.id_user')
      ->where('tbl_laporans.id', $id)
      ->select('tbl_users.nama, tbl_users.email,tbl_users.desa, tbl_users.alamat,tbl_users.jenis_kelamin, tbl_users.tgl_lahir, tbl_pendaftarans.tgl_daftar, tbl_pendaftarans.tgl_digunakan,tbl_pendaftarans.diagnosis, tbl_pendaftarans.obat')
      ->get()->getResultArray();
  }
}

?>