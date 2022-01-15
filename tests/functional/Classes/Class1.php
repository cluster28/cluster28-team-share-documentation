<?php

namespace Cluster28\TeamShareDocumentation\Tests\Functional\Classes;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;

/**
 * @ShareAnnotation(date="1970-01-01", description="Class description for Class1")
 */
class Class1
{
    /**
     * @ShareAnnotation(date="1970-01-02", description="Method1 from Class1")
     */
    public function method1Class1()
    {
    }

    public function method2Class1()
    {
    }
}
