<?php

namespace App\Validation;

use App\Traits\JsonTrait;
use App\Transformer\ValidationTransformer;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidation
{
    use JsonTrait;

    private ValidatorInterface $validator;
    private ValidationTransformer $validationTransformer;

    /**
     * @param ValidatorInterface $validator
     * @param ValidationTransformer $validationTransformer
     */
    public function __construct(ValidatorInterface $validator, ValidationTransformer $validationTransformer)
    {
        $this->validator = $validator;
        $this->validationTransformer = $validationTransformer;
    }

    /**
     * @param $request
     * @return bool
     * @throws Exception
     */
    public function validate($request): bool
    {
        $errors = $this->validator->validate($request);
        if (count($errors) > 0) {
            throw new Exception();
        }

        return true;
    }
}
