<?php namespace App\Models;

use Codeigniter\Model;

class LaporanPasien extends Model {
  protected $table = 'tbl_laporan_pasiens';
  protected $allowedFields = ['id_laporan', 'id_pendaftar'];


  public function __construct() {
    parent::__construct();
  }
}
?>