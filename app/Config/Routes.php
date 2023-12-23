<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// LOGIN ADMIN
$routes->get('/login', 'AuthController::index');
$routes->post('/auth-login', 'AuthController::login');

// PAGE ADMIN
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/logout/(:any)', 'AuthController::logout/$1');
    $routes->get('/dashboard', 'Admin\DashboardController::index');

    // EMPLOYEES
    $routes->get('/employee', 'Admin\EmployeeController::index');
    $routes->post('/add-employee', 'Admin\EmployeeController::store');
    $routes->get('/employee/edit/(:any)', 'Admin\EmployeeController::edit/$1');
    $routes->post('/employee/update/(:any)', 'Admin\EmployeeController::update/$1');
    $routes->get('/employee/delete/(:any)', 'Admin\EmployeeController::delete/$1');

    // RULES
    $routes->get('/rules', 'Admin\RulesController::index');
    $routes->post('/add-rules', 'Admin\RulesController::store');
    $routes->get('/rules/edit/(:any)', 'Admin\RulesController::edit/$1');
    $routes->post('/rules/update/(:any)', 'Admin\RulesController::update/$1');
    $routes->get('/rules/delete/(:any)', 'Admin\RulesController::delete/$1');

    // RECAP PRESENCE
    $routes->get('/recap-presences', 'Admin\RecapPresence::index');
    $routes->post('/recap-presences-by-month', 'Admin\RecapPresence::downloadByMonth');
    
    // RECAP SALARY
    $routes->get('/recap-salary', 'Admin\RecapSalary::index');
    $routes->post('/recap-salary-by-month', 'Admin\RecapSalary::downloadByMonth');
});

// PRESENCES
$routes->get('/', 'PresenceController::index');
$routes->post('/add-presences', 'PresenceController::store');