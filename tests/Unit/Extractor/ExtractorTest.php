<?php

namespace Unit\Extractor;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Extractor\AnnotationExtractor;
use Cluster28\TeamShareDocumentation\Extractor\Extractor;
use Cluster28\TeamShareDocumentation\Extractor\ExtractorInterface;
use Cluster28\TeamShareDocumentation\Model\Collection\Annotations;
use Cluster28\TeamShareDocumentation\Parser\Parser;
use PHPUnit\Framework\TestCase;

class ExtractorTest extends TestCase
{
    private Extractor $extractor;

    public function setUp(): void
    {
        $configuration = new Configuration();
        $this->extractor = new Extractor(
            $configuration,
            new Parser($configuration),
            new AnnotationExtractor(),
        );
    }

    public function testExtractor()
    {
        $this->assertInstanceOf(ExtractorInterface::class, $this->extractor);
    }

    public function testExtractorExtractAnnotationsMethod()
    {
        $this->assertInstanceOf(Annotations::class, $this->extractor->extractAnnotations());
    }
}