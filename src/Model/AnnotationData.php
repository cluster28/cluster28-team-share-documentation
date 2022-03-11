<?php

namespace Cluster28\TeamShareDocumentation\Model;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;

class AnnotationData
{
    private ShareAnnotation $annotation;
    private bool $isInClass = false;
    private bool $isInMethod = false;
    private string $className = '';
    private string $methodName = '';

    public function getAnnotation(): ShareAnnotation
    {
        return $this->annotation;
    }

    public function setAnnotation(ShareAnnotation $annotation): self
    {
        $this->annotation = $annotation;
        return $this;
    }

    public function isInClass(): bool
    {
        return $this->isInClass;
    }

    public function setIsInClass(bool $isInClass): self
    {
        $this->isInClass = $isInClass;
        return $this;
    }

    public function isInMethod(): bool
    {
        return $this->isInMethod;
    }

    public function setIsInMethod(bool $isInMethod): self
    {
        $this->isInMethod = $isInMethod;
        return $this;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setClassName(string $className): self
    {
        $this->className = $className;
        return $this;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function setMethodName(string $methodName): self
    {
        $this->methodName = $methodName;
        return $this;
    }
}