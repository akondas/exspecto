<?php

declare(strict_types=1);

namespace Akondas\Exspecto;

class Duration
{
    public const SECONDS = 'seconds';
    public const MILLISECONDS = 'milliseconds';

    /**
     * @param int|float $seconds
     */
    public static function seconds($seconds): int
    {
        return (int) ($seconds * 1_000_000);
    }

    /**
     * @param int|float $milliseconds
     */
    public static function milliseconds($milliseconds): int
    {
        return (int) ($milliseconds * 1_000);
    }

    /**
     * @param int|float $duration
     */
    public static function fromUnit($duration, string $unit): int
    {
        if (!method_exists(self::class, $unit)) {
            throw new \InvalidArgumentException('Unknown unit');
        }

        return self::{$unit}($duration);
    }
}
