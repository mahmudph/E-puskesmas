<?php namespace App\Controllers\Dinas;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\Pendaftaran;
use App\Models\PuskesmasModel;
use App\Models\PengumumanModel;
use App\Models\LaporanModel;

class Home extends BaseController
{
	public function __construct() {
		$this->session= session();
		$this->puskes = new PuskesmasModel();
		$this->pendaftaran = new Pendaftaran();
		$this->users  = new UserModel();
		$this->laporan = new LaporanModel();
	}

	public function index()
	{
		$data['content'] = 'page/dinas/home.php';
		$data['title']	 = 'Dashboard';
		$data['statistik_user'] = $this->users->where('user_level !=', 1)->countAllResults();
		$data['statistik_puskes'] =  $this->puskes->countAllResults();
		$data['satistik_pendaftar'] = $this->pendaftaran->countAllResults();
		$data['laporan'] = $this->laporan->where('YEAR(tgl_laporan)', date('Y'))->where('MONTH(tgl_laporan)', date('m'))->countAllResults();
		echo view('layout/dinas.layout.php', $data);
	}

	public function getNotifLaporan() {
		$buider = new LaporanModel();
		$data   = $buider->get_laporan_data();
		$count  = $buider->get_laporan_data_count();

		return $this->response->setJSON(
			[
				'laporan' => $data,
				'count' => $count ?? 0
			]
		);


	}

	/* for admin fungsi */
	public function getNotif() {
		$pengumuman = new PengumumanModel();

		$id    = $this->session->get('id_user');
		$data  = $pengumuman->get_pengumuman($id);
		$count = $pengumuman->get_count_pengumuman($id);
		return $this->response->setJSON(
			[
				'pengumuman' => $data,
				'count' => $count ?? 0
			]
		);

	}
}
