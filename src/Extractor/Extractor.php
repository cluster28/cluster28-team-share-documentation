<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Model\Collection\Annotations;
use Cluster28\TeamShareDocumentation\Parser\ParserInterface;
use Reflector;

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
        $this->configuration = $configuration;
        $this->parser = $parser;
        $this->annotationExtractor = $annotationExtractor;
    }

    public function extractAnnotations(): Annotations
    {
        $classes = $this->parser->parseFiles();
        $annotations = new Annotations();

        foreach ($classes->toArray() as $class) {

            foreach (
                array_merge(
                    $this->annotationExtractor->extractClassAnnotations($class),
                    $this->annotationExtractor->extractMethodsAnnotations($class)
                ) as $array) {
                    /** @var Reflector $reflector */
                    $reflector = $array[0];
                    /** @var ShareAnnotation $shareAnnotation */
                    $shareAnnotation = $array[1];
                    $annotations->addAnnotation($reflector, $shareAnnotation);
            }
        }

        return $annotations;
    }
}
