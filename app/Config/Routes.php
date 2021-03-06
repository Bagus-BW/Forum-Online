<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/Admin', 'Admin/Auth::index');
$routes->get('/Dashboard', 'Admin/Dashboard::index', ['filter' => 'auth']);
$routes->get('/UserAdmin', 'Admin/UserAdmin::index', ['filter' => 'auth']);
$routes->get('/Pengguna', 'Admin/Pengguna::index', ['filter' => 'auth']);
$routes->get('/Kategori', 'Admin/Kategori::index', ['filter' => 'auth']);
$routes->get('/Komentar', 'Admin/Komentar::index', ['filter' => 'auth']);
$routes->get('/Postingan', 'Admin/Postingan::index', ['filter' => 'auth']);

$routes->get('/', 'Forum::index');
$routes->get('/Pertanyaan', 'Forum::Forum');
$routes->get('/Pertanyaan/(:alphanum)', 'Forum::DetailForum/$1');
$routes->get('/Login', 'Forum::Login');
$routes->get('/SignUp', 'Forum::SignUp');
$routes->get('/Logout', 'Forum::Logout');



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
