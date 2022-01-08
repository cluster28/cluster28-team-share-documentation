<?php

namespace unit\Model\Collection;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Cluster28\TeamShareDocumentation\Model\Collection\Annotations;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AnnotationsTest extends TestCase
{
    private Annotations $annotations;

    public function setUp(): void
    {
        $this->annotations = new Annotations();
    }

    public function testAnnotations()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations);
    }

    public function testAnnotationsAddAnnotationMethod()
    {
        $this->assertInstanceOf(Annotations::class, $this->annotations->addAnnotation(
            new ReflectionClass(self::class),
            new ShareAnnotation()
        ));
    }

    public function testAnnotationsGetClassAnnotationsMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getClassAnnotations());
    }

    public function testAnnotationsGetMethodAnnotationsMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getMethodAnnotations());
    }

    public function testAnnotationsGetClassAnnotationsSortedByDateAscMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getClassAnnotationsSortedByDateAsc());
    }

    public function testAnnotationsGetClassAnnotationsSortedByDateDescMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getClassAnnotationsSortedByDateDesc());
    }

    public function testAnnotationsGetMethodAnnotationsSortedByDateAscMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getMethodAnnotationsSortedByDateAsc());
    }

    public function testAnnotationsGetMethodAnnotationsSortedByDateDescMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getMethodAnnotationsSortedByDateDesc());
    }

    public function testAnnotationsGetAllAnnotationsSortedByDateAscMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getAllAnnotationsSortedByDateAsc());
    }

    public function testAnnotationsGetAllAnnotationsSortedByDateDescMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getAllAnnotationsSortedByDateDesc());
    }

    public function testAnnotationsGetAllAnnotationsGroupedByClassNameMethod()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->annotations->getAllAnnotationsGroupedByClassName());
    }
}
