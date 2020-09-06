<?php namespace App\Controllers\Admin;


use App\Models\PengumumanModel;
use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;

class PendaftaranCon extends BaseController {
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
  	$v['content'] = 'page/admin/pendaftaran/index';
    $v['title']	 = 'List Data Pendafar';
    $v['total'] = $this->pendaftaran->get_data($id_puskesmas)->where(['diagnosis' => '', 'obat' => ''])->countAllResults();
    $v['pendaftar'] = $this->pendaftaran->get_data($id_puskesmas)->where(['diagnosis' => '', 'obat' => ''])->get()->getResultArray();
		echo view('layout/admin.layout.php', $v);
  }


  public function riwayat() {
    $id_puskesmas = $this->session->get('puskesmas_id');
  	$v['content'] = 'page/admin/pendaftaran/riwayat-pendaftar';
    $v['title']	 = 'List Data Pendafar';
    $v['total'] = $this->pendaftaran->get_data($id_puskesmas)->where(['diagnosis !=' => '', 'obat !=' => ''])->countAllResults();
    $v['pendaftar'] = $this->pendaftaran->get_data($id_puskesmas)->where(['diagnosis !=' => '', 'obat !=' => ''])->get()->getResultArray();
		echo view('layout/admin.layout.php', $v);
  }

	public function getNotif() {
    $id_puskesmas = $this->session->get('puskesmas_id');
    $v['count'] = $this->pengumuman->get_pengumumans($id_puskesmas)->countAllResults();
    $v['pengumuman'] =  $this->pengumuman->get_pengumumans($id_puskesmas)->get()->getResultArray();
    $v['pendaftar'] = $this->pendaftaran->statistik_count($id_puskesmas)
    ->where('DAY(tgl_daftar)', date('d'))
    ->where('tgl_digunakan >',date('Y-m-d'))->where('dianosis', 'NULL')->where('obat', 'NULL')
    ->countAllResults();
		return $this->response->setJson($v);
  }
  
  public function delete($id) {
    $this->pendaftaran->where('id', $id)->delete();
    $v['success'] = ['Data berhasil dihapus'];
    $this->session->setFlashdata('response', $v);
    return redirect()->to(base_url('admin/pendaftaran'));
  }

    
  public function ubah($id) {
    $v['content']   = 'page/admin/pendaftaran/ubah';
    $v['title']	    = 'Ubah data pendaftar'; 
    $v['pendaftar']	= $this->pendaftaran->where('id', $id)->get()->getRow();
    echo view('layout/admin.layout.php', $v);
  }

  public function update() {
    $id = $this->request->getPost('id');
    $obat = $this->request->getPost('obat');
    $dianosis = $this->request->getPost('diagnosis');

    $this->pendaftaran->set('obat', $obat);
    $this->pendaftaran->set('diagnosis', $dianosis);
    $this->pendaftaran->where('id', $id)->update();

    $v = ['Berhasil mengubah data pendaftaran'];
    $this->session->setFlashdata('response', $v);
    return redirect()->to(base_url('admin/pendaftaran'));
  }



}

?> 