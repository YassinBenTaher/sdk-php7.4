<?php

namespace Helpers\Security\DigitalSignature;

use EllipticCurve\Signature;
use EllipticCurve\Ecdsa;
use EllipticCurve\PrivateKey;
use EllipticCurve\PublicKey;

class EccSignatureManager
{
    function Sign(string $data, string $privateKey): string
    {
        $ecc = new Ecdsa();
        $key = new PrivateKey();
        $PrivateKey = $key::fromPem($privateKey);
        $signature = $ecc::sign($data, $PrivateKey);
        return $signature->toBase64();
    }

    function Verify(string $data, string $signature, $publicKey): bool {
        $ecc = new Ecdsa();
        $key = new PublicKey($publicKey);
        $PublicKey = $key::fromPem($publicKey);
        return $ecc::verify($data, new Signature(base64_decode($signature)), $PublicKey);
    }
}