<?php

namespace Components\Validator;

class Validator
{
    /**
     *
     */
    const VALIDATOR_SESSION = "VALIDATOR";
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @param ValidatorInterface $class
     * @return void
     */
    public function holder(ValidatorInterface $class): void
    {
        $holder = $class->getError();
        if ($holder !== NULL) {
            $this->errors = array_merge($this->errors, $holder);
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        unset($_SESSION[self::VALIDATOR_SESSION]);

        if (empty($this->errors)) return true;

        foreach ($this->errors as $key => $error) {
            $_SESSION[self::VALIDATOR_SESSION][$key] = $error;
        }

        return false;
    }

    /**
     * @param string $name
     * @return string
     */
    public function flashMessage(string $name): string
    {
        $errorMessage = $_SESSION[self::VALIDATOR_SESSION][$name] ?? "";
        unset($_SESSION[self::VALIDATOR_SESSION][$name]);

        return $errorMessage;
    }
}
