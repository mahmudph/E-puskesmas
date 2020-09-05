<?php namespace App\Controllers\Admin;


use App\Models\PengumumanModel;
use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;

class Pengumuman extends BaseController {
  public function __construct() {
    helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->pendaftaran = new Pendaftaran();
		$this->puskesmas = new PuskesmasModel();
    $this->laporan = new LaporanModel();
    $this->pengumuman = new PengumumanModel();
		$this->form_validation = \Config\Services::validation();
  }
  public function index() {
    $id_puskesmas = $this->session->get('puskesmas_id');
  	$v['content'] = 'page/admin/pengumuman/index';
    $v['title']	 = 'Dashboard';
    $v['pengumuman'] = $this->pengumuman->join('tbl_penerima_pengumumans','tbl_penerima_pengumumans.id_pengumuman=tbl_pengumumans.id')->where('tbl_penerima_pengumumans.id_puskes', $id_puskesmas)->get()->getResultArray();
    $v['total'] = $this->pengumuman->join('tbl_penerima_pengumumans','tbl_penerima_pengumumans.id_pengumuman=tbl_pengumumans.id')->where('tbl_penerima_pengumumans.id_puskes', $id_puskesmas)->countAllResults();
		echo view('layout/admin.layout.php', $v);
	}
	public function getNotif() {
    $id_puskesmas = $this->session->get('puskesmas_id');
    $v['count'] = $this->pengumuman->get_pengumumans($id_puskesmas)->countAllResults();
    $v['pengumuman'] =  $this->pengumuman->get_pengumumans($id_puskesmas)->get()->getResultArray();
    $v['pendaftar'] = $this->pendaftaran->statistik_count($id_puskesmas)->where('DAY(tgl_daftar)', date('d'))->where('tgl_digunakan >',date('Y-m-d'))->countAllResults();
		return $this->response->setJson($v);
	}

}

?>