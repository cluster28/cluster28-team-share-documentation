<?php

namespace Cluster28\TeamShareDocumentation\Configuration;

use DateInterval;
use DateTime;
use DateTimeInterface;

class Configuration
{
    private array $paths = [];
    private array $excludedPaths = [];

    public function __construct(array $options = [])
    {
        if (isset($options['paths'])) {
            $this->paths = is_string($options['paths']) ? [$options['paths']] : $options['paths'];
        }

        if (isset($options['excluded_paths'])) {
            $this->paths = is_string($options['excluded_paths']) ? [$options['excluded_paths']] : $options['excluded_paths'];
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
}
