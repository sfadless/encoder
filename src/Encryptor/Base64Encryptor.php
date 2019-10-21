<?php

declare(strict_types=1);

namespace Sfadless\Encoder\Encryptor;

/**
 * Base64Encryptor
 *
 * Алгоритм взят отсюда https://habr.com/sandbox/92985/
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
class Base64Encryptor implements EncryptorInterface
{
    /**
     * @inheritDoc
     */
    public function encrypt(string $value, string $key): string
    {
        $string = base64_encode($value);

        $arr = [];
        $x = 0;

        $decoded = '';

        while ($x++ < strlen($string)) {
            $arr[$x-1] = md5(md5($key . $string[$x-1]) . $key);
            $decoded = $decoded . $arr[$x-1][3] . $arr[$x-1][6] . $arr[$x-1][1] . $arr[$x-1][2];
        }

        return $decoded;
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $encrypted, string $key): string
    {
        $symbols = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";

        $x = 0;

        while ($x++ < strlen($symbols)) {
            $tmp = md5(md5($key . $symbols[$x-1]).$key);
            $encrypted = str_replace($tmp[3] . $tmp[6] . $tmp[1] . $tmp[2], $symbols[$x-1], $encrypted);
        }

        return base64_decode($encrypted);
    }
}
