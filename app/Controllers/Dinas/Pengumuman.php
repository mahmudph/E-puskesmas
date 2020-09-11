<?php namespace App\Controllers\Dinas;


use App\Models\Penerimapengumuman;
use App\Models\PuskesmasModel;
use App\Models\PengumumanModel;
use App\Controllers\BaseController;
class Pengumuman extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
    $this->session   = session();
    $this->penerimaPengumuman = new Penerimapengumuman();
    $this->puskesmas = new PuskesmasModel();
		$this->pengumuman = new PengumumanModel();
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
		$data['title']	 = 'Pengumuman';
		$data['content'] = 'page/dinas/pengumuman/index';
    $data['pengumuman']  = $this->pengumuman->get()->getResultArray();
		echo view('layout/dinas.layout.php', $data);
	}	

	public function ubah($id) {
		$v['title'] = 'Ubah Pengumuman';
		$v['content'] = 'page/dinas/pengumuman/ubah';
    $v['data'] = $this->pengumuman->join('tbl_penerima_pengumumans pen', 'pen.id_pengumuman=tbl_pengumumans.id')->where('tbl_pengumumans.id', $id)->get()->getRow();
    $v['puskesmas'] = $this->puskesmas->get()->getResultArray();
    echo view('layout/dinas.layout.php', $v);
	}

	public function hapus($id) {
    $v['success'] = ['sukses menghapus pengumuman'];
    $this->session->setFlashdata('response',$v);
		$this->pengumuman->where('id', $id)->delete();
		return redirect()->back();
	}

  public function tambah() {
    $data['title']	 = 'Tambah Pengumuman';
    $data['content'] = 'page/dinas/pengumuman/tambah';
    $data['puskesmas'] = $this->puskesmas->get()->getResultArray();
		echo view('layout/dinas.layout.php', $data);
  }

  public function create() {
    $judul = $this->request->getPost('judul');
    $kirim = $this->request->getPost('kirim_id');
    $isi = $this->request->getPost('isi');

    if($kirim =='sebagian') {
      $penerima = $this->request->getPost('id_puskesmas');
      $data = [
        'judul' => $judul,'id_puskes' => $penerima, 'isi' => $isi, 'tgl_pengumuman' => date('Y-m-d')
      ];
      $save = $this->pengumuman->insert($data);
      $this->penerimaPengumuman->insert(['id_puskes' => $penerima, 'id_pengumuman' => $save]);

    } else {

      $temp = [];
      
      $penerima = $this->puskesmas->get()->getResultArray();
      $data = [
        'judul' => $judul, 'isi' => $isi, 'tgl_pengumuman' => date('Y-m-d')
      ];
      $save = $this->pengumuman->insert($data);
      foreach($penerima as $tujuan) {
        array_push($temp, ['id_puskes' => $tujuan['id'], 'id_pengumuman' => $save]);
      }
      /* save data */
      $this->penerimaPengumuman->insertBatch($temp);
    }

    /* response  */
    $v['success'] = ['sukses menambah pengumuman'];
    $this->session->setFlashdata('response',$v);
    return redirect()->to('/dinas/pengumuman');
  }

  public function update() {
    $id = $this->request->getPost('id');
    $data = [
      'judul' => $this->request->getPost('jenis'), 
      'isi' => $this->request->getPost('isi'), 
    ];

    $this->pengumuman->update($id, $data);
    return $this->response('/dinas/pengumuman');
  }

  protected function response($path) {
		$v['success'] = ['sukses menambah pengumuman'];
    $this->session->setFlashdata('response',$v);
    return redirect()->to($path);
	}

}
