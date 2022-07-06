<?php

namespace Components;

class IsNumeric implements ValidatorInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $message;
    /**
     * @var
     */
    private $error;

    /**
     * @var array
     */
    private $data;


    /**
     * @param string $name
     * @param string $message
     * @param array $data
     */
    public function __construct(string $name, string $message, array $data)
    {
        $this->name = $name;
        $this->message = $message;
        $this->data = $data;

        $this->checkIsNumeric();
    }


    /**
     * @return void
     */
    private function checkIsNumeric(): void
    {
        if (!is_numeric($this->data[$this->name]) && !($this->data[$this->name] === "")) {
            $this->error[$this->name] = $this->message;
        }
    }


    /**
     * @return array|null
     */
    public function getError(): ?array
    {
        return $this->error;
    }
}