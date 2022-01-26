<?php

namespace Helpers\Crypto;

use ParagonIE\EasyECC\ECDSA\{PublicKey, SecretKey};
use EllipticCurve\PrivateKey;

class SpCrypto
{
    /**
     * @throws \ParagonIE\EasyECC\Exception\NotImplementedException
     * @throws \SodiumException
     */
    function GenerateKeyPair(): SpEcKeyPair {
        $model = new SpEcKeyPair();
        $prKey = new PrivateKey("secp256k1");
        $pbKey = $prKey->publicKey();
        $model->setPrivateKey($prKey->toPem());
        $model->setPublicKey($pbKey->toPem());
        return $model;
    }

}