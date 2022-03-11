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

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }
}
