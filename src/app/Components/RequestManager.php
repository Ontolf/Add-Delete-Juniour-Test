<?php

namespace Components;

class RequestManager
{
    public function getPOST()
    {
        return $_POST;
    }

    public function getGET()
    {
        return $_GET;
    }
}