<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Cluster28\TeamShareDocumentation\Model\AnnotationData;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionMethod;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
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
                    $allClassAnnotations[] = $this->createAnnotationData(
                        $classAnnotation,
                        $reflectionClass->getName(),
                        false,
                        $reflectionClass->getName()
                    );
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
                        $allMethodAnnotations[] = $this->createAnnotationData(
                            $methodAnnotation,
                            $reflectionClass->getName(),
                            true,
                            $reflectionMethod->getName()
                        );
                    }
                }
            }
        }

        return $allMethodAnnotations;
    }

    public function createAnnotationData(
        ShareAnnotation $shareAnnotation,
        string $className,
        bool $inMethod = false,
        string $methodName = ''
    ) {
        $annotation = new AnnotationData();
        $annotation->setClassName($className);
        $annotation->setIsInMethod($inMethod);
        $annotation->setMethodName($methodName);
        $annotation->setAnnotation($shareAnnotation);
        return $annotation;
    }
}
