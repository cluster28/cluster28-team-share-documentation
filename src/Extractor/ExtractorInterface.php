<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Model\Collection\Annotations;

interface ExtractorInterface
{
    public function extractAnnotations(): Annotations;
}
