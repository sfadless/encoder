<?php

declare(strict_types=1);

namespace Sfadless\Encoder;

/**
 * EncoderInterface
 *
 * @author Pavel Golikov <pavel@golikov.tech>
 */
interface EncoderInterface
{
    /**
     * @param $value
     * @return string
     */
    public function encode(string $value) : string;

    /**
     * @param $encoded
     * @return string
     */
    public function decode(string $encoded) : string;
}
