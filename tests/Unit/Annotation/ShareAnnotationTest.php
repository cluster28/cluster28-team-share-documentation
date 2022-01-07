<?php

namespace Unit\Annotation;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use DateTime;
use PHPUnit\Framework\TestCase;

class ShareAnnotationTest extends TestCase
{
    public function testShareAnnotation()
    {
        $shareAnnotation = new ShareAnnotation();
        $this->assertObjectHasAttribute('date', $shareAnnotation);
        $this->assertObjectHasAttribute('description', $shareAnnotation);
        $this->assertObjectHasAttribute('tags', $shareAnnotation);
        $shareAnnotation->date = (new DateTime())->format('Y-m-d');
        $shareAnnotation->description = "Share annotation description";
        $shareAnnotation->tags = ["Tag 1", "Tag 2", "Tag 3"];
        $this->assertIsString($shareAnnotation->date);
        $this->assertIsString($shareAnnotation->description);
        $this->assertIsArray($shareAnnotation->tags);
        $this->assertInstanceOf(DateTime::class, $shareAnnotation->getDateTime());
    }
}