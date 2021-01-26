<?php

declare(strict_types=1);

namespace Akondas\Exspecto;

use Akondas\Exspecto\Exception\TimeoutException;

class Await
{
    private int $waitTime;
    private int $pollInterval;

    public function __construct()
    {
        $this->waitTime = Duration::seconds(10);
        $this->pollInterval = Duration::milliseconds(100);
    }

    public function atMost(int $duration, string $unit = Duration::SECONDS): self
    {
        $this->waitTime = Duration::fromUnit($duration, $unit);

        return $this;
    }

    public function pollInterval(int $duration, string $unit = Duration::MILLISECONDS): self
    {
        $this->pollInterval = Duration::fromUnit($duration, $unit);

        return $this;
    }

    /**
     * @param callable():bool $condition
     */
    public function until(callable $condition): void
    {
        $start = microtime(true);
        while (true) {
            usleep($this->pollInterval);
            if ($condition() === true) {
                break;
            }

            if (Duration::seconds(microtime(true) - $start) > $this->waitTime) {
                throw new TimeoutException('Condition was not met in the specified wait time');
            }
        }
    }
}
