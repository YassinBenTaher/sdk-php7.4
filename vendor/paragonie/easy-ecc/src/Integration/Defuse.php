<?php
declare(strict_types=1);
namespace ParagonIE\EasyECC\Integration;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Encoding;
use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;
use Mdanter\Ecc\Crypto\Key\PrivateKeyInterface;
use Mdanter\Ecc\Crypto\Key\PublicKeyInterface;
use ParagonIE\ConstantTime\Base64UrlSafe;
use ParagonIE\EasyECC\EasyECC;

/**
 * Class Defuse
 * @package ParagonIE\EasyECC\Integration
 */
class Defuse
{
    /** @var EasyECC $ecc */
    protected $ecc;

    /**
     * Defuse constructor.
     * @param EasyECC $ecc
     */
    public function __construct(EasyECC $ecc)
    {
        $this->ecc = $ecc;
    }

    /**
     * @param PrivateKeyInterface $private
     * @param PublicKeyInterface $public
     * @param bool $isClient
     * @return Key
     *
     * @throws \Defuse\Crypto\Exception\BadFormatException
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     * @throws \SodiumException
     * @throws \TypeError
     */
    public function keyExchange(
        PrivateKeyInterface $private,
        PublicKeyInterface $public,
        bool $isClient
    ): Key {
        return Key::loadFromAsciiSafeString(
            Encoding::saveBytesToChecksummedAsciiSafeString(
                Key::KEY_CURRENT_VERSION,
                $this->ecc->keyExchange($private, $public, $isClient, 'sha256')
            )
        );
    }

    /**
     * @param string $message
     * @param PrivateKeyInterface $privateKey
     * @param PublicKeyInterface $publicKey
     * @return string
     *
     * @throws EnvironmentIsBrokenException
     * @throws BadFormatException
     * @throws \SodiumException
     * @throws \TypeError
     */
    public function asymmetricEncrypt(
        string $message,
        PrivateKeyInterface $privateKey,
        PublicKeyInterface $publicKey
    ): string {
        return $this->symmetricEncrypt(
            $message,
            $this->keyExchange($privateKey, $publicKey, true)
        );
    }

    /**
     * @param string $message
     * @param PrivateKeyInterface $privateKey
     * @param PublicKeyInterface $publicKey
     * @return string
     *
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     * @throws BadFormatException
     * @throws \SodiumException
     * @throws \TypeError
     */
    public function asymmetricDecrypt(
        string $message,
        PrivateKeyInterface $privateKey,
        PublicKeyInterface $publicKey
    ): string {
        return $this->symmetricDecrypt(
            $message,
            $this->keyExchange($privateKey, $publicKey, false)
        );
    }

    /**
     * @param string $message
     * @param Key $key
     * @return string
     *
     * @throws EnvironmentIsBrokenException
     */
    public function symmetricEncrypt(string $message, Key $key): string
    {
        return Base64UrlSafe::encode(
            Crypto::encrypt($message, $key, true)
        );
    }

    /**
     * @param string $message
     * @param Key $key
     * @return string
     *
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     * @throws \TypeError
     */
    public function symmetricDecrypt(string $message, Key $key): string
    {
        return Crypto::decrypt(
            Base64UrlSafe::decode($message),
            $key,
            true
        );
    }
}
