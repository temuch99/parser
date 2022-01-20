<?php

namespace App\Loaders;

use App\Exceptions\FileNotExistsException;
use App\Exceptions\FileOpenException;

class FileLoader extends AbstractLoader
{
    /**
     * {@inheritable}
     */
    public function load()
    {
        if (!file_exists($this->address) || is_dir($this->address)) {
            throw new FileNotExistsException();
        }

        $handle = fopen($this->address, 'r');

        if (!$handle) {
            throw new FileOpenException();
        }

        return $handle;
    }
}
