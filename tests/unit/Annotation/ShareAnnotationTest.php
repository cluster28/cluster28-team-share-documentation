<?php

namespace unit\Annotation;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use DateTime;
use PHPUnit\Framework\TestCase;

class ShareAnnotationTest extends TestCase
{
    private ShareAnnotation $shareAnnotation;

    public function setUp(): void
    {
        $this->shareAnnotation = new ShareAnnotation();
    }

    public function testShareAnnotationProperties()
    {
        $this->assertObjectHasAttribute('date', $this->shareAnnotation);
        $this->assertObjectHasAttribute('description', $this->shareAnnotation);
        $this->assertObjectHasAttribute('tags', $this->shareAnnotation);
    }

    public function testShareAnnotationPropertyDateValue()
    {
        $this->shareAnnotation->date = (new DateTime())->format('Y-m-d');
        $this->assertIsString($this->shareAnnotation->date);
    }

    public function testShareAnnotationPropertyDescriptionValue()
    {
        $this->shareAnnotation->description = "Share annotation description";
        $this->assertIsString($this->shareAnnotation->description);
    }

    public function testShareAnnotationPropertyTagsValue()
    {
        $this->shareAnnotation->tags = ["Tag 1", "Tag 2", "Tag 3"];
        $this->assertIsArray($this->shareAnnotation->tags);
    }

    public function testShareAnnotationGetDateTimeMethod()
    {
        $this->shareAnnotation->date = (new DateTime())->format('Y-m-d');
        $this->assertInstanceOf(DateTime::class, $this->shareAnnotation->getDateTime());
    }
}
