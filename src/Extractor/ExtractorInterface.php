<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Model\ExtractionResult;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
interface ExtractorInterface
{
    public function execute(): ExtractionResult;
}
