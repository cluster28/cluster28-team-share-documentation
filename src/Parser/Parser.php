<?php

namespace Cluster28\TeamShareDocumentation\Parser;

use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use PhpParser\Error;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\ParserFactory;
use Symfony\Component\Finder\Finder;

/**
 * @author Jordi Rejas <github@rejas.eu>
 */
class Parser implements ParserInterface
{
    private Configuration $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function parseFiles(): array
    {
        if (0 === count($this->configuration->getPaths())) {
            return [];
        }

        $reflectionClasses = [];

        $finder = new Finder();

        $finder
            ->in($this->configuration->getPaths())
            ->exclude($this->configuration->getExcludedPaths())
            ->files()
            ->name('*.php')
        ;

        foreach ($finder as $file) {
            $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
            try {
                $ast = $parser->parse(file_get_contents($file->getRealPath()));

                foreach ($ast as $node) {
                    if ($node instanceof Namespace_) {
                        /** @var Namespace_ $node */
                        foreach ($node->stmts as $stmt) {
                            if ($stmt instanceof Class_) {
                                /** @var Class_ $stmt */
                                $className = implode('\\', $node->name->parts) . '\\' . $stmt->name->name;
                                $rfc = new \ReflectionClass($className);
                                $reflectionClasses[] = $rfc;
                            }
                        }
                    }
                }
            } catch (Error $error) {
                echo "Parse error: {$error->getMessage()}\n";
            }
        }

        return $reflectionClasses;
    }
}
