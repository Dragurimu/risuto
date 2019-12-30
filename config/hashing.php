<?php

/*
|--------------------------------------------------------------------------
| Hashing Config
|--------------------------------------------------------------------------
|
| Kyō - A PHP Framework For Web
|
| DrakgonsCute <support@drakgons.xyz>
|
*/

/** Protección de acceso directo */
if (basename($_SERVER['PHP_SELF']) == 'hashing.php') exit;

/** Metodo para Encriptar */
function Encrypt($string)
{

    $output = false;

    $key = hash('sha256', getenv('HASH_KEY'));
    $iv = substr(hash('sha256', getenv('HASH_IV')), 0, 16);

    $output = openssl_encrypt($string, getenv('HASH_METHOD'), $key, 0, $iv);
    $output = base64_encode($output);

    return $output;
}

/** Metodo para Desencriptar */
function Decrypt($string)
{
    $output = false;

    $key = hash('sha256', getenv('HASH_KEY'));
    $iv = substr(hash('sha256', getenv('HASH_IV')), 0, 16);
    $output = openssl_decrypt(base64_decode($string), getenv('HASH_METHOD'), $key, 0, $iv);
    return $output;
}
