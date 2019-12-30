<?php

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Kyō - A PHP Framework For Web
|
| DrakgonsCute <support@drakgons.xyz>
|
*/

/** Protección de acceso directo */
if (basename($_SERVER['PHP_SELF']) == 'api.php') exit;

/** Traer la colección de un recurso */
Flight::route('GET /api/@reference', function ($reference) {
    /** Dependencias */
    require 'app/Providers/ApiResponserProvider.php';

    switch ($reference) {

        case 'songs':

            require 'app/Services/ApiContentServices.php';
            $response = songs('g_' . $reference, Flight::request()->data);

            break;

        default:

            $response = errorResponse([
                'title' => 'No encontrado',
                'detail' => 'El servidor de origen no encontró una representación actual para el recurso de destino',
                'code' => 404,
                'status' => 404,
            ]);

            break;
    }

    echo $response;
});

/** Crear recurso */
Flight::route('POST /api/@reference', function ($reference) {
    /** Dependencias */
    require 'app/Providers/ApiResponserProvider.php';

    switch ($reference) {

        case 'songs':

            require 'app/Services/ApiContentServices.php';
            $response = songs('p_' . $reference, Flight::request()->data);

            break;

        default:

            $response = errorResponse([
                'title' => 'No encontrado',
                'detail' => 'El servidor de origen no encontró una representación actual para el recurso de destino',
                'code' => 404,
                'status' => 404,
            ]);

            break;
    }

    echo $response;
});
