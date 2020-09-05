<?php namespace App\Models;
use CodeIgniter\Model;

class Penerimapengumuman extends Model {
  protected $table = 'tbl_penerima_pengumumans';
  protected $allowedFields = ['id_puskes','id_pengumuman'];

  public function __construct() {
    parent::__construct();
  }
}
