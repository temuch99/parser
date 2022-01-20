<?php

namespace App\Designers;

interface Designer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function design(array $data);
}
