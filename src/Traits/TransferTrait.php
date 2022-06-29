<?php

namespace App\Traits;

use ReflectionClass;

trait TransferTrait
{
    function objectToArray($object): array
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

    function errorToArray($errors): array
    {
        $errorArray = [];

        foreach ($errors as $error) {
            $errorArray[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errorArray;
    }
}

