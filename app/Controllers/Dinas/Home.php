<?php namespace App\Controllers\Dinas;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		$data['content'] = 'page/home.php';
		$data['title']	 = 'home page';
		echo view('layout/admin.layout.php', $data);
	}
}
