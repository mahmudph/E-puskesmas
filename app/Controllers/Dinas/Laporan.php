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
		$client->addScope(\Google_Service_Drive::DRIVE);
		$client->setAccessType('offline');
		$path= APPPATH.'data/googlesheet.json';
		$client->setAuthConfig($path);
		$sheets = new \Google_Service_Sheets($client);

		$spreadsheet = new \Google_Service_Sheets_Spreadsheet([
			'properties' => [
					'title' => 'Laporan data pendaftaran oneline'
			]
		]);
		// $spreadsheet = $sheets->spreadsheets->create($spreadsheet, [
		// 		'fields' => 'spreadsheetId'
		// ]);
		$options = array('valueInputOption' => 'RAW');
		$values = $this->laporan->get_pasien_pendaftaran($id);

		/* set intialize value */
		// return $this->response->setJson($values);
		// dd($values[])
		$temp = [];
		$header = [['No', 'nama', 'email', 'desa', 'alamat', 'jenis_kelamin', 'tanggal_daftar', 'tgl_digunakan', 'diagnosis', 'obat']];
			foreach($values as $key => $val) {
				// tbl_users.nama, tbl_users.email,tbl_users.desa, tbl_users.alamat,tbl_users.jenis_kelamin, tbl_users.tgl_lahir, tbl_pendaftarans.tgl_daftar, tbl_pendaftarans.tgl_digunakan
				array_push($temp, [($key +1), $val['nama'], $val['email'], $val['desa'], $val['alamat'], $val['jenis_kelamin'] == 'p' ? 'perempuan' : 'laki-laki', $val['tgl_daftar'], $val['tgl_digunakan'], $val['diagnosis'], $val['obat'] ]);
			}

		// dd($temp);
		$temp = array_merge($header, $temp);

		// dd($temp);
		$body = new \Google_Service_Sheets_ValueRange([
			'values' => $temp,
		]);

		/* remove before insert */
		// TODO: Assign values to desired properties of `requestBody`:
		$spreadsheetId='1-l6DJYe5GESlvewE1EE9k9ZIM-Jver9PLlJ49sTCQ7w';
		$range ='Sheet1!A1:K9';
		$optParams=$options;
		$requestBody = new \Google_Service_Sheets_ClearValuesRequest();
		$response = $sheets->spreadsheets_values->clear($spreadsheetId, $range, $requestBody);

		/* insert new data */
		$result = $sheets->spreadsheets_values->update(
			$spreadsheetId=$spreadsheetId,
			$range = $range,
			$body = $body,
			$optParams=$optParams
		);
		
		// $auth_url = $client->createAuthUrl();
		// $auth_url = $client->createAuthUrl();
		// header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
		// $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
		// $httpClient = $client->authorize();
		// $response = $httpClient->get('https://www.googleapis.com/auth/drive.readonly');
		// print_r($response);
		// print($spreadsheet->spreadsheetId);
		// https://docs.google.com/spreadsheets/d/1-l6DJYe5GESlvewE1EE9k9ZIM-Jver9PLlJ49sTCQ7w/edit?usp=sharing
		return redirect()->to("https://docs.google.com/spreadsheets/d/1-l6DJYe5GESlvewE1EE9k9ZIM-Jver9PLlJ49sTCQ7w/edit?usp=sharing");
	}
}
