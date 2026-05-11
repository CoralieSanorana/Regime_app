<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login et inscription
$routes->get('/', 'Home::singIn');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/logout', 'Home::logout');
$routes->post('/singIn', 'Home::login');

// profil et mise à jour
$routes->get('/profil', 'User::profil');
$routes->post('/user/update','User::updateUser');
$routes->post('/user/update/pwd','User::updatePwd');
$routes->post('/userDetails/update','User::updateUserDetails');

// porte monnaie
$routes->get('/porte_monnaie', 'Transaction::findOne');
$routes->post('/porte_monnaie/recharger','Transaction::recharger');

// regimes
$routes->get('/regimes', 'RegimeController::index');
$routes->get('/regimes/export-list', 'RegimeController::exportList');
$routes->get('/regimes/add', 'RegimeController::addForm');
$routes->post('/regimes/add', 'RegimeController::addRegime');
$routes->get('/regimes/edit/(:num)', 'RegimeController::editRegime/$1');
$routes->post('/regimes/update/(:num)', 'RegimeController::updateRegime/$1');
$routes->get('/regimes/delete/(:num)', 'RegimeController::deleteRegime/$1');
$routes->post('/regimes/achat', 'RegimeController::acheterRegime');
$routes->get('/regimes/suggestions', 'RegimeController::suggestions');
$routes->post('/regimes/suggestions', 'RegimeController::suggestions');
$routes->get('/monRegime', 'RegimeController::monRegime');
$routes->get('/monRegime/export', 'RegimeController::exportMonRegime');

// sports
$routes->get('/sports', 'Sport::index');
$routes->get('/sports/export-list', 'Sport::exportList');
$routes->get('/sports/add', 'Sport::add');
$routes->post('/sports/add', 'Sport::addSport');
$routes->get('/sports/edit/(:num)', 'Sport::edit/$1');
$routes->post('/sports/update/(:num)', 'Sport::updateSport/$1');
$routes->get('/sports/delete/(:num)', 'Sport::deleteSport/$1');

// codes de recharge
$routes->get('/codes', 'Code::index');
$routes->get('/codes/export-list', 'Code::exportList');
$routes->get('/codes/add', 'Code::add');
$routes->post('/codes/add', 'Code::addCode');
$routes->get('/codes/edit/(:num)', 'Code::edit/$1');
$routes->post('/codes/update/(:num)', 'Code::updateCode/$1');
$routes->get('/codes/delete/(:num)', 'Code::deleteCode/$1');


$routes->get('/inscription', 'Inscription::index');
$routes->post('/inscription/save','Inscription::save');
$routes->get('/objectif', 'Objectif::index');
$routes->post('/regime/save', 'Objectif::save');
$routes->get('/gold', 'Gold::index');
$routes->post('/gold/activate', 'Gold::activate');
