<?php

/*
|--------------------------------------------------------------------------
| Api Content Services
|--------------------------------------------------------------------------
|
| Kyō - A PHP Framework For Web
|
| DrakgonsCute <support@drakgons.xyz>
|
*/

/** Protección de acceso directo */
if (basename($_SERVER['PHP_SELF']) == 'ApiContentServices.php') exit;

function songs($resource, $data)
{
    /** Dependencias */
    require 'config/hashing.php';

    /** JWT */
    $jwt = isset($_SERVER['HTTP_X_DRAGURIMU']) ? $_SERVER['HTTP_X_DRAGURIMU'] : false;

    switch ($resource) {

        case 'g_songs':

            require 'app/Http/Controllers/Song.php';

            $request = Read();


            if ($request) {

                $response = successResponse($request, [
                    'title' => 'OK',
                    'detail' => 'The request has succeeded.',
                    'status' => 200
                ]);
            } else {
                $response = errorResponse([
                    'title' => 'Bad Request',
                    'detail' => 'The server cannot or will not process the request due to something that is perceived to be a client error.',
                    'code' => 400,
                    'status' => 400,
                ]);
            }

            break;

        case 'p_songs':

            /** Ignore */
            $ignore = array('locale', 'version', 'connectivity_type');
            $query = array();

            foreach ($data as $k => $v) {

                if (!in_array($k, $ignore)) {
                    if ($v != '') {
                        $query[$k] = $v;
                    } else {
                        $response = errorResponse([
                            'title' => 'Bad Request',
                            'detail' => 'The server cannot or will not process the request due to something that is perceived to be a client error.',
                            'code' => 400,
                            'status' => 400,
                        ]);

                        return $response;
                    }
                }
            }

            try {

                $decode = Firebase\JWT\JWT::decode($jwt, 'Risuto', array('HS256'));
                $extensions = $decode->extensions;

                if (in_array($resource, $extensions->method)) {

                    require 'app/Http/Controllers/Song.php';

                    $request = Create($query);

                    if ($request) {

                        $response = successResponse($request, [
                            'title' => 'Created',
                            'detail' => 'The request has been fulfilled and has resulted in one or more new resources being created.',
                            'status' => 201
                        ]);
                    } else {
                        $response = errorResponse([
                            'title' => 'Bad Request',
                            'detail' => 'The server cannot or will not process the request due to something that is perceived to be a client error.',
                            'code' => 400,
                            'status' => 400,
                        ]);
                    }
                } else {
                    $response = errorResponse([
                        'title' => 'Unauthorized',
                        'detail' => 'The request has not been applied because it lacks valid authentication credentials for the target resource.',
                        'code' => 401,
                        'status' => 401,
                    ]);
                }
            } catch (\Exception $exp) {
                $response = errorResponse([
                    'title' => 'Unauthorized',
                    'detail' => 'The request has not been applied because it lacks valid authentication credentials for the target resource.',
                    'code' => 401,
                    'status' => 401,
                ]);
            }

            break;

        default:
            $response = errorResponse([
                'title' => 'Not Found',
                'detail' => 'The origin server did not find a current representation for the target resource or is not willing to disclose that one exists.',
                'code' => 404,
                'status' => 404,
            ]);
            break;
    }

    return $response;
}
