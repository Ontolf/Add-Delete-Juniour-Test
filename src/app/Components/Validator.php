<?php

namespace Components;

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
     * @description Record the error message if it is not empty
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
     * @description Check on errors and return false if there are any
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
        $error_message = $_SESSION[self::VALIDATOR_SESSION][$name] ?? "";
        unset($_SESSION[self::VALIDATOR_SESSION][$name]);
        if ($error_message === "") {
            return "";
        }

        return $error_message;
    }
}
