<?php

namespace functional\Annotations;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Extractor\AnnotationExtractor;
use Cluster28\TeamShareDocumentation\Extractor\Extractor;
use Cluster28\TeamShareDocumentation\Model\AnnotationData;
use Cluster28\TeamShareDocumentation\Parser\Parser;
use Cluster28\TeamShareDocumentation\Tests\Functional\Classes\Class1;
use Cluster28\TeamShareDocumentation\Tests\Functional\Classes\Class2;
use Cluster28\TeamShareDocumentation\Tests\Functional\Classes\Class3;
use Cluster28\TeamShareDocumentation\Tests\Functional\Classes\Class4;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

class AnnotationsTest extends TestCase
{
    private Extractor $extractor;

    public function setUp(): void
    {
        $configuration = new Configuration(['paths' => __DIR__ . '/../Classes/']);
        $this->extractor = new Extractor(
            new Configuration(),
            new Parser($configuration),
            new AnnotationExtractor()
        );
    }

    public function testClassAnnotations(): void
    {
        foreach ($this->extractor->execute()->getClassAnnotations() as $classAnnotation) {
            $this->assertIsSharedAnnotation($classAnnotation->getAnnotation());
            $this->assertIsAnnotationData($classAnnotation);
            $this->assertIsValidSharedAnnotationContent($classAnnotation->getAnnotation());
        }
    }

    public function testMethodAnnotations()
    {
        foreach ($this->extractor->execute()->getMethodAnnotations() as $methodAnnotation) {
            $this->assertIsSharedAnnotation($methodAnnotation->getAnnotation());
            $this->assertIsAnnotationData($methodAnnotation);
            $this->assertIsValidSharedAnnotationContent($methodAnnotation->getAnnotation());
        }
    }

    public function testClassAnnotationsSortedByDateAsc()
    {
        $classAnnotations = $this->extractor->execute()->getClassAnnotationsSortedByDateAsc();
        $this->testClass1($classAnnotations[0]->getAnnotation());
        $this->testClass2($classAnnotations[1]->getAnnotation());
        $this->testClass3($classAnnotations[2]->getAnnotation());
        $this->testClass4($classAnnotations[3]->getAnnotation());
    }

    public function testMethodAnnotationsSortedByDateAsc()
    {
        $methodAnnotations = $this->extractor->execute()->getMethodAnnotationsSortedByDateAsc();
        $this->testMethodClass1($methodAnnotations[0]->getAnnotation());
        $this->testMethodClass2($methodAnnotations[1]->getAnnotation());
        $this->testMethodClass3($methodAnnotations[2]->getAnnotation());
        $this->testMethodClass4($methodAnnotations[3]->getAnnotation());
    }

    public function testClassAnnotationsSortedByDateDesc()
    {
        $classAnnotations = $this->extractor->execute()->getClassAnnotationsSortedByDateDesc();
        $this->testClass4($classAnnotations[0]->getAnnotation());
        $this->testClass3($classAnnotations[1]->getAnnotation());
        $this->testClass2($classAnnotations[2]->getAnnotation());
        $this->testClass1($classAnnotations[3]->getAnnotation());
    }

    public function testMethodAnnotationsSortedByDateDesc()
    {
        $methodAnnotations = $this->extractor->execute()->getMethodAnnotationsSortedByDateDesc();
        $this->testMethodClass4($methodAnnotations[0]->getAnnotation());
        $this->testMethodClass3($methodAnnotations[1]->getAnnotation());
        $this->testMethodClass2($methodAnnotations[2]->getAnnotation());
        $this->testMethodClass1($methodAnnotations[3]->getAnnotation());
    }

    public function testAllAnnotationsSortedByDateAsc()
    {
        $allAnnotations = $this->extractor->execute()->getAllAnnotationsSortedByDateAsc();
        $this->testClass1($allAnnotations[0]->getAnnotation());
        $this->testMethodClass1($allAnnotations[1]->getAnnotation());
        $this->testClass2($allAnnotations[2]->getAnnotation());
        $this->testMethodClass2($allAnnotations[3]->getAnnotation());
        $this->testClass3($allAnnotations[4]->getAnnotation());
        $this->testMethodClass3($allAnnotations[5]->getAnnotation());
        $this->testClass4($allAnnotations[6]->getAnnotation());
        $this->testMethodClass4($allAnnotations[7]->getAnnotation());
    }

    public function testAllAnnotationsSortedByDateDesc()
    {
        $allAnnotations = $this->extractor->execute()->getAllAnnotationsSortedByDateDesc();
        $this->testMethodClass4($allAnnotations[0]->getAnnotation());
        $this->testClass4($allAnnotations[1]->getAnnotation());
        $this->testMethodClass3($allAnnotations[2]->getAnnotation());
        $this->testClass3($allAnnotations[3]->getAnnotation());
        $this->testMethodClass2($allAnnotations[4]->getAnnotation());
        $this->testClass2($allAnnotations[5]->getAnnotation());
        $this->testMethodClass1($allAnnotations[6]->getAnnotation());
        $this->testClass1($allAnnotations[7]->getAnnotation());
    }

