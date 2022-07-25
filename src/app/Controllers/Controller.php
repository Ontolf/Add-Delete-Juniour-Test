<?php

namespace Controllers;

use DependencyContainer;

abstract class Controller
{
    /**
     * @var array|null
     */
    protected $data;
    /**
     * @var DependencyContainer
     */
    protected $app;

    /**
     * @param DependencyContainer $app
     * @param array|null $data
     */
    public function __construct(DependencyContainer $app, array $data = null)
    {
        $this->data = $data;
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public abstract function execute();
}