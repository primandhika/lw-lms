<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');

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
