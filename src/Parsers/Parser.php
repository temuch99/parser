<?php

namespace App\Parsers;

interface Parser
{
    /**
     * @param resource $handle
     *
     * @return array
     */
    public function parse($handle);
}