    public function testClassAnnotationsSortedByTagsAsc()
    {
        $arrayAnnotations = $this->extractor->execute()->getClassAnnotationsSortedByTagsAsc();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('ClassTag1', $arrayKeys[0]);
        $this->assertEquals('ClassTag2', $arrayKeys[1]);
        $this->assertEquals('ClassTag3', $arrayKeys[2]);
        $this->assertEquals('ClassTag4', $arrayKeys[3]);
    }

    public function testClassAnnotationsSortedByTagsDesc()
    {
        $arrayAnnotations = $this->extractor->execute()->getClassAnnotationsSortedByTagsDesc();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('ClassTag4', $arrayKeys[0]);
        $this->assertEquals('ClassTag3', $arrayKeys[1]);
        $this->assertEquals('ClassTag2', $arrayKeys[2]);
        $this->assertEquals('ClassTag1', $arrayKeys[3]);
    }

    public function testMethodAnnotationsSortedByTagsAsc()
    {
        $arrayAnnotations = $this->extractor->execute()->getMethodAnnotationsSortedByTagsAsc();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('MethodTag1', $arrayKeys[0]);
        $this->assertEquals('MethodTag2', $arrayKeys[1]);
        $this->assertEquals('MethodTag3', $arrayKeys[2]);
        $this->assertEquals('MethodTag4', $arrayKeys[3]);
    }

    public function testMethodAnnotationsSortedByTagsDesc()
    {
        $arrayAnnotations = $this->extractor->execute()->getMethodAnnotationsSortedByTagsDesc();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('MethodTag4', $arrayKeys[0]);
        $this->assertEquals('MethodTag3', $arrayKeys[1]);
        $this->assertEquals('MethodTag2', $arrayKeys[2]);
        $this->assertEquals('MethodTag1', $arrayKeys[3]);
    }

    public function testAllAnnotationsSortedByTagsAsc()
    {
        $arrayAnnotations = $this->extractor->execute()->getAllAnnotationsSortedByTagsAsc();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('ClassTag1', $arrayKeys[0]);
        $this->assertEquals('ClassTag2', $arrayKeys[1]);
        $this->assertEquals('ClassTag3', $arrayKeys[2]);
        $this->assertEquals('ClassTag4', $arrayKeys[3]);
        $this->assertEquals('MethodTag1', $arrayKeys[4]);
        $this->assertEquals('MethodTag2', $arrayKeys[5]);
        $this->assertEquals('MethodTag3', $arrayKeys[6]);
        $this->assertEquals('MethodTag4', $arrayKeys[7]);
    }

    public function testAllAnnotationsSortedByTagsDesc()
    {
        $arrayAnnotations = $this->extractor->execute()->getAllAnnotationsSortedByTagsDesc();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('MethodTag4', $arrayKeys[0]);
        $this->assertEquals('MethodTag3', $arrayKeys[1]);
        $this->assertEquals('MethodTag2', $arrayKeys[2]);
        $this->assertEquals('MethodTag1', $arrayKeys[3]);
        $this->assertEquals('ClassTag4', $arrayKeys[4]);
        $this->assertEquals('ClassTag3', $arrayKeys[5]);
        $this->assertEquals('ClassTag2', $arrayKeys[6]);
        $this->assertEquals('ClassTag1', $arrayKeys[7]);
    }

    private function assertIsAnnotationData($object): void
    {
        $this->assertInstanceOf(AnnotationData::class, $object);
    }

    private function assertIsSharedAnnotation($object): void
    {
        $this->assertInstanceOf(ShareAnnotation::class, $object);
    }

    private function assertIsValidSharedAnnotationContent(ShareAnnotation $shareAnnotation): void
    {
        $this->assertNotEmpty($shareAnnotation->date);
        $this->assertNotEmpty($shareAnnotation->description);
        $this->assertIsArray($shareAnnotation->tags);
    }

    private function testClass1(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-01', $shareAnnotation->date);
        $this->assertEquals('Class description for Class1', $shareAnnotation->description);
    }

    private function testClass2(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-03', $shareAnnotation->date);
        $this->assertEquals('Class description for Class2', $shareAnnotation->description);
    }

    private function testClass3(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-05', $shareAnnotation->date);
        $this->assertEquals('Class description for Class3', $shareAnnotation->description);
    }

    private function testClass4(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-07', $shareAnnotation->date);
        $this->assertEquals('Class description for Class4', $shareAnnotation->description);
    }

    private function testMethodClass1(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-02', $shareAnnotation->date);
        $this->assertEquals('Method1 from Class1', $shareAnnotation->description);
    }

    private function testMethodClass2(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-04', $shareAnnotation->date);
        $this->assertEquals('Method2 from Class2', $shareAnnotation->description);
    }

    private function testMethodClass3(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-06', $shareAnnotation->date);
        $this->assertEquals('Method1 from Class3', $shareAnnotation->description);
    }

    private function testMethodClass4(ShareAnnotation $shareAnnotation)
    {
        $this->assertEquals('1970-01-08', $shareAnnotation->date);
        $this->assertEquals('Method2 from Class4', $shareAnnotation->description);
    }
}
