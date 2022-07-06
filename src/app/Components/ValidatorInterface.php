<?php

namespace Components;

interface ValidatorInterface
{
    /**
     * @return array|null
     */
    public function getError(): ?array;
}