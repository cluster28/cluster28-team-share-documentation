<?php

namespace Cluster28\TeamShareDocumentation\Tests\Functional\Classes;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;

/**
 * @ShareAnnotation(date="1970-01-03", description="Class description for Class2", tags={"ClassTag2", "ClassTag3"})
 */
class Class2
{
    public function method1Class2()
    {
    }

    /**
     * @ShareAnnotation(date="1970-01-04", description="Method2 from Class2", tags={"MethodTag2", "MethodTag3"})
     */
    public function method2Class2()
    {
    }
}
