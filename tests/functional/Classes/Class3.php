<?php

namespace Cluster28\TeamShareDocumentation\Tests\Functional\Classes;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;

/**
 * @ShareAnnotation(date="1970-01-05", description="Class description for Class3")
 */
class Class3
{
    /**
     * @ShareAnnotation(date="1970-01-06", description="Method1 from Class3")
     */
    public function method1Class3()
    {
    }

    public function method2Class3()
    {
    }
}
