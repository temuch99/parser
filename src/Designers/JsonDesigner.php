<?php

namespace App\Designers;

class JsonDesigner implements Designer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function design(array $data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
