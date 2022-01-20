<?php

namespace App\Parsers;

use App\Exceptions\WrongTypeException;
use App\Utils\RegularExpressions;

class ParserCreator
{
    /**
     * @param string $type
     *
     * @return Parser
     */
    public static function create(string $type)
    {
        if ($type === 'access') {
            return new AccessLogParser();
        } else {
            throw new WrongTypeException();
        }
    }
}
