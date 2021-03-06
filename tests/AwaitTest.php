<?php

declare(strict_types=1);

namespace Akondas\Exspecto\Tests;

use function Akondas\Exspecto\await;
use Akondas\Exspecto\Duration;
use Akondas\Exspecto\Exception\TimeoutException;
use PHPUnit\Framework\TestCase;

class AwaitTest extends TestCase
{
    public function testAwaitWithSuccess(): void
    {
        $iterations = 5;
        $start = microtime(true);

        await()->atMost(1)->pollInterval(10)->until(function () use (&$iterations): bool {
            --$iterations;

            return $iterations === 0;
        });

        $duration = Duration::seconds(microtime(true) - $start);

        self::assertEquals(0, $iterations);
        self::assertGreaterThanOrEqual(Duration::milliseconds(50), $duration);
        self::assertLessThanOrEqual(Duration::milliseconds(60), $duration);
    }

    public function testAwaitTimeout(): void
    {
        $this->expectException(TimeoutException::class);

        await()->atMost(100, Duration::MILLISECONDS)->pollInterval(30)->until(function (): bool {
            return false;
        });
    }
}
