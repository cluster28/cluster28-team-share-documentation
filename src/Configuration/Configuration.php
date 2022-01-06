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

    public function __construct(array $config = [])
    {
        if (isset($config['paths'])) {
            $this->paths = is_string($config['paths']) ? [$config['paths']] : $config['paths'];
        }

        if (isset($config['excluded_paths'])) {
            $this->paths = is_string($config['excluded_paths']) ? [$config['excluded_paths']] : $config['excluded_paths'];
        }

        $this->startDate = new DateTime();
        if (isset($config['intervalSpec'])) {
            $this->startDate->sub(new DateInterval($config['intervalSpec']));
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
