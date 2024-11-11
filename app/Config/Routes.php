<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->post('/loginUser', 'Auth::loginUser');
// $routes->get('/registerUser', 'Auth::registerUser');
$routes->get('/attendance/scan', 'AttendanceController::scanQrCode');
$routes->post('/attendance/mark', 'AttendanceController::markAttendance');
$routes->get('/students', 'StudentController::index');
$routes->get('/generate-qr-codes', 'QrCodeGenerator::generateQrCodes');
$routes->get('/logout', 'Auth::logout');
