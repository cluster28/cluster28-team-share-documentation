<?php

namespace unit\Configuration;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
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
}
