<?php

use Components\Request;
use Components\Template\Template;
use Components\Validator\Validator;
use Model\Domain\ProductRepositoryInterface;
use Model\Repository\ProductMysqlRepository;

class DependencyContainer
{
    /**
     * @var PDO
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
    public function database(): PDO
    {
        if(!$this->database) {
            $this->database = new PDO('mysql:host='.$this->configuration['host'].';dbname='.$this->configuration['dbname'], $this->configuration['name'], $this->configuration['password'], [\PDO::ERRMODE_EXCEPTION]);
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
     * @return Request
     */
    public function requestManager(): Request
    {
        return new Request();
    }

    /**
     * @param string $instance
     * @return ProductRepositoryInterface
     */
    public function repository(string $instance): ProductRepositoryInterface
    {
        return new $instance($this->database());
    }
}