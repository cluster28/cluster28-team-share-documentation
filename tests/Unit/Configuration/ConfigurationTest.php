<?php

namespace Unit\Configuration;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfigurationWithoutOptions()
    {
        $configuration = new Configuration();
        $this->assertInstanceOf(Configuration::class, $configuration);
    }

    public function testConfigurationWithPathsOption()
    {
        $options = ['paths' => 'foo'];
        $configuration = new Configuration($options);
        $this->assertIsArray($configuration->getPaths());

        $options = ['paths' => ['foo']];
        $configuration = new Configuration($options);
        $this->assertIsArray($configuration->getPaths());
    }

    public function testConfigurationWithExcludedPathsOption()
    {
        $options = ['excluded_paths' => 'foo'];
        $configuration = new Configuration($options);
        $this->assertIsArray($configuration->getExcludedPaths());

        $options = ['excluded_paths' => ['foo']];
        $configuration = new Configuration($options);
        $this->assertIsArray($configuration->getExcludedPaths());
    }

    public function testConfigurationWithIntervalSpecOption()
    {
        $options = ['interval_spec' => 'P10D'];
        $configuration = new Configuration($options);
        $this->assertEquals(10, $configuration->getStartDate()->diff(new DateTime())->d);
    }

    public function testConfigurationWithInvalidIntervalSpecOption()
    {
        $this->expectException(Exception::class);
        $options = ['interval_spec' => '1D'];
        new Configuration($options);
    }
}