<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use ReflectionClass;

interface AnnotationExtractorInterface
{
    public function extractClassAnnotations(ReflectionClass $reflectionClass): array;

    public function extractMethodsAnnotations(ReflectionClass $reflectionClass): array;
}
