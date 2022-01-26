<?php

namespace Payment\Models\Payment\Domestic;

class SpCreateDomesticPaymentResponse
{
    public array $payment;
    public string $signature;

    /**
     * @param array $payment
     * @param string $signature
     */
    public function __construct(array $payment, string $signature)
    {
        $this->payment = $payment;
        $this->signature = $signature;
    }

    /**
     * @return array
     */
    public function getPayment(): array
    {
        return $this->payment;
    }

    /**
     * @param array $payment
     */
    public function setPayment(array $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     */
    public function setSignature(string $signature): void
    {
        $this->signature = $signature;
    }

}