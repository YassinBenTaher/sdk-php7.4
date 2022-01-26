<?php


namespace Payment\Models\Payment\Domestic;



class SpDomesticPayment
{
    public  float $amount;
    public  string $description;

    function __construct(float $amount, string $description)
    {
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}