<?php

namespace Cluster28\TeamShareDocumentation\Model\Collection;

use Cluster28\TeamShareDocumentation\Annotation\ShareAnnotation;
use Doctrine\Common\Collections\ArrayCollection;
use Reflector;
use ReflectionClass;
use ReflectionMethod;

class Annotations extends ArrayCollection
{
    public function addAnnotation(Reflector $reflector, ShareAnnotation $shareAnnotation)
    {
        $this->add([$reflector, $shareAnnotation]);
    }

    public function getClassAnnotations(): ArrayCollection
    {
        return $this->filter(function ($array) {
            if ($array[0] instanceof ReflectionClass) {
                return $array;
            }
        });
    }

    public function getMethodAnnotations(): ArrayCollection
    {
        return $this->filter(function ($array) {
            if ($array[0] instanceof ReflectionMethod) {
                return $array;
            }
        });
    }

    public function getClassAnnotationsSortedByDateAsc(): ArrayCollection
    {
        return new ArrayCollection($this->sortByDate($this->getClassAnnotations()));
    }

    public function getClassAnnotationsSortedByDateDesc(): ArrayCollection
    {
        return new ArrayCollection($this->sortByDate($this->getClassAnnotations(), 'desc'));
    }

    public function getMethodAnnotationsSortedByDateAsc(): ArrayCollection
    {
        return new ArrayCollection($this->sortByDate($this->getMethodAnnotations()));
    }

    public function getMethodAnnotationsSortedByDateDesc(): ArrayCollection
    {
        return new ArrayCollection($this->sortByDate($this->getMethodAnnotations(), 'desc'));
    }

    public function getAllAnnotationsSortedByDateAsc(): ArrayCollection
    {
        return new ArrayCollection(
            $this->sortByDate(
                new ArrayCollection(
                    array_merge(
                        $this->getClassAnnotations()->toArray(),
                        $this->getMethodAnnotations()->toArray()
                    )
                )
            )
        );
    }

    public function getAllAnnotationsSortedByDateDesc(): ArrayCollection
    {
        return new ArrayCollection(
            $this->sortByDate(
                new ArrayCollection(
                    array_merge(
                        $this->getClassAnnotations()->toArray(),
                        $this->getMethodAnnotations()->toArray()
                    )
                ),
                'desc'
            )
        );
    }

    public function getAllAnnotationsGroupedByClassName(): ArrayCollection
    {
        $array = [];

        foreach (array_merge($this->getClassAnnotations()->toArray(), $this->getMethodAnnotations()->toArray()) as $element) {
            if ($element[0] instanceof ReflectionClass) {
                if (!isset($array[$element[0]->name])) {
                    $array[$element[0]->name] = [];
                }
                $array[$element[0]->name][] = $element;
            } elseif ($element[0] instanceof ReflectionMethod) {
                if (!isset($array[$element[0]->class])) {
                    $array[$element[0]->class] = [];
                }
                $array[$element[0]->class][] = $element;
            }
        }

        ksort($array);

        return new ArrayCollection($array);
    }

    private function sortByDate(ArrayCollection $arrayCollection, $order = 'asc')
    {
        $array = [];
        foreach ($arrayCollection as $element) {
            if ($element[1] instanceof ShareAnnotation) {
                $date = str_replace('-', '', $element[1]->date);
                if (!isset($array[$date])) {
                    $array[$date] = [];
                }
                $array[$date][] = $element;
            }
        }

        'asc' === $order ? ksort($array) : krsort($array);

        return $array;
    }
}
