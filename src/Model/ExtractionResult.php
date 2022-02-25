<?php

namespace Cluster28\TeamShareDocumentation\Model;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
class ExtractionResult
{
    private array $results;

    public function addResult(ResultInfo $resultInfo): self
    {
        $this->results[$resultInfo->getName()] = $resultInfo;
        return $this;
    }

    public function getResults(): array
    {
        return $this->results;
    }
}
