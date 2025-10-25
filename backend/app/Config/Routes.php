<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;
use Config\Services;

/*
|--------------------------------------------------------------------------
| Create a new instance of our RouteCollection class.
|--------------------------------------------------------------------------
*/
$routes = Services::routes();

// Router setup (defaults)
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// --------------------------------------------------------------------
// Application Routes
// --------------------------------------------------------------------
// Rutas para el sistema de inventario de medicamentos (Inventario controller)
$routes->get('inventario', 'Inventario::index');
$routes->get('inventario/list', 'Inventario::list');
$routes->get('inventario/item/(:segment)', 'Inventario::show/$1'); // <-- nuevo: obtener 1 registro
$routes->post('inventario/create', 'Inventario::create');
$routes->post('inventario/update/(:segment)', 'Inventario::update/$1');
// El frontend usa $.post para eliminar, por eso definimos POST aquí
$routes->post('inventario/delete/(:segment)', 'Inventario::delete/$1');

// Rutas web
$routes->get('/', 'Home::index');