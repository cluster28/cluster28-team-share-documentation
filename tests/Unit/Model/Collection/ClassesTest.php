<?php

namespace Unit\Model\Collection;

use Cluster28\TeamShareDocumentation\Model\Collection\Classes;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ClassesTest extends TestCase
{
    public function testAnnotations()
    {
        $classes = new Classes();
        $this->assertInstanceOf(ArrayCollection::class, $classes);
    }
}
