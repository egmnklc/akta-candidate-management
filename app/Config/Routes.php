<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
    * Syntax:
    ! $routes->get('redirectedAdress', 'Controller::function')
*/


$routes->get('/public/index.php', 'Users::index');
$routes->get('/public', 'Users::index', ['filter' => 'Noauth']);

$routes->get('/', 'Users::index', ['filter' => 'Noauth']);
$routes->post('/', 'Users::index', ['filter' => 'Noauth']);

// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
// $routes->get('/public/index.php/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('/public/index.php/profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('/public/profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('/profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('users/profile', 'Users::profile', ['filter' => 'auth']);

$routes->get('/upload', 'Upload::index');
$routes->post('/upload.php', 'Upload::store');
$routes->get('upload.php', 'Upload::store');
$routes->post('/public/Upload/store', 'Upload::store');
$routes->get('/image_form', 'Upload::index');
$route['uploads/(:any)'] = "C:\\xampp\\htdocs\\codeigniter4\\aktahr\\writable\\\uploads\\$1";
$routes->get("uploads/(:any)", "Upload::display_image");

$routes->match(['get', 'post'],'register', 'Users::register', ['filter' => 'Noauth']);
$routes->match(['get', 'post'],'profile', 'Users::profile', ['filter' => 'auth']);


$routes->get('/candidates', 'CandidateController::index', ['filter' => 'auth']);
$routes->get('public/canditates/fetch_single_data/(:any)', 'CandidateController::fetch_single_data/$1');
$routes->get('public/candidates/delete/(:any)', 'CandidateController::delete/$1');
$routes->get('public/candidates/add', 'CandidateController::add');

$routes->get('public/index.php/candidates', 'CandidateController::index');

$routes->get('/crud', 'EditCandidate::index');

$routes->get('public/crud/edit_validation', 'CandidateController::edit_validation');
$routes->post('public/crud/edit_validation', 'CandidateController::edit_validation');

$routes->get('public/crud/add_validation', 'CandidateController::add_validation');
$routes->post('public/crud/add_validation', 'CandidateController::add_validation');

$routes->get('public/ajax_crud/fetch_all', 'CandidateController::fetch_all');
$routes->post('public/ajax_crud/fetch_all', 'CandidateController::fetch_all');
$routes->post('public/ajax_crud/action', 'CandidateController::action');
$routes->get('public/ajax_crud/fetch_single_data', 'CandidateController::fetch_single_data');
$routes->get('public/ajax_crud/action', 'CandidateController::action');

$routes->get('/logout', 'Users::logout');
/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
