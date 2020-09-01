<?php namespace App\Controllers\Dinas;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PuskesmasModel;

class Home extends BaseController
{
	public function __construct() {
		$this->puskes = new PuskesmasModel();
		$this->users  = new UserModel();
	}

	public function index()
	{
		$data['content'] = 'page/dinas/home.php';
		$data['title']	 = 'Dashboard';
		$data['statistik_user'] = $this->users->countAll();
		$data['statistik_puskes'] =  $this->puskes->countAll();
		echo view('layout/dinas.layout.php', $data);
	}
}
