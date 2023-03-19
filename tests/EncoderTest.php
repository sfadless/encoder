<?php

declare(strict_types=1);

namespace Sfadless\Encoder\Tests;

use PHPUnit\Framework\TestCase;
use Sfadless\Encoder\Encryptor\Base64Encryptor;
use Sfadless\Encoder\Encryptor\EncryptorInterface;

/**
 * @author Pavel Golikov <pavel@golikov.tech>
 */
final class EncoderTest extends TestCase
{
    protected EncryptorInterface $encryptor;

    public function setUp(): void
    {
        $this->encryptor = new Base64Encryptor();
    }

    public function testEncodedWithSameKeyMustBeSame()
    {
        $key = '123qweASD!!!';
        $value = 'Some value that should be encrypted and then decrypted';

        $encrypted = $this->encryptor->encrypt($value, $key);
        $decrypted = $this->encryptor->decrypt($encrypted, $key);

        $this->assertEquals(
            $value,
            $decrypted,
            sprintf("Value `%s` and decrypted value `%s` are not the same", $value, $decrypted)
        );
    }

    public function testEncodedWithDifferentKeyNotTheSame(): void
    {
        $key1 = '123qweASD!!!';
        $key2 = '123qweASD!!!+';
        $value = 'Some value that should be encrypted and then decrypted';

        $encrypted = $this->encryptor->encrypt($value, $key1);
        $decrypted = $this->encryptor->decrypt($encrypted, $key2);

        $this->assertNotEquals($value, $decrypted);
    }

    public function testDecodeWithBigKey(): void
    {
        $value = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

        $key = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Velit laoreet id donec ultrices tincidunt arcu non sodales. Vulputate dignissim suspendisse in est ante in. Et netus et malesuada fames. Ut pharetra sit amet aliquam id. Ac felis donec et odio pellentesque diam. Scelerisque viverra mauris in aliquam sem fringilla. Aliquam etiam erat velit scelerisque in. Viverra nam libero justo laoreet. At augue eget arcu dictum. Sodales neque sodales ut etiam sit. Rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Egestas sed sed risus pretium quam vulputate. Non blandit massa enim nec dui nunc mattis enim. Posuere ac ut consequat semper viverra nam libero justo laoreet. Augue interdum velit euismod in pellentesque massa placerat duis.";

        $encrypted = $this->encryptor->encrypt($value, $key);
        $decrypted = $this->encryptor->decrypt($encrypted, $key);

        $this->assertEquals(
            $value,
            $decrypted,
            sprintf("Value and decrypted value with large data are not the same")
        );
    }
}
