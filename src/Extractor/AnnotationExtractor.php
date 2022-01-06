<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionMethod;

class AnnotationExtractor implements AnnotationExtractorInterface
{
    private AnnotationReader $annotationReader;

    public function __construct()
    {
        $this->annotationReader = new AnnotationReader();
    }

    public function extractClassAnnotations(ReflectionClass $reflectionClass): array
    {
        $allClassAnnotations = [];
        $classAnnotations = $this->annotationReader->getClassAnnotations($reflectionClass);
        if (count($classAnnotations) > 0) {
            foreach ($classAnnotations as $classAnnotation) {
                if ($classAnnotation instanceof ShareAnnotation) {
                    $allClassAnnotations[] = [$reflectionClass, $classAnnotation];
                }
            }
        }

        return $allClassAnnotations;
    }

    public function extractMethodsAnnotations(ReflectionClass $reflectionClass): array
    {
        $allMethodAnnotations = [];
        /** @var ReflectionMethod $reflectionMethod */
        foreach ($reflectionClass->getMethods() as $reflectionMethod) {
            $methodAnnotations = $this->annotationReader->getMethodAnnotations($reflectionMethod);
            if (count($methodAnnotations) > 0) {
                foreach ($methodAnnotations as $methodAnnotation) {
                    if ($methodAnnotation instanceof ShareAnnotation) {
                        $allMethodAnnotations[] = [$reflectionMethod, $methodAnnotation];
                    }
                }
            }
        }

        return $allMethodAnnotations;
    }
}
