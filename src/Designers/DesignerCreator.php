<?php

namespace App\Designers;

use App\Exceptions\WrongFormatException;

class DesignerCreator
{
    /**
     * @param string $format
     *
     * @return Designer
     */
    public static function create(string $format)
    {
        if ($format === 'json') {
            return new JsonDesigner();
        } elseif ($format === 'ser') {
            return new SerializeDesigner();
        } else {
            throw new WrongFormatException();
        }
    }
}
