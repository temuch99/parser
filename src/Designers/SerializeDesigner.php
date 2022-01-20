<?php

namespace App\Designers;

class SerializeDesigner implements Designer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function design(array $data)
    {
        return serialize($data);
    }
}
