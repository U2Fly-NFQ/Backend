<?php

namespace App\Transformer;

class ValidationTransformer
{
    public function toArray($errors): array
    {
        $result = [];
        foreach ($errors as $error) {
            $result[$error->getPropertyPath()] = $error->getMessage();
        }

        return $result;
    }
}
