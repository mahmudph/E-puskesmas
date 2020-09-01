<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $login = [
    'email' => 'required|valid_email',
    'password' => 'required|min_length[8]',
	];

	public $login_errors = [
		'email' =>  [
			'required' => 'email wajid di sisi',
			'valid_email' => 'email tidak valid',
		],
		'password' => [
			'required' => 'password tidak boleh kosong',
			'min_length' => 'password tidak boleh kurang dari 6 huruf'
		]
	];

	public $register = [
		'nama' => 	'required|min_length[8]',
		'email' => 'required|valid_email',
		'jenis_kelamin' => 'required|in_list[pria, wanita]',
		'tgl_lahir' => 'required|valid_date',
		'alamat' => 'required|min_length[8]',
		'password'	 =>'required|min_length[8]',
		'confirm_password' => 'required|matches[password]',
	];

	public $register_errors = [
		'nama' => [
			'required' =>'field nama tidak boleh kosong',
			'min_length' => 'field nama harus memiliki minimal sebanyak 8',
		],
		'email' => [
			'required' =>'field email tidak boleh kosong',
			'valid_email' => 'email tidak valid',
		],
		'jenis_kelamin'=> [
			'required' =>'field jenis kelamin tidak boleh kosong',
			'in_list' => 'filed jenis kelamin tidak valid',
		],
		'tgl_lahir' =>  [
			'required' =>'field tanggal lahir tidak boleh kosong',
			'valid_date' => 'field tanggal lahir tidak valid',
		],
		'alamat' =>  [
			'required' =>'field alamat tidak boleh kosong',
			'min_length' => 'field alamat harus memiliki minimal sebanyak 8',
		],
		'password'	 => [
			'required' =>'field password tidak boleh kosong',
			'min_length' => 'field password minimal sebanyak 8 huruf',
		],
		'confirm_password' =>  [
			'required' =>'field konfirmasi password tidak boleh kosong',
			'matches' => 'confirm password tidak cocok',
		]
	];

	public $new_puskesmas = [
		'nama_puskesmas' => 'required',
		'alamat_puskesmas' => 'required',
		'admin_puskesmas' => 'required',
		'token_aktifasi' => 'required',
	];

	public $new_puskesmas_errors = [
		'nama_puskesmas' => [
			'required' => 'field nama puskesmas tidak boleh kosong ',
		],
		'alamat_puskesmas' => [
			'required' => 'field alamat puskesmas tidak boleh kosong ',
		],
		'token_aktifasi' => [
			'required' => 'field token aktifasi admin tidak boleh kosong ',
		],
		'admin_puskesmas' => [
			'required' => 'field admin puskesmas tidak boleh kosong',
		]
	];

	public $update_puskesmas = [
		'nama_puskesmas' => 'required',
		'alamat_puskesmas' => 'required',
		'admin_puskesmas' => 'required',
		'token_aktifasi' => 'required',
	];

	public $update_puskesmas_errors = [
		'nama_puskesmas' => [
			'required' => 'field nama puskesmas tidak boleh kosong ',
		],
		'alamat_puskesmas' => [
			'required' => 'field alamat puskesmas tidak boleh kosong ',
		],
		'token_aktifasi' => [
			'required' => 'field token aktifasi admin tidak boleh kosong ',
		],
		'admin_puskesmas' => [
			'required' => 'field admin puskesmas tidak boleh kosong',
		]
	];
}

