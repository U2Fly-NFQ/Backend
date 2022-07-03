<?php

namespace App\Traits;

use ReflectionClass;

trait TransferTrait
{
    public function objectToArray($object): array
    {
        $reflectionClass = new ReflectionClass(get_class($object));
        $array = [];
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }

        return $array;
    }
}
