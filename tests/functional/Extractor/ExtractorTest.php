<?php

namespace functional\Extractor;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Extractor\AnnotationExtractor;
use Cluster28\TeamShareDocumentation\Extractor\Extractor;
use Cluster28\TeamShareDocumentation\Parser\Parser;
use PHPUnit\Framework\TestCase;

class ExtractorTest extends TestCase
{
    private Extractor $extractor;

    public function setUp(): void
    {
        $configuration = new Configuration(['paths' => __DIR__ . '/../Classes/']);
        $this->extractor = new Extractor(
            new Configuration(),
            new Parser($configuration),
            new AnnotationExtractor()
        );
    }

    public function testExtractionCount()
    {
        $this->assertEquals(8, $this->extractor->extractAnnotations()->count());
    }

    public function testExtractionFromClassesCount()
    {
        $this->assertEquals(4, $this->extractor->extractAnnotations()->getClassAnnotations()->count());
    }

    public function testExtractionFromMethodsCount()
    {
        $this->assertEquals(4, $this->extractor->extractAnnotations()->getMethodAnnotations()->count());
    }
}
