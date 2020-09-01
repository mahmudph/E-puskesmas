<?php namespace App\Controllers\Dinas;

use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;

class Pasien extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->puskesmas = new PuskesmasModel();
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
		$data['title']	 = 'Puskesmas';
		$data['content'] = 'page/dinas/pasien/index';
		echo view('layout/dinas.layout.php', $data);
	}	

	public function data() {

	}

}
