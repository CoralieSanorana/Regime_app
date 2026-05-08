<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login et inscription
$routes->get('/', 'Home::singIn');
$routes->get('/singUp', 'Home::singUp');
$routes->get('/logout', 'Home::logout');
$routes->post('/singIn', 'Home::login');
$routes->post('/singUp', 'Home::inscription');

// profil et mise à jour
$routes->get('/profil/(:num)', 'Home::profil/$1');
$routes->post('/user/update','Home::updateUser');
$routes->post('/user/update/pwd','Home::updatePwd');
$routes->post('/userDetails/update','Home::updateUserDetails');

// porte monnaie
$routes->get('/porte_monnaie/(:num)', 'Transaction::findOne/$1');
$routes->post('/porte_monnaie/recharger','Transaction::recharger');

// regimes
$routes->get('/regimes', 'RegimeController::index');
$routes->get('/regimes/add', 'RegimeController::addForm');
$routes->post('/regimes/add', 'RegimeController::addRegime');
$routes->get('/regimes/edit/(:num)', 'RegimeController::editRegime/$1');
$routes->post('/regimes/update/(:num)', 'RegimeController::updateRegime/$1');
$routes->get('/regimes/delete/(:num)', 'RegimeController::deleteRegime/$1');

// sports
$routes->get('/sports', 'Sport::index');
$routes->get('/sports/add', 'Sport::add');
$routes->post('/sports/add', 'Sport::addSport');
$routes->get('/sports/edit/(:num)', 'Sport::edit/$1');
$routes->post('/sports/update/(:num)', 'Sport::updateSport/$1');
$routes->get('/sports/delete/(:num)', 'Sport::deleteSport/$1');

// codes de recharge
$routes->get('/codes', 'Code::index');
$routes->get('/codes/add', 'Code::add');
$routes->post('/codes/add', 'Code::addCode');
$routes->get('/codes/edit/(:num)', 'Code::edit/$1');
$routes->post('/codes/update/(:num)', 'Code::updateCode/$1');