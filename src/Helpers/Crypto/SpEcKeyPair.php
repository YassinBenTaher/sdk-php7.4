<?php

namespace Helpers\Crypto;

class SpEcKeyPair
{
    public string $privateKey;
    public string $publicKey;

    function __construct()
    {
        $this->privateKey = "";
        $this->publicKey = "";
    }

    /**
     * @return int
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @param string $privateKey
     */
    public function setPrivateKey(string $privateKey): void
    {
        $this->privateKey = $privateKey;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey): void
    {
        $this->publicKey = $publicKey;
    }

}