<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Model\ExtractionResult;
use Cluster28\TeamShareDocumentation\Model\ClassInfo;
use Cluster28\TeamShareDocumentation\Model\ResultInfo;
use Cluster28\TeamShareDocumentation\Parser\ParserInterface;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
class Extractor implements ExtractorInterface
{
    private Configuration $configuration;
    private ParserInterface $parser;
    private AnnotationExtractorInterface $annotationExtractor;

    public function __construct(
        Configuration $configuration,
        ParserInterface $parser,
        AnnotationExtractorInterface $annotationExtractor
    ) {
        $this->parser = $parser;
        $this->annotationExtractor = $annotationExtractor;
    }

    public function execute(): ExtractionResult
    {
        $extractionResult = new ExtractionResult();

        foreach ($this->parser->parseFiles() as $reflectionClass) {
            $extractionResult->addClassAnnotations($this->annotationExtractor->extractClassAnnotations($reflectionClass));
            $extractionResult->addMethodAnnotations($this->annotationExtractor->extractMethodsAnnotations($reflectionClass));
        }

        return $extractionResult;
    }
}
