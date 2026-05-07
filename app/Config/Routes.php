<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::singIn');
$routes->get('/singUp', 'Home::singUp');
$routes->get('/logout', 'Home::logout');

$routes->post('/singIn', 'Home::login');

$routes->get('/profil/(:num)', 'Home::profil/$1');
$routes->post('/user/update','Home::updateUser');
$routes->post('/user/update/pwd','Home::updatePwd');
$routes->post('/userDetails/update','Home::updateUserDetails');

$routes->get('/porte_monnaie/(:num)', 'Transaction::findOne/$1');
$routes->post('/porte_monnaie/recharger','Transaction::recharger');
$routes->post('/porte_monnaie/rechager','Transaction::recharger');