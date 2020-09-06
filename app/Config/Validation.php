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
    'password' => 'required|min_length[6]',
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

	public $change_password = [
		'password' => 'required|min_length[6]',
		'confirm_password' =>'required|matches[password]',
	];

	public $change_password_errors = [
		'password' =>  [
			'required' => 'password tidak boleh kosong',
			'min_length' => 'password harus memiliki  minimal 6 karakter',
		],
		'confirm_password' => [
			'required' => 'password tidak boleh kosong',
			'matches' => 'confirm password tidak cocok',
		]
	];


	public $register = [
		'nama' => 	'required|min_length[8]',
		'email' => 'required|valid_email',
		'jenis_kelamin' => 'required|in_list[pria, wanita]',
		'tgl_lahir' => 'required|valid_date',
		'desa' => 'required',
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
		'desa' =>  [
			'required' =>'field desa tidak boleh kosong',
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
		'email_puskesmas' => 'required|valid_email',
		'alamat_puskesmas' => 'required',
		'token_aktifasi' => 'required|min_length[6]',
	];

	public $new_puskesmas_errors = [
		'nama_puskesmas' => [
			'required' => 'field nama puskesmas tidak boleh kosong ',
		],
		'email_puskesmas' => [
			'required' => 'field nama puskesmas tidak boleh kosong ',
			'required' => 'field email puskesmas tidak valid ',
		],
		'alamat_puskesmas' => [
			'required' => 'field alamat puskesmas tidak boleh kosong ',
		],
		'token_aktifasi' => [
			'required' => 'field token aktifasi admin tidak boleh kosong ',
		],
	];

	public $update_puskesmas = [
		'nama_puskesmas' => 'required',
		'email_puskesmas' => 'required|valid_email',
		'alamat_puskesmas' => 'required',
		'token_aktifasi' => 'required|min_length[6]',
	];

	public $update_puskesmas_errors = [
		'nama_puskesmas' => [
			'required' => 'field nama puskesmas tidak boleh kosong ',
		],
		'email_puskesmas' => [
			'required' => 'field nama puskesmas tidak boleh kosong ',
			'required' => 'field email puskesmas tidak valid ',
		],
		'alamat_puskesmas' => [
			'required' => 'field alamat puskesmas tidak boleh kosong ',
		],
		'token_aktifasi' => [
			'required' => 'field token aktifasi admin tidak boleh kosong ',
			'min_length' => 'field token harus diatas 6 huruf'
		],

	];


	public $daftar_online = [
		'nama' => 'required', 
		'id_user' => 'required|numeric',
		'id_puskesmas'  => 'required|numeric',
		'no_hp' => 'required|min_length[12]', 
		'tgl_digunakan' => 'required|valid_date',
		'keterangan' => 'required'
	];

	public $daftar_online_errors = [
		'nama' => [
			'required' => 'filed nama tidak boleh kosong',
		], 
		'id_user'  => [
			'required' => 'filed id_user tidak boleh kosong',
			'number' => 'field ini harus bertipe angka',
		],
		'id_puskesmas' => [
			'required' => 'filed id_user tidak boleh kosong',
			'number' => 'field ini harus bertipe angka',
		],
		'no_hp' => [
			'required' => 'field nomer hp tidak boleh kosong', 
			'numeric' => 'filed no hp harus diatas 11 huruf'
		],
		'tgl_digunakan' => [
			'required' => 'field jadwal tidak boleh kosong', 
			'valid_date' => 'filed jadwal tanggal tidak valid', 
		], 
		'keterangan' => [
			'required' => 'field keterangan tidak boleh kosog'
		]
	];
}

 