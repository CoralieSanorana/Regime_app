<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::singIn');
$routes->get('/singUp', 'Home::singUp');
$routes->get('/logout', 'Home::logout');

$routes->post('/singIn', 'Home::login');
$routes->post('/singUp', 'Home::inscription');


$routes->get('/profil/(:num)', 'Home::profil/$1');
$routes->post('/user/update','Home::updateUser');
$routes->post('/user/update/pwd','Home::updatePwd');
$routes->post('/userDetails/update','Home::updateUserDetails');

$routes->get('/porte_monnaie/(:num)', 'Transaction::findOne/$1');
$routes->post('/porte_monnaie/recharger','Transaction::recharger');

$routes->get('/regimes', 'RegimeController::index');
$routes->get('/regimes/add', 'RegimeController::addForm');
$routes->post('/regimes/add', 'RegimeController::addRegime');
$routes->get('/regimes/edit/(:num)', 'RegimeController::editRegime/$1');
$routes->post('/regimes/update/(:num)', 'RegimeController::updateRegime/$1');
$routes->get('/regimes/delete/(:num)', 'RegimeController::deleteRegime/$1');

$routes->get('/sports', 'Sport::index');
$routes->get('/sports/add', 'Sport::add');
$routes->post('/sports/add', 'Sport::addSport');
$routes->get('/sports/edit/(:num)', 'Sport::edit/$1');
$routes->post('/sports/update/(:num)', 'Sport::updateSport/$1');
$routes->get('/sports/delete/(:num)', 'Sport::deleteSport/$1');