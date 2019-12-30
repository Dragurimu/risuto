<?php

/*
|--------------------------------------------------------------------------
| App Config
|--------------------------------------------------------------------------
|
| Kyō - A PHP Framework For Web
|
| DrakgonsCute <support@drakgons.xyz>
|
*/

/** Protección de acceso directo */
if (basename($_SERVER['PHP_SELF']) == 'app.php') exit;

/** Iniciar sesiones */
session_start();

/** Crear JWT */
function jwt_logged($opts)
{
    /** JWT */
    $unix = time();
    $password = 'Risuto';

    /** Contenido */
    $payload = array(
        'iat' => $unix,
        'exp' => $unix + (60 * 60),
        'data' => [
            'id' => 1,
            'user' => 'Risuto'
        ],
        'extensions' => $opts
    );

    /** Return */
    return Firebase\JWT\JWT::encode($payload, $password, 'HS256');
}
