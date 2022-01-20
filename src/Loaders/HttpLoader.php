<?php

namespace App\Loaders;

use App\Exceptions\FileOpenException;
use App\Exceptions\UrlNotExistsException;

class HttpLoader extends AbstractLoader
{
    /**
     * {@inheritable}
     */
    public function load()
    {
        $ch     = curl_init();
        $handle = fopen('tmp/file.txt', 'w');

        curl_setopt($ch, CURLOPT_URL, $this->address);
        curl_setopt($ch, CURLOPT_FILE, $handle);
        curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
            throw new UrlNotExistsException();
        }

        curl_close($ch);
        fclose($handle);

        $handle = fopen('tmp/file.txt', 'r');

        if (!$handle) {
            throw new FileOpenException();
        }

        return $handle;
    }
}
