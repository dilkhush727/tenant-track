<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Guest-access routes (only for unauthenticated users)
$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
});
$routes->get('verify-email/(:segment)', 'Auth::verifyEmail/$1');

// Authenticated users – common routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('logout', 'Auth::logout');
    $routes->get('dashboard', 'Dashboard::index');
});

// Tenant-specific routes
$routes->group('tenant', ['filter' => 'tenant'], function($routes) {
    $routes->get('', 'Tenant\Main::index');
    // Example: $routes->get('leases', 'Tenant\LeaseController::index');
    // Add other tenant-specific routes here
    $routes->get('maintenance', 'Tenant\MaintenanceController::index');
    $routes->get('maintenance/create', 'Tenant\MaintenanceController::create');
    $routes->post('maintenance/store', 'Tenant\MaintenanceController::store');

    $routes->get('payments', 'Tenant\PaymentController::index');

    $routes->get('profile', 'Tenant\ProfileController::index');
    $routes->post('profile/update', 'Tenant\ProfileController::update');

    $routes->get('maintenance/view/(:num)', 'Tenant\MaintenanceController::view/$1');

    $routes->get('maintenance/feedback/(:num)', 'Tenant\MaintenanceController::feedback/$1');
    $routes->post('maintenance/feedback/(:num)', 'Tenant\MaintenanceController::submitFeedback/$1');

    $routes->get('leases', 'Tenant\LeaseController::index');

});

// Landlord-specific routes
$routes->group('landlord', ['filter' => 'landlord'], function($routes) {
    $routes->get('', 'Landlord\Main::index');
    // Example: $routes->get('properties', 'Landlord\PropertyController::index');
    // Add other landlord-specific routes here
    $routes->get('properties', 'Landlord\PropertyController::index');
    $routes->get('properties/create', 'Landlord\PropertyController::create');
    $routes->post('properties/store', 'Landlord\PropertyController::store');
    $routes->get('properties/edit/(:num)', 'Landlord\PropertyController::edit/$1');
    $routes->post('properties/update/(:num)', 'Landlord\PropertyController::update/$1');
    $routes->post('properties/delete/(:num)', 'Landlord\PropertyController::delete/$1');

    $routes->get('leases', 'Landlord\LeaseController::index');
    $routes->get('leases/create', 'Landlord\LeaseController::create');
    $routes->post('leases/store', 'Landlord\LeaseController::store');
    $routes->get('leases/edit/(:num)', 'Landlord\LeaseController::edit/$1');
    $routes->post('leases/update/(:num)', 'Landlord\LeaseController::update/$1');

    $routes->get('payments', 'Landlord\PaymentController::index');
    $routes->get('payments/create', 'Landlord\PaymentController::create');
    $routes->post('payments/store', 'Landlord\PaymentController::store');
    $routes->get('payments/edit/(:num)', 'Landlord\PaymentController::edit/$1');
    $routes->post('payments/update/(:num)', 'Landlord\PaymentController::update/$1');

    $routes->get('maintenance', 'Landlord\MaintenanceController::index');
    $routes->post('maintenance/update-status/(:num)', 'Landlord\MaintenanceController::updateStatus/$1');
    $routes->get('maintenance/view/(:num)', 'Landlord\MaintenanceController::view/$1');

    $routes->get('reports', 'Landlord\ReportController::index');

    $routes->get('profile', 'Landlord\ProfileController::edit');
    $routes->post('profile', 'Landlord\ProfileController::update');
});

// Admin-specific routes
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('', 'Admin\Main::index');

    // Admin user management (URL: /admin/users)
    $routes->get('users', 'Admin\UserController::index');
    $routes->post('users/elevate/(:num)', 'Admin\UserController::elevate/$1');
    $routes->post('users/demote/(:num)', 'Admin\UserController::demote/$1');
    $routes->post('users/toggle-status/(:num)', 'Admin\UserController::toggleStatus/$1');

    $routes->get('reports', 'Admin\ReportController::index');
    $routes->get('reports/export/leases', 'Admin\ReportController::exportLeasesCSV');
    $routes->get('reports/export/payments', 'Admin\ReportController::exportPaymentsCSV');
    $routes->get('reports/export/maintenance', 'Admin\ReportController::exportMaintenanceCSV');

    $routes->get('announcements', 'Admin\AnnouncementController::index');
    $routes->get('announcements/create', 'Admin\AnnouncementController::create');
    $routes->post('announcements/store', 'Admin\AnnouncementController::store');
});


$routes->group('messages', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'MessagesController::index');
    $routes->get('index/(:num)', 'MessagesController::index/$1');
    $routes->post('send', 'MessagesController::send');
    $routes->get('thread/(:num)', 'MessagesController::thread/$1');
});
