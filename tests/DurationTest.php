<?php

declare(strict_types=1);

namespace Akondas\Exspecto\Tests;

use Akondas\Exspecto\Duration;
use PHPUnit\Framework\TestCase;

class DurationTest extends TestCase
{
    /**
     * @param int|float $duration
     *
     * @dataProvider durationsProvider
     */
    public function testFromUnit($duration, string $unit, int $expected): void
    {
        self::assertEquals($expected, Duration::fromUnit($duration, $unit));
    }

    /**
     * @return array<mixed>
     */
    public function durationsProvider(): array
    {
        return [
            [1, Duration::SECONDS, 1_000_000],
            [1.01, Duration::SECONDS, 1_010_000],
            [1.000001, Duration::SECONDS, 1_000_000],
            [0.1, Duration::SECONDS, 100_000],
            [2, Duration::SECONDS, 2_000_000],
            [1, Duration::MILLISECONDS, 1_000],
            [2, Duration::MILLISECONDS, 2_000],
        ];
    }

    public function testExceptionWhenUnknownUnit(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Duration::fromUnit(1, 'unknown');
    }
}
