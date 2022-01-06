<?php

namespace Cluster28\TeamShareDocumentation\Extractor;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Parser\Parser;
use Cluster28\TeamShareDocumentation\Parser\ParserInterface;
use InvalidArgumentException;

class ExtractorFactory
{
    public static function createExtractor(Configuration $configuration, array $options = []): ExtractorInterface
    {
        $parser = new Parser($configuration);
        if (isset($options['parser'])) {
            if (!is_object($options['parser'])) {
                throw new InvalidArgumentException(sprintf('parser option %s must be an object', $options['extractor']));
            }

            if (is_object($options['parser']) && !$options['parser'] instanceof ParserInterface) {
                throw new InvalidArgumentException(sprintf('parser option %s must implement Cluster28\TeamShareDocumentation\Parser\ParserInterface', $options['extractor']));
            }

            $parser = $options['parser'];
        }

        $annotationExtractor = new AnnotationExtractor();
        if (isset($options['annotation_extractor'])) {
            if (!is_object($options['annotation_extractor'])) {
                throw new InvalidArgumentException(sprintf('annotation_extractor option %s must be an object', $options['extractor']));
            }

            if (is_object($options['annotation_extractor']) && !$options['annotation_extractor'] instanceof AnnotationExtractorInterface) {
                throw new InvalidArgumentException(sprintf('annotation_extractor option %s must implement Cluster28\TeamShareDocumentation\Parser\ParserInterface', $options['extractor']));
            }

            $annotationExtractor = $options['annotation_extractor'];
        }

        $extractor = new Extractor($configuration, $parser, $annotationExtractor);
        if (isset($options['extractor'])) {
            if (!is_object($options['extractor'])) {
                throw new InvalidArgumentException(sprintf('Extractor %s must be an object', $options['extractor']));
            }

            if (is_object($options['extractor']) && !$options['extractor'] instanceof ExtractorInterface) {
                throw new InvalidArgumentException(sprintf('Extractor %s must implement Cluster28\TeamShareDocumentation\Extractor\ExtractorInterface', $options['extractor']));
            }

            $extractor = $options['extractor'];
        }

        return $extractor;
    }
}
