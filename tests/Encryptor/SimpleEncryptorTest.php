<?php

declare(strict_types=1);

namespace Sfadless\Encoder\Tests\Encryptor;

use PHPUnit\Framework\TestCase;
use Sfadless\Encoder\Encryptor\SimpleEncryptor;

/**
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class SimpleEncryptorTest extends TestCase
{
    public function testEncrypt(): void
    {
        $text = "Hello";
        $salt = "salt";

        $encryptor = new SimpleEncryptor();

        $encryptedString = $encryptor->encrypt($text, $salt);

        $this->assertEquals($text, $encryptor->decrypt($encryptedString, $salt));
    }

    public function testDecrypt(): void
    {
        $encoded = "426f666665";

        $encryptor = new SimpleEncryptor();

        $encryptor->decrypt($encoded, "salt");
    }
}