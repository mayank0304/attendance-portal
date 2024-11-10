<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->post('/loginUser', 'Auth::loginUser');
$routes->get('/registerUser', 'Auth::registerUser');
$routes->get('/attendance', 'Attendance::attend');
$routes->get('/logout', 'Auth::logout');
