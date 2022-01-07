<?php

namespace Unit\Model\Collection;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Cluster28\TeamShareDocumentation\Model\Collection\Annotations;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AnnotationsTest extends TestCase
{
    public function testAnnotations()
    {
        $annotations = new Annotations();
        $this->assertInstanceOf(ArrayCollection::class, $annotations);
    }

    public function testAnnotationsSetters()
    {
        $annotations = new Annotations();
        $this->assertInstanceOf(Annotations::class,$annotations->addAnnotation(
            new ReflectionClass(self::class),
            new ShareAnnotation()
        ));
    }

    public function testAnnotationsGetters()
    {
        $annotations = new Annotations();
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getClassAnnotations());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getMethodAnnotations());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getClassAnnotationsSortedByDateAsc());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getClassAnnotationsSortedByDateDesc());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getMethodAnnotationsSortedByDateAsc());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getMethodAnnotationsSortedByDateDesc());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getAllAnnotationsSortedByDateAsc());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getAllAnnotationsSortedByDateDesc());
        $this->assertInstanceOf(ArrayCollection::class,$annotations->getAllAnnotationsGroupedByClassName());
    }
}