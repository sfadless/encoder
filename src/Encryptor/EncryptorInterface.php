<?php

declare(strict_types=1);

namespace Sfadless\Encoder\Encryptor;

/**
 * EncryptorInterface
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
interface EncryptorInterface
{
    /**
     * @param $value string
     * @param $key string
     * @return string
     */
    public function encrypt(string $value, string $key) : string;

    /**
     * @param $encrypted
     * @param $key
     * @return string
     */
    public function decrypt(string $encrypted, string $key) : string;
}
