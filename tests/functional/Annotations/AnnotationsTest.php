<?php

namespace functional\Annotations;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Cluster28\TeamShareDocumentation\Configuration\Configuration;
use Cluster28\TeamShareDocumentation\Extractor\AnnotationExtractor;
use Cluster28\TeamShareDocumentation\Extractor\Extractor;
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
        foreach ($this->extractor->execute()->getResults() as $resultInfo) {
            /**
             * @var ReflectionMethod $arrayAnnotation[0]
             * @var ShareAnnotation $arrayAnnotation[1]
             */
            $classAnnotation = $resultInfo->getClassAnnotations()[0]->getAnnotation();
            $this->assertIsSharedAnnotation($classAnnotation);
            $this->assertIsValidSharedAnnotationContent($classAnnotation);
        }
    }

    public function testMethodAnnotations()
    {
        foreach ($this->extractor->execute()->getResults() as $resultInfo) {
            /**
             * @var ReflectionMethod $arrayAnnotation[0]
             * @var ShareAnnotation $arrayAnnotation[1]
             */
            $methodAnnotations = $resultInfo->getMethodAnnotations()[0]->getAnnotation();
            $this->assertIsSharedAnnotation($methodAnnotations);
            $this->assertIsValidSharedAnnotationContent($methodAnnotations);
        }
    }

    public function testClassAnnotationsSortedByDateAsc()
    {
        $arrayAnnotations = $this->extractor->execute()->getClassAnnotationsSortedByDateAsc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('19700101', $arrayKeys[0]);
        $this->assertIsReflectionClass(current($arrayAnnotations)[0][0]);
        $this->testClass1(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700103', $arrayKeys[1]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700105', $arrayKeys[2]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700107', $arrayKeys[3]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass4(current($arrayAnnotations)[0][1]);
    }

    public function testMethodAnnotationsSortedByDateAsc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getMethodAnnotationsSortedByDateAsc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('19700102', $arrayKeys[0]);
        $this->assertIsReflectionMethod(current($arrayAnnotations)[0][0]);
        $this->testMethodClass1(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700104', $arrayKeys[1]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700106', $arrayKeys[2]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700108', $arrayKeys[3]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass4(current($arrayAnnotations)[0][1]);
    }

    public function testClassAnnotationsSortedByDateDesc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getClassAnnotationsSortedByDateDesc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('19700107', $arrayKeys[0]);
        $this->assertIsReflectionClass(current($arrayAnnotations)[0][0]);
        $this->testClass4(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700105', $arrayKeys[1]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700103', $arrayKeys[2]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700101', $arrayKeys[3]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass1(current($arrayAnnotations)[0][1]);
    }

    public function testMethodAnnotationsSortedByDateDesc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getMethodAnnotationsSortedByDateDesc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('19700108', $arrayKeys[0]);
        $this->assertIsReflectionMethod(current($arrayAnnotations)[0][0]);
        $this->testMethodClass4(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700106', $arrayKeys[1]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700104', $arrayKeys[2]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700102', $arrayKeys[3]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass1(current($arrayAnnotations)[0][1]);
    }

    public function testAllAnnotationsSortedByDateAsc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getAllAnnotationsSortedByDateAsc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('19700101', $arrayKeys[0]);
        $this->assertIsReflectionClass(current($arrayAnnotations)[0][0]);
        $this->testClass1(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700102', $arrayKeys[1]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass1(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700103', $arrayKeys[2]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700104', $arrayKeys[3]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700105', $arrayKeys[4]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700106', $arrayKeys[5]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700107', $arrayKeys[6]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass4(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700108', $arrayKeys[7]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass4(current($arrayAnnotations)[0][1]);
    }

    public function testAllAnnotationsSortedByDateDesc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getAllAnnotationsSortedByDateDesc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('19700108', $arrayKeys[0]);
        $this->assertIsReflectionMethod(current($arrayAnnotations)[0][0]);
        $this->testMethodClass4(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700107', $arrayKeys[1]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass4(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700106', $arrayKeys[2]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700105', $arrayKeys[3]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass3(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700104', $arrayKeys[4]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700103', $arrayKeys[5]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass2(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700102', $arrayKeys[6]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->testMethodClass1(current($arrayAnnotations)[0][1]);
        $this->assertEquals('19700101', $arrayKeys[7]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->testClass1(current($arrayAnnotations)[0][1]);
    }

    public function testClassAnnotationsSortedByTagsAsc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getClassAnnotationsSortedByTagsAsc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('ClassTag1', $arrayKeys[0]);
        $this->assertIsReflectionClass(current($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag2', $arrayKeys[1]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag3', $arrayKeys[2]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag4', $arrayKeys[3]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
    }

    public function testClassAnnotationsSortedByTagsDesc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getClassAnnotationsSortedByTagsDesc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('ClassTag4', $arrayKeys[0]);
        $this->assertIsReflectionClass(current($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag3', $arrayKeys[1]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag2', $arrayKeys[2]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag1', $arrayKeys[3]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
    }

    public function testMethodAnnotationsSortedByTagsAsc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getMethodAnnotationsSortedByTagsAsc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('MethodTag1', $arrayKeys[0]);
        $this->assertIsReflectionMethod(current($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag2', $arrayKeys[1]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag3', $arrayKeys[2]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag4', $arrayKeys[3]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
    }

    public function testMethodAnnotationsSortedByTagsDesc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getMethodAnnotationsSortedByTagsDesc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('MethodTag4', $arrayKeys[0]);
        $this->assertIsReflectionMethod(current($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag3', $arrayKeys[1]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag2', $arrayKeys[2]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag1', $arrayKeys[3]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
    }

    public function testAllAnnotationsSortedByTagsAsc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getAllAnnotationsSortedByTagsAsc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('ClassTag1', $arrayKeys[0]);
        $this->assertIsReflectionClass(current($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag2', $arrayKeys[1]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag3', $arrayKeys[2]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag4', $arrayKeys[3]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag1', $arrayKeys[4]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag2', $arrayKeys[5]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag3', $arrayKeys[6]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag4', $arrayKeys[7]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
    }

    public function testAllAnnotationsSortedByTagsDesc()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getAllAnnotationsSortedByTagsDesc()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals('MethodTag4', $arrayKeys[0]);
        $this->assertIsReflectionMethod(current($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag3', $arrayKeys[1]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag2', $arrayKeys[2]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('MethodTag1', $arrayKeys[3]);
        $this->assertIsReflectionMethod(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag4', $arrayKeys[4]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag3', $arrayKeys[5]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag2', $arrayKeys[6]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
        $this->assertEquals('ClassTag1', $arrayKeys[7]);
        $this->assertIsReflectionClass(next($arrayAnnotations)[0][0]);
    }

    public function testAllAnnotationsGroupedByClassName()
    {
        $arrayAnnotations = $this->extractor->extractAnnotations()->getAllAnnotationsGroupedByClassName()->toArray();
        $arrayKeys = array_keys($arrayAnnotations);
        $this->assertEquals(Class1::class, $arrayKeys[0]);
        $this->assertCount(2, current($arrayAnnotations));
        $this->testClass1(current($arrayAnnotations)[0][1]);
        $this->testMethodClass1(current($arrayAnnotations)[1][1]);
        $this->assertEquals(Class2::class, $arrayKeys[1]);
        $this->assertCount(2, next($arrayAnnotations));
        $this->testClass2(current($arrayAnnotations)[0][1]);
        $this->testMethodClass2(current($arrayAnnotations)[1][1]);
        $this->assertEquals(Class3::class, $arrayKeys[2]);
        $this->assertCount(2, next($arrayAnnotations));
        $this->testClass3(current($arrayAnnotations)[0][1]);
        $this->testMethodClass3(current($arrayAnnotations)[1][1]);
        $this->assertEquals(Class4::class, $arrayKeys[3]);
        $this->assertCount(2, next($arrayAnnotations));
        $this->testClass4(current($arrayAnnotations)[0][1]);
        $this->testMethodClass4(current($arrayAnnotations)[1][1]);
    }

    private function assertIsReflectionClass($object): void
    {
        $this->assertInstanceOf(ReflectionClass::class, $object);
    }

    private function assertIsReflectionMethod($object): void
    {
        $this->assertInstanceOf(ReflectionMethod::class, $object);
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
