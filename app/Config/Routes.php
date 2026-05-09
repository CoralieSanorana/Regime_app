<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inscription', 'Inscription::index');
$routes->post('/inscription/save','Inscription::save');
$routes->get('/main', 'Home::main');
$routes->get('/objectif', 'Objectif::index');
