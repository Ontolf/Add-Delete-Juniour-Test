<?php

namespace Components;

interface ValidateSkuInterface
{
    /**
     * @param string $sku
     * @return bool
     */
    public function isSkuUnique(string $sku): bool;
}
