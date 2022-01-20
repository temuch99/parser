<?php

namespace App\Loaders;

use App\Exceptions\WrongNameFormatException;
use App\Utils\RegularExpressions;

class LoaderCreator
{
    /**
     * @param string $name
     *
     * @return AbstractLoader
     */
    public static function create(string $name)
    {
        if (preg_match(RegularExpressions::http(), $name)) {
            return new HttpLoader($name);
        } elseif (preg_match(RegularExpressions::filePath(), $name)) {
            return new FileLoader($name);
        } else {
            throw new WrongNameFormatException();
        }
    }
}
