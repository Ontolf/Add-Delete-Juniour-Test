<?php

namespace Components;

class Request
{
    /**
     * @return array
     */
    public function getPOST(): array
    {
        return $_POST;
    }

    /**
     * @return array
     */
    public function getGET(): array
    {
        return $_GET;
    }
}