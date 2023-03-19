<?php

declare(strict_types=1);

namespace Sfadless\Encoder\Encryptor;

/**
 * Алгоритм взят отсюда https://stackoverflow.com/questions/18279141/javascript-string-encryption-and-decryption
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class SimpleEncryptor implements EncryptorInterface
{
    public function encrypt(string $value, string $key): string
    {
        $textToChars = $this->textToChars($value);

        $f = array_map(
            function ($char) use ($key) {
                return $this->byteHex((int) $this->applySaltToChar($key, (string) $char));
            }, $textToChars
        );

        return implode("", $f);
    }

    public function decrypt(string $encrypted, string $key): string
    {
        $regExp = "/.{1,2}/";

        preg_match_all($regExp, $encrypted, $matches);

        $result = array_map(
            fn(string $value) => chr((int) $value),
            array_map(
                fn(int $value) => $this->applySaltToChar($key, (string) $value),
                array_map(
                    fn(string $value) => intval($value, 16),
                    $matches[0]
                )
            )
        );

        return implode("", $result);
    }

    private function textToChars(string $text): array
    {
        return array_map(fn(string $char) => ord($char), str_split($text));
    }

    private function byteHex(int $char): string
    {
        return substr("0" . base_convert((string) $char, 10, 16), -2);
    }

    private function applySaltToChar(string $salt, string $char): string
    {
        return (string) array_reduce($this->textToChars($salt), function ($a, $b) {
            return $a ^ $b;
        }, $char);
    }
}