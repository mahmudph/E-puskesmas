<?php namespace App\Models;

use Codeigniter\Model;

class AntrianModel extends Model {
  protected $table = 'tbl_antrians';
  protected $allowedFields = ['id_pendaftaran', 'no_antrian'];

  public function __construct() {
    parent::__construct();
  }

  public function get_antrian($id) {
    return $this->db->table($this->table)->join('tbl_pendaftarans', 'tbl_pendaftarans.id=tbl_antrians.id_pendaftaran')
    ->where('tbl_pendaftarans.id_puskesmas', $id)->where('tbl_pendaftarans.tgl_daftar', date('Y-m-d'));
  }
}

?>