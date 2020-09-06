<?php namespace App\Controllers;

use App\Models\UserModel;

class Wellcome extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
		$this->users   = new UserModel();
		$this->email 	 = \Config\Services::email();
		$this->session = \Config\Services::session();
		$this->puskesmas = new \App\Models\PuskesmasModel();
		$this->form_validation = \Config\Services::validation();
	}

	public function index() {
    if($this->session->get('is_login')) {
			$usr_level =  $this->session->get('user_level');
			if($usr_level == 1 ) {
				return  redirect()->to('/dinas');
			} else if($usr_level == 2 ){
				
				return  redirect()->to('/admin');
			} else {
				
				return  redirect()->to('/user');
			}
    } else {
      return  redirect()->to('/auth/login');
    }
  }
}
