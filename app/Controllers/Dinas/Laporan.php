<?php namespace App\Controllers\Dinas;

use App\Models\LaporanModel;
use App\Models\Pendaftaran;
use App\Models\UserModel;
use App\Models\PuskesmasModel;
use App\Controllers\BaseController;
use App\Libraries\GoogleSheet;

class Laporan extends BaseController
{
	public function __construct() {
		helper('url');
		helper('form');
		$this->session   = session();
		$this->users     = new UserModel();
		$this->pendaftaran = new Pendaftaran();
		$this->puskesmas = new PuskesmasModel();
		$this->laporan = new LaporanModel();
		$this->form_validation = \Config\Services::validation();
	}
	public function index(){
		$data['title']	 = 'Puskesmas';
		$data['content'] = 'page/dinas/laporan/index';
		$data['puskesmas'] = $this->puskesmas->get()->getResultArray();
		$data['pasien']  = $this->laporan->get_laporan_data();
		$data['bulan']   = $this->laporan->generate_bulan();
		echo view('layout/dinas.layout.php', $data);
	}	

	public function ubah($id) {
		$v['title'] = 'Ubah Data Pasien';
		$v['content'] = 'page/dinas/pasien/ubah';
		$v['data'] = $this->pendaftaran->get_pasien_by_id($id);
		echo view('layout/dinas.layout.php', $v);
	}

	public function delete($id) {
		$this->pendaftaran->where('id', $id)->delete();
		return redirect()->back();
	}

	public function get_data() {
		$tahun = $this->request->getGet('tahun') ?? date('Y');
		$bulan = $this->request->getGet('bulan') ;
		
		$data = $this->laporan->join('tbl_puskesmas', 'tbl_puskesmas.id=tbl_laporans.id_puskesmas')
			->where('YEAR(tgl_laporan)', $tahun);

			if($bulan) {
				$data->where('MONTH(tgl_laporan)',$bulan);
			}

			$data = $data->select('tbl_laporans.*, tbl_puskesmas.nama_puskesmas')
			->get()->getResultArray();
			return $this->response->setJSON($data);
	}


	public function detail($id) {
		$v['title'] = 'Detail Laporan Puskesmas';
		$v['content'] = 'page/dinas/laporan/detail';
		$v['laporan'] = $this->laporan->get_by_id($id);
		echo view('layout/dinas.layout.php', $v);
	}

	public function get_pasien_pendaftaran($id) {
		$data = $this->laporan->get_pasien_pendaftaran($id);
		return $this->response->setJSON($data);
	}

	public function verifikasi($id) {
		$this->laporan->set('status_baca', 1);
		$this->laporan->where('id', $id);
		$this->laporan->update();

		/* give response to users */
		$v['success'] = ['sukses memferivikasi laporan'];
		$this->session->setFlashdata('response',$v);
		return redirect()->back();
	}
	public function generate_data($id) {
		$client = new GoogleSheet();
		$client->setApplicationName('My PHP App');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');

		$path= APPPATH.'data/googlesheet.json';
		$client->setAuthConfig($path);
		$client->setAccessToken(getenv('app.googlesheettoken'));
		$sheets = new \Google_Service_Sheets($client);

		$sheetInfo = $sheets->spreadsheets->get(getenv('app.googlesheetid'))->getProperties();
		print($sheetInfo['title']. PHP_EOL);

		$options = array('valueInputOption' => 'RAW');
		$values = [
				["Name", "Roll No.", "Contact"],
				["Anis", "001", "+88017300112233"],
				["Ashik", "002", "+88017300445566"]
		];
		$body   = new \Google_Service_Sheets_ValueRange(['values' => $values]);

		$result = $sheets->spreadsheets_values->update(getenv('app.googlesheetid'), 'A1:C3', $body, $options);
	}
}
