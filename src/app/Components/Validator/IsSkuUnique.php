<?php

namespace Components\Validator;

class IsSkuUnique implements ValidatorInterface
{
    /**
     * @var string
     */
    private $sku;
    /**
     * @var string
     */
    private $skuValue;
    /**
     * @var string
     */
    private $message;
    /**
     * @var array
     */
    private $error;
    /**
     * @var ValidateSku
     */
    private $checkUniqueSku;

    /**
     * @param string $sku
     * @param string $message
     * @param string $skuValue
     * @param ValidateSku $checkUniqueSku
     */
    public function __construct(
        string $sku,
        string $message,
        string $skuValue,
        ValidateSku $checkUniqueSku
    ) {
        $this->sku = $sku;
        $this->message = $message;
        $this->skuValue = $skuValue;
        $this->checkUniqueSku = $checkUniqueSku;

        $this->checkUniqueness();
    }

    /**
     * @return void
     */
    private function checkUniqueness(): void
    {
        if ($this->checkUniqueSku->isSkuUnique($this->skuValue)) {
            $this->error[$this->sku] = $this->message;
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