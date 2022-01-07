<?php

namespace Cluster28\TeamShareDocumentation\Configuration;

use DateInterval;
use DateTime;
use DateTimeInterface;

class Configuration
{
    private array $paths = [];
    private array $excludedPaths = [];
    private DateTimeInterface $startDate;

    public function __construct(array $options = [])
    {
        if (isset($options['paths'])) {
            $this->paths = is_string($options['paths']) ? [$options['paths']] : $options['paths'];
        }

        if (isset($options['excluded_paths'])) {
            $this->paths = is_string($options['excluded_paths']) ? [$options['excluded_paths']] : $options['excluded_paths'];
        }

        $this->startDate = new DateTime();
        if (isset($options['interval_spec'])) {
            $this->startDate->sub(new DateInterval($options['interval_spec']));
        } else {
            $this->startDate->sub(new DateInterval('P1M'));
        }
    }

    public function getPaths(): array
    {
        return $this->paths;
    }

    public function getExcludedPaths(): array
    {
        return $this->excludedPaths;
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }
}
