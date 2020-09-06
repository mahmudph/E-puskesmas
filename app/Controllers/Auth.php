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

		if($this->session->get('is_login')) {
			$usr_level =  $this->session->get('user_level');
			if($usr_level == 1 ) {
				return  redirect()->to(base_url('dinas'));
			} else if($usr_level == 2 ){
				
				return  redirect()->to(base_url('admin'));
			} else {
				
				return  redirect()->to(base_url('user'));
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

			/* check if email exsist in tabel perpustakaan  
				if exsist then compare password with token 
				if same redirect to the new page and change password
			*/

			$data_puskes = $this->puskesmas->where('email_puskesmas', $email)->countAllResults();
			$dataRow = $this->puskesmas->where('token_aktifasi !=', null)->where('email_puskesmas', $email)->get()->getRow();
			if($data_puskes > 0 && $dataRow->token_aktifasi != null) {
				if($dataRow->token_aktifasi == $pwd) {
							/* data is same  then rediect */
							return redirect()->to(base_url('auth/reset_password/'.$dataRow->id));
				} else {
					/* passsword tidak sama  */
					$v['inputs'] = $this->request->getPost();
					$v['errors'] = ['token aktifasi admin puskes tidak sama'];
					$this->session->setFlashdata('response', $v);
					return redirect()->to(base_url('auth/login'));


				}
			} else  {
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

	public function reset_password($id) {
		$v['title'] = 'Reset password';
		$v['puskesmas_id']= $id;
		echo view('page/reset_password', $v);
	}

	public function reset_password_post() {
		$data =[
			'password' => $this->request->getPost('password'),
			'confirm_password' => $this->request->getPost('confirm_password'),
		];

		$result = $this->form_validation->run($data, 'change_password');
		if($result) {
			/* create new users with level 4 */
			
			$puskes = $this->puskesmas->where('id',$this->request->getPost('puskesmas_id'))->get()->getRow();
			$id = $this->users->insert([
					'nama' => 'admin '.$puskes->nama_puskesmas,
					'email' => $puskes->email_puskesmas,
					'jenis_kelamin' => null,
					'tgl_lahir' => null,
					'desa' => $puskes->nama_puskesmas,
					'alamat' => $puskes->alamat_puskesmas,
					'user_level' => 2, 
					'password' => password_hash(trim($this->request->getPost('password')), PASSWORD_DEFAULT)
			]);
			/* update token and change status puskesmas */
			$this->puskesmas->set('token_aktifasi', '');
			$this->puskesmas->set('status', 'teraktifasi');
			$this->puskesmas->set('admin_puskesmas', $id);
			$this->puskesmas->where('email_puskesmas', $puskes->email_puskesmas)->update();


			$v['inputs']['email'] = '';
			$v['inputs']['password'] = '';
			$v['errors'] = [];
			$this->session->setFlashdata('response', $v);
			return redirect()->to(base_url('auth/login'));
		} else {
			/* something wrong with input value */
			$data['inputs'] = $this->request->getPost();
			$data['errors'] = $this->form_validation->getErrors();
			$this->session->setFlashdata('response', $data);
			return redirect()->to(base_url('auth/login'));
		}
	}
}
