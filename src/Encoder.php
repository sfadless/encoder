<?php

declare(strict_types=1);

namespace Sfadless\Encoder;

use Sfadless\Encoder\Encryptor\EncryptorInterface;

/**
 * Encoder
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class Encoder implements EncoderInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * Encoder constructor.
     * @param EncryptorInterface $encryptor
     * @param string $key
     */
    public function __construct(EncryptorInterface $encryptor, string $key)
    {
        $this->key = $key;
        $this->encryptor = $encryptor;
    }

    /**
     * @param string $value
     * @return string
     */
    public function encode(string $value): string
    {
        return $this->encryptor->encrypt($value, $this->key);
    }

    /**
     * @param string $encoded
     * @return string
     */
    public function decode(string $encoded): string
    {
        return $this->encryptor->decrypt($encoded, $this->key);
    }
}
