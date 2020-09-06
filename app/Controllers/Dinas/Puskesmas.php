<?php namespace App\Controllers\Dinas;

use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;
use App\Models\AntrianSetting;

class Puskesmas extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->antriansetting = new AntrianSetting();
		$this->puskesmas = new PuskesmasModel();
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
		$query = $this->request->getGet('q');
		$query_status = $this->request->getGet('status');
		if(isset($query)) {
			$data['puskes']	 = $this->puskesmas->asObject()->like('nama_puskesmas', $query)->findAll();
		} else if (isset($query_status)) {
			$data['puskes']	 = $this->puskesmas->asObject()->like('status', $query_status)->findAll();
		} else {
			$data['puskes']	 = $this->puskesmas->asObject()->findAll();
		}
		$data['users']   = $this->users->asObject()->findAll();
		$data['content'] = 'page/dinas/puskesmas/index';
		$data['title']	 = 'Puskesmas';
		echo view('layout/dinas.layout.php', $data);
	}
	public function add_puskesmas() {
		$v['content'] = 'page/dinas/puskesmas/add';
		$v['title']   = 'Tambah puskesmas';
		
		echo view('layout/dinas.layout.php', $v);
	}

	public function edit_puskesmas($id) {
		$result = $this->puskesmas->asObject()->where('id', $id)->limit(1)->find();
		return $this->response->setHeader('Content-Type','application/json')->setJSON($result);
	}

	/* add simpan data baru puskesmas */
	public function simpan_puskesmas() {
		$data = [
			'nama_puskesmas' => $this->request->getPost('nama_puskesmas'),
			'email_puskesmas' => $this->request->getPost('email_puskesmas'),
			'alamat_puskesmas' => $this->request->getPost('alamat_puskes'),
			'status' =>$this->request->getPost('status'),
			'token_aktifasi' =>$this->request->getPost('token_aktifasi'),
		];

		$result = $this->form_validation->run($data, 'new_puskesmas');
		if(!$result) {
			/* ada error disini */
			$v['errors'] = $this->form_validation->getErrors();
			$v['inputs'] = $this->request->getPost();

			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('dinas/puskesmas'));
		} else {
			/* tidak ada eror, ismpan data  */
			$data['status'] = 'belum teraktifasi';
			$data['token_aktifasi'] = $data['token_aktifasi'];
			$id = $this->puskesmas->insert($data);

			/* insert as default setting */
			$this->antriansetting->insert(['id_puskes' => $id, 'jmlh_antrian' => 30]);
			return redirect()->to(base_url('dinas/puskesmas'));
		}
	}

	public function simpan_edited_puskesmas() {
		$data = [
			'id' => $this->request->getPost('id_puskes'),
			'nama_puskesmas' => $this->request->getPost('nama_puskesmas'),
			'email_puskesmas' => $this->request->getPost('email_puskesmas'),
			'alamat_puskesmas' => $this->request->getPost('alamat_puskes'),
			'token_aktifasi' =>$this->request->getPost('token_aktifasi'),
		];

		$result = $this->form_validation->run($data, 'update_puskesmas');
		if(!$result) {
			/* ada error disini */
			$v['errors'] = $this->form_validation->getErrors();
			$v['inputs'] = $this->request->getPost();

			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('dinas/puskesmas'));
		} else {
			/* tidak ada eror, update data  */
			$this->puskesmas->save($data);
			$v['success']  = ['berhasil mengedit data puskesmas'];
			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('dinas/puskesmas'));
		}
	}

	public function delete_puskesmas($id) {
		$del = $this->puskesmas->delete($id);
		if($del) {
			$v['success'] = ['Data berhasil dihapus'];
			
			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('dinas/puskesmas'));
		} else {
			$v['errors'] = ['Data gagal untuk dihapus'];

			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('dinas/puskesmas'));
		}
	}


}
