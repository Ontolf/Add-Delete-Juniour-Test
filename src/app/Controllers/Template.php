<?php

namespace Controllers;

class Template
{
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
     */
    public function render()
    {
        if ($this->path !== "") {
            $path = '../app/'.$this->path;
            if (file_exists($path)) {
                ob_start();
                require_once('../app/'.$path);
                return ob_get_clean();
            }
        }
        return "";
    }
}