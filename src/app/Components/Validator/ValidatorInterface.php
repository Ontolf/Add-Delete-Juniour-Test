<?php

namespace Components\Validator;

interface ValidatorInterface
{
    /**
     * @return array|null
     */
    public function getError(): ?array;
}