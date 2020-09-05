<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
		$this->users   = new UserModel();
		$this->email 	 = \Config\Services::email();
		$this->session = \Config\Services::session();
		$this->puskesmas = new \App\Models\PuskesmasModel();
		$this->form_validation = \Config\Services::validation();

		if($this->session->has('is_login')) {
			$usr_level =  $this->session->get('user_level');
			if($usr_level == 1 ) {
				return  redirect()->to('/dinas');
			} else if($usr_level == 2 ){
				
				return  redirect()->to('/admin');
			} else {
				
				return  redirect()->to('/user');
			}
		}
	}

	public function index() {
		return redirect()->to(base_url('auth/login'));
	}

	public function login()
	{
		$data['title'] = 'Login diperlukan';
		return view('page/login', $data);
	}

	public function proses_login() {
		$email = $this->request->getPost('email');
		$pwd   = $this->request->getPost('password');

		$result = $this->form_validation->run(['email' => $email, 'password' => $pwd], 'login');
		if(!$result) {

			$data['inputs'] = $this->request->getPost();
			$data['errors'] = $this->form_validation->getErrors();
			$this->session->setFlashdata('response', $data);
			return redirect()->to(base_url('auth/login'));

		} else {
			$pwd  = password_verify($pwd, PASSWORD_DEFAULT);
			$user = $this->users->find_by_email_pwd($email, $pwd);
			if(isset($user)){
				$data_user 			 = ['nama' => $user->nama, 'is_login' => true,'user_level' => $user->user_level, 'user_id' => $user->id];
				$this->session->set($data_user);
				$user_level = $this->session->get('user_level');
				if( $user_level == 1) {
					return redirect()->to(base_url('dinas'));
				} elseif ($user_level == 2) {
						$puskesmas 			 = $this->puskesmas->where('admin_puskesmas', $user->id)->limit(1)->select('tbl_puskesmas.nama_puskesmas,tbl_puskesmas.id as puskesmas_id')->get()->getResultArray();
						$this->session->set($puskesmas[0]);
					return redirect()->to(base_url('admin'));
				} else{
					return redirect()->to(base_url('user'));
				}

			} else {
				$data['inputs'] = $this->request->getPost();
				$data['errors'] = ['email atau password tidak terdaftar'];
				$this->session->setFlashdata('response', $data);

				return redirect()->to(base_url('auth/login'));
			}

		}
	}
	public function register() {
		$data['title'] = 'Registrasi user baru';
		echo view('page/registrasi', $data);
	}

	public function proses_register() {
		$dataInput =[
			'nama' => $this->request->getPost('nama'),
			'email' => $this->request->getPost('email'),
			'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
			'desa' => $this->request->getPost('desa'),
			'tgl_lahir' => $this->request->getPost('tgl_lahir'),
			'alamat' => $this->request->getPost('alamat'),
			'password'	 => $this->request->getPost('password'),
			'confirm_password'	 => $this->request->getPost('confirm_password'),
		];
		$result = $this->form_validation->run($dataInput, 'register');
		if($result) {
			/* success register */
			$dataInput['password'] = password_hash($dataInput['password'], PASSWORD_DEFAULT);
			$dataInput['user_level'] = 3;


			/* remove confirm password */
			// unset($dataInput['confirm_password']);
			$this->users->insert($dataInput);
			/* set session flash */
			$data['inputs']['email']    = $dataInput['email'];
			$data['inputs']['password'] = '';
 			$data['success'] = ['registrasi akun berhasil'];
			$this->session->setFlashdata('response', $data);
			return redirect()->to(base_url('auth/login'));

		} else {
			/* register gagal */
			$data['inputs'] = $this->request->getPost();
			$data['errors'] = $this->form_validation->getErrors();
			$this->session->setFlashdata('response', $data);
			return redirect()->to(base_url('auth/register'));
		}
	}
	public function logout() {
		$this->session->destroy();
		return redirect()->to(base_url('auth/login'));
	}

	public function reset_password() {
		$v['title'] = 'Reset password';
		echo view('page/reset_password', $v);
	}

	public function reset_password_post() {
		$data =[
			'email' => $this->request->getPost('email')
		];
		$result = $this->form_validation->run($data, 'reset_pwd');
		if($result) {
			$user = $this->users->toObject()->where('email', $data['email'])->limit(1)->find();
			if(!empty($user)) {
				/* send reset password token here */
				$v = ['Token reset password sudah dikirim ke email'];
			} else {
				$v = ['Email Tidak ditemukan'];
			}
			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('auth/reset_pasword'));
		} else {
			/* something wrong with input value */

		}
	}
}
