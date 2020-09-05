<?php namespace App\Controllers\Admin;


use App\Models\PengumumanModel;
use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Models\AntrianSetting;
use App\Controllers\BaseController;

class Pengaturan extends BaseController {
  public function __construct() {
    helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->pendaftaran = new Pendaftaran();
    $this->puskesmas = new PuskesmasModel();
    $this->antriansetting = new AntrianSetting();
    $this->laporan = new LaporanModel();
    $this->pengumuman = new PengumumanModel();
		$this->form_validation = \Config\Services::validation();
  }
  public function index() {
    $id_puskesmas = $this->session->get('puskesmas_id');
  	$v['content'] = 'page/admin/pengaturan/index';
    $v['title']	 = 'Pengaturan';
    $v['pengaturan'] = $this->antriansetting->where('id_puskes', $id_puskesmas)->get()->getRow();
    $v['puskesmas'] = $this->puskesmas->join('tbl_users', 'tbl_users.id=tbl_puskesmas.admin_puskesmas')
    ->where('tbl_puskesmas.id',$id_puskesmas)
    ->select('tbl_users.nama,tbl_puskesmas.*')
    ->get()->getRow();
		echo view('layout/admin.layout.php', $v);
	}
	public function getNotif() {
    $id_puskesmas = $this->session->get('puskesmas_id');
    $v['count'] = $this->pengumuman->get_pengumumans($id_puskesmas)->countAllResults();
    $v['pengumuman'] =  $this->pengumuman->get_pengumumans($id_puskesmas)->get()->getResultArray();
    $v['pendaftar'] = $this->pendaftaran->statistik_count($id_puskesmas)->where('DAY(tgl_daftar)', date('d'))->where('tgl_digunakan >',date('Y-m-d'))->countAllResults();
		return $this->response->setJson($v);
  }
  
  public function update($id) {
    $jmlh = $this->request->getPost('jmlh_antrian');
    $id = $this->request->getPost('id_puskes');

    $this->antriansetting->set('jmlh_antrian', $jmlh);
    $this->antriansetting->where('id', $id)->update();
    return $this->response->setJson($this->request->getPost());
  }

  public function ubah($id) {
    $v['pengaturan']  = $this->antriansetting->find($id);
    return $this->response->setJson($v);
  }

}

?>