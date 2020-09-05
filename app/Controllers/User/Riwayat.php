<?php namespace App\Controllers\User;

use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;

class Riwayat extends BaseController {
  public function __construct() {
    helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->pendaftaran = new Pendaftaran();
		$this->puskesmas = new PuskesmasModel();
		$this->laporan = new LaporanModel();
		$this->form_validation = \Config\Services::validation();
  }
  public function index() {
  	$v['content'] = 'page/users/riwayat/index';
		$v['title']	 = 'Riwayat';
		$v['jadwal'] = $this->pendaftaran->get_jadwal($this->session->get('user_id'), 'lewat')->getResultArray();
		echo view('layout/user.layout.php', $v);
	}
	public function getNotif() {
		$v['count'] = $this->pendaftaran->count_jadwal($this->session->get('user_id'));
		return $this->response->setJson($v);
	}




}

?>