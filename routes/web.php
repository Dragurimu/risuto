<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Kyō - A PHP Framework For Web
|
| DrakgonsCute <support@drakgons.xyz>
|
*/

/** Protección de acceso directo */
if (basename($_SERVER['PHP_SELF']) == 'web.php') exit;

/** Home */
Flight::route('GET /', function () {

    Flight::render('home.tpl', array(
        'title' => getenv('APP_NAME', ''),
        'description' => 'Sistema creado por Dragurimu'
    ));
});

/** Songs */
Flight::route('GET /songs', function () {

    Flight::render('songs.tpl', array(
        'title' => getenv('APP_NAME', ''),
        'description' => 'Sistema creado por Dragurimu'
    ));
});

/** Not Found */
Flight::map('notFound', function () {
    /** Mostrar */
    Flight::render(
        'errors/generic.tpl',
        array(
            'title' => 'Pagina no encontrada',
            'description' => 'La pagina que ha solicitado no existe, disculpa las molestias'
        )
    );
});
