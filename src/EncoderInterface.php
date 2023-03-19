<?php

declare(strict_types=1);

namespace Sfadless\Encoder;

/**
 * @author Pavel Golikov <pavel@golikov.tech>
 */
interface EncoderInterface
{
    public function encode(string $value) : string;

    public function decode(string $encoded) : string;
}
