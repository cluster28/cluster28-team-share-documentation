<?php

namespace Cluster28\TeamShareDocumentation\Parser;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Model\Collection\Classes;

interface ParserInterface
{
    public function __construct(Configuration $configuration);

    public function parseFiles(): Classes;
}
