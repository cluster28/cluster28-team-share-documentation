<?php

namespace Cluster28\TeamShareDocumentation\Parser;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
interface ParserInterface
{
    public function __construct(Configuration $configuration);

    public function parseFiles(): array;
}
