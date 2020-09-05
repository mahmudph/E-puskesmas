<?php namespace App\Models;

use Codeigniter\Model;

class AntrianSetting extends Model {
  protected $table = 'tbl_setting_antrians';
  protected $allowedFields = ['id_puskes', 'jmlh_antrian'];

  public function __construct() {
    parent::__construct();
  }

}

?>