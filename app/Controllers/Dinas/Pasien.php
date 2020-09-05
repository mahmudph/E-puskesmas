<?php namespace App\Controllers\Dinas;

use App\Models\Pendaftaran;
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
		$this->pendaftaran = new Pendaftaran();
		$this->puskesmas = new PuskesmasModel();
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
		$data['title']	 = 'Puskesmas';
		$data['content'] = 'page/dinas/pasien/index';
		$data['pasien']  = $this->pendaftaran->get_pasien($this->session->get('puskesmas_id'));
		echo view('layout/dinas.layout.php', $data);
	}	

	public function ubah($id) {
		$v['title'] = 'Ubah Data Pasien';
		$v['content'] = 'page/dinas/pasien/ubah';
		$v['data'] = $this->pendaftaran->get_pasien_by_id($id);
		echo view('layout/dinas.layout.php', $v);
	}

	public function delete($id) {
		$this->pendaftaran->where('id', $id)->delete();
		return redirect()->back();
	}


}
