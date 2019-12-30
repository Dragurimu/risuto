<?php

/*
|--------------------------------------------------------------------------
| Index
|--------------------------------------------------------------------------
|
| Kyō - A PHP Framework For Web
|
| DrakgonsCute <support@drakgons.xyz>
|
*/

require 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

/* Configuración de las Rutas */
Flight::set('flight.log_errors', false);
Flight::set('flight.handle_errors', false);
Flight::set('flight.views.path', 'resources/views');

/** Configuraciones */

require 'config/app.php';

/* Rutas */
require 'routes/web.php';
require 'routes/api.php';


Flight::start();
