<?php namespace App\Database\Seeds;

// use \Config\Services::encrypter();
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;


class TblUser extends Seeder
{
	public function run()
	{
		$data = [
			'nama' => 'admin',
			'email'    => 'admin@gmail.com',
			'jenis_kelamin' => 'L',
			'tgl_lahir' => Time::createFromDate(2000, 2,15),
			'alamat' => 'palembang city',
			'user_level' => 1,
			'password' => password_hash('administrator', PASSWORD_DEFAULT),
		];
		$this->db->table('tbl_users')->insert($data);
	}
}
