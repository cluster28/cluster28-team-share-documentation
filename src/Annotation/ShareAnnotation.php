<?php

namespace Cluster28\TeamShareDocumentation\Annotation;

use DateTime;

/**
 * @Annotation
 * @author Jordi Rejas <github@rejas.eu>
 */
class ShareAnnotation
{
    public string $date;

    public string $description;

    public array $tags = [];

    public function getDateTime()
    {
        return DateTime::createFromFormat('Y-m-d', $this->date);
    }
}
