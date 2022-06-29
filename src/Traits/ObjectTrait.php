<?php

namespace App\Traits;

use ReflectionClass;

trait ObjectTrait
{
    public function getPropertyOfObject(mixed $baseObject): array
    {
        $reflectionClass = new ReflectionClass(get_class($baseObject));

        $array = [];
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $array[] = $property->getName();
            $property->setAccessible(false);
        }

        return $array;
    }
}
