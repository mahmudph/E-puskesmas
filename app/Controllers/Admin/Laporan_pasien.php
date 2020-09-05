<?php namespace App\Controllers\Admin;

use App\Models\LaporanPasien;
use App\Models\PengumumanModel;
use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;

class Laporan_pasien extends BaseController {
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
  	$v['content'] = 'page/admin/laporan/index';
    $v['title']	 = 'Laporan';
    $v['laporans'] = $this->laporan->where('id_puskesmas', $id_puskesmas)
    ->join('tbl_laporan_pasiens', 'tbl_laporan_pasiens.id_laporan=tbl_laporans.id', 'left')
    ->orderBy('tbl_laporans.tgl_laporan', 'desc')
    ->groupBy('tbl_laporans.id, MONTH(tbl_laporans.tgl_laporan)')
    ->select('count(tbl_laporan_pasiens.id) as total, tbl_laporans.*')
    ->get()->getResultArray();
    // dd($v['laporans']);
		echo view('layout/admin.layout.php', $v);
  }
  
  public function delete($id){
    $this->laporan->where('id', $id)->delete();
    $v['success'] = ['Data berhasil dihapus'];
    $this->session->setFlashdata('response', $v);
    return redirect()->to(base_url('admin/laporan'));
  }

  public function ubah($id) {
    $v['data'] = $this->laporan->join('tbl_laporan_pasiens', 'tbl_laporan_pasiens.id_laporan=tbl_laporans.id')
    ->where('id', $id)->get()->getResultArray();
    return $this->response->setJson($v);
  }

  public function tambah() {
    $id_puskesmas = $this->session->get('puskesmas_id');
    $countLaporan = $this->laporan->get_data_by_id($id_puskesmas)->countAllResults();
    if($countLaporan < 1 ) {
      
      $data = [
        'id_puskesmas' => $id_puskesmas,
        'tgl_laporan' => date('Y-m-d'),
        'status_baca' => 0, //default 
      ];
      
      $v['id_laporan'] = $this->laporan->insert($data);
      $v['total'] = $this->pendaftaran->get_data($id_puskesmas)->countAllResults();
      $v['pendaftar'] = $this->pendaftaran->get_data($id_puskesmas)->get()->getResultArray();
      $v['content'] = 'page/admin/laporan/tambah';
      $v['title']	 = 'Tambah Laporan';

      echo view('layout/admin.layout.php', $v);

    } else {
      $v['errors'] = ['laporan hanya bisa dibuat satu kali disetiap bulan'];
      $this->session->setFlashdata('response', $v);
      return redirect()->back();
    }
  }

  public function create($id) {
    $id_data = explode(',',$this->request->getPost('id'));
    
    $data = [];
    foreach($id_data as $key => $val) {
      if($val != null or $val != '') {
        array_push($data, [
          'id_laporan' => $id,
          'id_pendaftar' => $val,
        ]);
      }
    }

    $builder = new LaporanPasien();
    $builder->insertBatch($data);
    return $this->response->setJson(['msg' =>'data berhasil ditambahkan', 'data'=> $id_data]);

    
  }

  public function edit($id) {
    $id_puskesmas = $this->session->get('puskesmas_id');
    $v['id_laporan'] = $id;
    $v['total'] = $this->pendaftaran->get_data($id_puskesmas)->countAllResults();
    $v['pendaftar'] = $this->pendaftaran->get_data($id_puskesmas)->get()->getResultArray();
    $v['content'] = 'page/admin/laporan/tambah';
    $v['title']	 = 'Edit Laporan';
    echo view('layout/admin.layout.php', $v);
  }

}

?>