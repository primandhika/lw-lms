<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');

// Admin routes - Login hanya melalui /syslog
$routes->get('/syslog', 'Admin::login');
$routes->post('/syslog', 'Admin::login');
$routes->get('/dashboard', 'Admin::index');
$routes->get('/dashboard/logout', 'Admin::logout');

// User Management
$routes->get('/dashboard/users', 'Admin::users');
$routes->get('/dashboard/users/create', 'Admin::createUser');
$routes->post('/dashboard/users/create', 'Admin::createUser');
$routes->get('/dashboard/users/edit/(:num)', 'Admin::editUser/$1');
$routes->post('/dashboard/users/edit/(:num)', 'Admin::editUser/$1');
$routes->get('/dashboard/users/delete/(:num)', 'Admin::deleteUser/$1');

// Class Management
$routes->get('/dashboard/classes', 'Classes::index');
$routes->get('/dashboard/classes/create', 'Classes::create');
$routes->post('/dashboard/classes/create', 'Classes::create');
$routes->get('/dashboard/classes/edit/(:num)', 'Classes::edit/$1');
$routes->post('/dashboard/classes/edit/(:num)', 'Classes::edit/$1');
$routes->get('/dashboard/classes/delete/(:num)', 'Classes::delete/$1');

// Institution Management
$routes->get('/dashboard/institutions', 'Institutions::index');
$routes->get('/dashboard/institutions/create', 'Institutions::create');
$routes->post('/dashboard/institutions/create', 'Institutions::create');
$routes->get('/dashboard/institutions/edit/(:num)', 'Institutions::edit/$1');
$routes->post('/dashboard/institutions/edit/(:num)', 'Institutions::edit/$1');
$routes->get('/dashboard/institutions/delete/(:num)', 'Institutions::delete/$1');

// Class Join Links - harus di bagian bawah agar tidak conflict dengan route lain
// Hanya tangkap kode kelas 8 karakter alphanumeric
$routes->get('/([A-Z0-9]{8})/joined', 'Classes::joined/$1');
$routes->get('/([A-Z0-9]{8})', 'Classes::join/$1');
$routes->post('/([A-Z0-9]{8})', 'Classes::join/$1');
