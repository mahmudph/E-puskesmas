<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function create($a) {
		parent::create($a);
		echo "im here mam";
		$nama = "mahmud";
		echo $nama;
	}

	public function show($table) {
		$this->show($table);
	}

	
	//--------------------------------------------------------------------

}
