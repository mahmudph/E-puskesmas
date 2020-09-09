<?php namespace App\Controllers\User;

use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\AntrianModel;
use App\Models\AntrianSetting;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;

class Puskesmas extends BaseController {
  public function __construct() {
    helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->pendaftaran = new Pendaftaran();
		$this->puskesmas = new PuskesmasModel();
    $this->laporan = new LaporanModel();
    $this->antrian = new AntrianModel();
		$this->form_validation = \Config\Services::validation();
  }
  public function index() {
  	$v['content'] = 'page/users/puskesmas/index';
		$v['title']	 = 'Puskesmas';

    $query = $this->request->getGet('q');
		$query_status = $this->request->getGet('status');
		if(isset($query)) {
			$v['puskes']	 = $this->puskesmas->asObject()->like('nama_puskesmas', $query)->findAll();
		} else if (isset($query_status)) {
			$v['puskes']	 = $this->puskesmas->asObject()->like('status', $query_status)->findAll();
		} else {
			$v['puskes']	 = $this->puskesmas->asObject()->findAll();
		}
		$v['users']   = $this->users->asObject()->findAll();
		echo view('layout/user.layout.php', $v);
	}
	public function getNotif() {
		$v['count'] = $this->pendaftaran->count_jadwal($this->session->get('user_id'));
		return $this->response->setJson($v);
	}

  public function daftar($id) {
    $antrian_setting_builder = new AntrianSetting();
    /* get batas total antrian  */
    $setting = $antrian_setting_builder->where('id_puskes',$id)->get()->getRow(); 

    /* get jumlah antrian hari ini  */
    if($setting) {
      $totalAntrian = $this->antrian->get_antrian($id, null)->countAllResults();
      if($setting->jmlh_antrian > $totalAntrian) {
        $v['content'] = 'page/users/puskesmas/daftar';
        $v['title']	 = 'Puskesmas';
        $v['puskesmas']  = $this->puskesmas->find($id);
        echo view('layout/user.layout.php', $v);
      } else {
        $v['errors'] = ['antrian puskesmas untuk hari ini sudah penuh'];
        $this->session->setFlashdata('response', $v);
        return redirect()->back();
      }
    } else {
        
      $v['errors'] = ['puskesmas belum menentukan jumlah antrian untuk hari ini'];
      $v['inputs'] = $this->request->getPost();
      $this->session->setFlashdata('response', $v);
      return redirect()->back();
    }
 
  }

  public function daftar_online() {
    $data = [
      'nama'       => $this->request->getPost('nama'),
      'id_user'    => $this->request->getPost('id_user'),
      'id_puskesmas'=>$this->request->getPost('id_puskesmas'),
      'tgl_digunakan' => $this->request->getPost('jadwal_datang'),
      'tgl_daftar' => date('Y-m-d'),
			'no_hp'       => $this->request->getPost('no_hp'),
			'keterangan'  =>$this->request->getPost('keterangan'),
		];

		$result = $this->form_validation->run($data, 'daftar_online');
		if(!$result) {
			/* ada error disini */
			$v['errors'] = $this->form_validation->getErrors();
			$v['inputs'] = $this->request->getPost();

			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('user/puskesmas/daftar/'.$this->request->getPost('id_puskesmas')));
		} else {
			/* tidak ada eror, ismpan data  */
      $id = $this->pendaftaran->insert($data);

      /* tentukan antrian hari ini */
      $antrian = $this->antrian->get_antrian($this->request->getPost('id_puskesmas'), $data['tgl_digunakan'])->countAllResults();
      $this->antrian->insert(['id_pendaftaran'=> $id, 'no_antrian' => $antrian == 0 ? 1 : $antrian + 1 ]);
			return redirect()->to(base_url('user/puskesmas/'));
		}
  }



}

?>