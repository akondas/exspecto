<?php

declare(strict_types=1);

namespace Akondas\Exspecto;

final class Duration
{
    public const SECONDS = 'seconds';
    public const MILLISECONDS = 'milliseconds';

    public static function seconds(int|float $seconds): int
    {
        return (int) ($seconds * 1_000_000);
    }

    public static function milliseconds(int|float $milliseconds): int
    {
        return (int) ($milliseconds * 1_000);
    }

    public static function fromUnit(int|float $duration, string $unit): int
    {
        return match ($unit) {
            'seconds' => self::seconds($duration),
            'milliseconds' => self::milliseconds($duration),
            default => throw new \InvalidArgumentException('Unknown unit'),
        };
    }
}
