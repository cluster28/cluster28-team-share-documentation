<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Model\Collection\Annotations;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
interface ExtractorInterface
{
    public function extractAnnotations(): Annotations;
}
