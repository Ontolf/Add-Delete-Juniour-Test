<?php

use Controllers\Template;
use Components\{Validator, RequestManager};

class DependencyContainer
{
    /**
     * @var
     */
    private $database;
    /**
     * @var array
     */
    private $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function database(): \PDO
    {
        if(!$this->database) {
            $this->database = new \PDO('mysql:host='.$this->configuration['host'].';dbname='.$this->configuration['dbname'], $this->configuration['name'], $this->configuration['password'], [\PDO::ERRMODE_EXCEPTION]);
        }

        return $this->database;
    }

    /**
     * @return Validator
     */
    public function validator(): Validator
    {
        return new Validator();
    }

    /**
     * @param string $path
     * @param array $data
     * @return Template
     */
    public function template(string $path, array $data): Template
    {
        return new Template($path, $data);
    }

    /**
     * @return RequestManager
     */
    public function requestManager(): RequestManager
    {
        return new RequestManager();
    }
}