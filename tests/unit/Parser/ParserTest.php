<?php

namespace unit\Parser;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Model\Collection\Classes;
use Cluster28\TeamShareDocumentation\Parser\Parser;
use Cluster28\TeamShareDocumentation\Parser\ParserInterface;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParser()
    {
        $configuration = new Configuration();
        $parser = new Parser($configuration);
        $this->assertInstanceOf(ParserInterface::class, $parser);
    }

    public function testParseFilesMethods()
    {
        $configuration = new Configuration();
        $parser = new Parser($configuration);
        $this->assertInstanceOf(Classes::class, $parser->parseFiles());
    }
}
