<?php

declare(strict_types=1);

namespace Sfadless\Encoder;

use Sfadless\Encoder\Encryptor\EncryptorInterface;

/**
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class Encoder implements EncoderInterface
{
    private string $key;

    private EncryptorInterface $encryptor;

    public function __construct(EncryptorInterface $encryptor, string $key)
    {
        $this->key = $key;
        $this->encryptor = $encryptor;
    }

    public function encode(string $value): string
    {
        return $this->encryptor->encrypt($value, $this->key);
    }

    public function decode(string $encoded): string
    {
        return $this->encryptor->decrypt($encoded, $this->key);
    }
}
