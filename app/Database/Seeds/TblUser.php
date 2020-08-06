<?php namespace App\Database\Seeds;

// use \Config\Services::encrypter();
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;


class TblUser extends Seeder
{
	public function run()
	{
		$data = [
			'nama' => 'darth',
			'email'    => 'darth@theempire.com',
			'jenis_kelamin' => 'L',
			'tgl_lahir' => Time::createFromDate(2000, 2,15),
			'alamat' => 'palembang city',
			'user_level' => 1,
			'password' => encrypter->encrypt('mahmud12ph'),
		];
		$this->db->table('tbl_user')->insert($data);
	}
}
