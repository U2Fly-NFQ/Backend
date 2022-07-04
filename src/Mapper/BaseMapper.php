<?php

namespace App\Mapper;

class BaseMapper
{
    protected function map($entity, $value, $field): void
    {
        $setter = 'set' . ucfirst($field);
        if($value){
            $entity->{$setter}($value);
        }
    }
}
