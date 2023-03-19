<?php

declare(strict_types=1);

namespace Sfadless\Encoder\Encryptor;

/**
 * @author Pavel Golikov <pavel@golikov.tech>
 */
interface EncryptorInterface
{
    public function encrypt(string $value, string $key): string;

    public function decrypt(string $encrypted, string $key): string;
}
