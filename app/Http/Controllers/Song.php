<?php

/** Protección de acceso directo */
if (basename($_SERVER['PHP_SELF']) == 'Song.php') exit;

function Create($data)
{
    try {

        /** id */
        $hashids = new Hashids\Hashids(getHashids(), 11);
        $id = $hashids->encode(time());

        $url = isset($data['url']) ? $data['url'] : false;
        $cover = isset($data['cover']) ? $data['cover'] : false;

        if ($url and $cover) {

            $headers = array(
                get_headers($url),
                get_headers($cover),
            );

            foreach ($headers as $v) {
                $status = substr($v[0], 9, 3);

                /** Status Headers */
                if ($status != 200) {
                    return false;
                }
            }

            $scheme = json_encode($data);
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/storage/songs/' . $id . '.ruo', $scheme);

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/storage/songs/' . $id . '.ruo')) {
                return $id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (\Exception $exp) {
        return false;
    }
}

function Read()
{
    try {

        $storage = $_SERVER['DOCUMENT_ROOT'] . '/storage/songs/';

        /** Songs */
        $songs = array();

        foreach (scandir($storage) as $file) {
            if ('.' === $file) {
                continue;
            };
            if ('..' === $file) {
                continue;
            };

            $songs[] = $file;
        }

        /** Return */
        $scheme = array();

        foreach ($songs as $v) {
            $target = $_SERVER['DOCUMENT_ROOT'] . '/storage/songs/' . $v;

            if (file_exists($target)) {
                if (is_writable($target)) {
                    $details = file_get_contents($target);
                    $scheme[] = json_decode($details);
                }
            }
        }

        return $scheme;
    } catch (\Exception $exp) {
        return false;
    }
}


/** Generics */
function getHashids()
{
    $microtime = floatval(substr((string) microtime(), 1, 8));
    $rounded = round($microtime, 3);

    return date('Y-m-d H:i:s') . substr((string) $rounded, 1, strlen($rounded));
}
