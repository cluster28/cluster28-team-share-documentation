<?php

namespace Cluster28\TeamShareDocumentation\Tests\Functional\Classes;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;

/**
 * @ShareAnnotation(date="1970-01-07", description="Class description for Class4")
 */
class Class4
{
    public function method1Class2()
    {
    }

    /**
     * @ShareAnnotation(date="1970-01-08", description="Method2 from Class4")
     */
    public function method2Class2()
    {
    }
}
