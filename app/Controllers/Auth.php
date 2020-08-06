<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
		$this->session = session();
		$this->users   = new UserModel();
		$this->form_validation = \Config\Services::validation();
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
				$data_user = ['nama' => $user->nama, 'is_login' => true,'user_level' => $user->user_level];
				$this->session->set('user', $data_user);
				if($data_user['user_level'] == 1) {
					return redirect()->to(base_url('dinas'));
				} elseif ($data_user['user_level'] == 2) {
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
		$this->session->sess_destroy();
		redirect(base_url('auth/login'));
	}
}
