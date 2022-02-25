<?php

namespace Cluster28\TeamShareDocumentation\Model;

use Reflector;

class ResultInfo
{
    private array $methodAnnotations;
    private array $classAnnotations;
    private const SORT_ASC = 'asc';
    private const SORT_DESC = 'desc';
    private string $className;

    public function __construct(Reflector $reflector, ?array $methodAnnotations = [], ?array $classAnnotations = [])
    {
        $this->className = $reflector->getName();
        $this->methodAnnotations = $methodAnnotations;
        $this->classAnnotations = $classAnnotations;
    }

    public function getName(): string
    {
        return $this->className;
    }

    public function setName(string $className): void
    {
        $this->className = $className;
    }

    public function addMethodAnnotations(array $methodAnnotations): void
    {
        foreach($methodAnnotations as $method) {
            $this->methodAnnotations[] = $method;
        }
    }

    public function addClassAnnotations(array $classAnnotations): void
    {
        foreach($classAnnotations as $annotation) {
            $this->classAnnotations[] = $annotation;
        }
    }

    public function getClassAnnotations(): array
    {
        return $this->classAnnotations;
    }

    public function getMethodAnnotations(): array
    {
        return $this->methodAnnotations;
    }

    public function getAllAnnotations(): array
    {
        return array_merge($this->getMethodAnnotations(), $this->getClassAnnotations());
    }

    public function getClassAnnotationsSortedByDateAsc(): array
    {
       return $this->sortByDate($this->getClassAnnotations(), self::SORT_ASC);
    }

    public function getClassAnnotationsSortedByDateDesc(): array
    {
        return $this->sortByDate($this->getClassAnnotations(), self::SORT_DESC);
    }

    public function getMethodAnnotationsSortedByDateAsc(): array
    {
        return $this->sortByDate($this->getMethodAnnotations(), self::SORT_ASC);
    }

    public function getMethodAnnotationsSortedByDateDesc(): array
    {
        return $this->sortByDate($this->getMethodAnnotations(), self::SORT_DESC);
    }

    public function getAllAnnotationsSortedByDateAsc(): array
    {
        return $this->sortByDate($this->getAllAnnotations(), self::SORT_ASC);
    }

    public function getAllAnnotationsSortedByDateDesc(): array
    {
        return $this->sortByDate($this->getAllAnnotations(), self::SORT_DESC);
    }

    public function getClassAnnotationsSortedByTagsAsc(): array
    {
        return $this->sortByTag($this->getClassAnnotations(), self::SORT_ASC);
    }

    public function getClassAnnotationsSortedByTagsDesc(): array
    {
        return $this->sortByTag($this->getClassAnnotations(), self::SORT_DESC);
    }

    public function getMethodAnnotationsSortedByTagsAsc(): array
    {
        return $this->sortByTag($this->getMethodAnnotations(), self::SORT_ASC);
    }

    public function getMethodAnnotationsSortedByTagsDesc(): array
    {
        return $this->sortByTag($this->getMethodAnnotations(), self::SORT_DESC);
    }

    public function getAllAnnotationsSortedByTagsAsc(): array
    {
        return $this->sortByTag($this->getAllAnnotations(), self::SORT_ASC);
    }

    public function getAllAnnotationsSortedByTagsDesc(): array
    {
        return $this->sortByTag($this->getAllAnnotations(), self::SORT_DESC);
    }

    private function sortByTag(array $array, $order = self::SORT_ASC): array
    {
        $tagsSortMap = [];

        foreach($array as $value) {
            foreach($value->tags as $tag) {
                $tagsSortMap[$tag][] = $value;
            }
        }

        if ($order === self::SORT_ASC) {
            ksort($tagsSortMap);
        } else {
            krsort($tagsSortMap);
        }

        return $tagsSortMap;
    }

    private function sortByDate(array $array, $order = 'asc'): array
    {
        return $this->sortBy($array, 'date', 'asc');
    }

    private function sortBy(array $arrayToSort, $sortKey = '', $order = self::SORT_ASC): array
    {
        $result = $arrayToSort;
        $column = array_column($result, $sortKey);

        if (self::SORT_ASC === $order) {
            array_multisort($column, $result);
        } else {
            array_multisort($column, SORT_DESC, $result);
        }
        return $result;
    }
}
