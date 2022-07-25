<?php

namespace Components\Template;

use Exception;

class Template
{
    /**
     *
     */
    const ROOT = '../app/';
    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $data;

    /**
     * @param string $path
     * @param array $data
     */
    public function __construct(string $path, array $data)
    {
        $this->path = $path;
        $this->data = $data;
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function render()
    {
        if ($this->path === "") {
            throw new Exception("Template is not existing!");
        }

        $path = self::ROOT.$this->path;
        if (file_exists($path)) {
            ob_start();
            require_once($path);
            return ob_get_clean();
        }

        return "";
    }
}