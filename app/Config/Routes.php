<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */



/* untuk pengguna dinas kesehatan */
$routes->group('dinas', ['filter' => 'dinas_authorization'], function($routes) {
	$routes->add('/', 'Dinas\Home::index');
	$routes->add('puskesmas', 'Dinas\Puskesmas::index');
	$routes->add('laporan_pasien', 'Dinas\Laporan_pasien::index');
	$routes->add('pengumuman', 'Dinas\Pengumuman::index');
	$routes->add('pasien', 'Dinas\Pasien::index');
});

/* untuk pengguna admin puskesmas */
$routes->group('admin',['filter' => 'admin_authorization'], function($routes) {
	$routes->add('/', 'Admin\Home::index');
	$routes->add('puskesmas', 'Admin\Puskes::index');
	$routes->add('laporan_pasien', 'Admin\Laporan_pasien::index');
	$routes->add('pengumuman', 'Admin\Pengumuman::index');
});

/* untuk pengguna umum */
$routes->group('users',['filter' => 'user_authorization'], function($routes) {
	$routes->add('/', 'User\Home::index');
	$routes->add('profil', 'User\Home::index');
});


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/register', 'Auth::register');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
