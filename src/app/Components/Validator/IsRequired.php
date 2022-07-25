<?php

namespace Components\Validator;

class IsRequired implements ValidatorInterface
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
     * @var array
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

        $this->checkIsRequired();
    }

    /**
     * @return void
     */
    private function checkIsRequired(): void
    {
        if ($this->data[$this->name] === "") {
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