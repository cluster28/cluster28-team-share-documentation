<?php

namespace Unit\Extractor;

use Cluster28\TeamShareDocumentation\Extractor\AnnotationExtractor;
use Cluster28\TeamShareDocumentation\Extractor\AnnotationExtractorInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AnnotationExtractorTest extends TestCase
{
    public function testAnnotationExtractor()
    {
        $annotationExtractor = new AnnotationExtractor();
        $this->assertInstanceOf(AnnotationExtractorInterface::class, $annotationExtractor);
    }

    public function testAnnotationExtractorMethods()
    {
        $annotationExtractor = new AnnotationExtractor();
        $this->assertIsArray($annotationExtractor->extractClassAnnotations(new ReflectionClass(self::class)));
        $this->assertCount(0, $annotationExtractor->extractClassAnnotations(new ReflectionClass(self::class)));
        $this->assertIsArray($annotationExtractor->extractMethodsAnnotations(new ReflectionClass(self::class)));
        $this->assertCount(0, $annotationExtractor->extractMethodsAnnotations(new ReflectionClass(self::class)));
    }
}