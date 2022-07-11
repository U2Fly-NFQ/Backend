<?php

namespace App\Tests\Validation;

use App\Request\AddAccountRequest;
use App\Request\RateRequest\AddRateRequest;
use App\Transformer\ValidationTransformer;
use App\Validation\RequestValidation;
use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidationTest extends TestCase
{
    public function testValidate()
    {
        $accountRequest = $this->getMockBuilder(AddAccountRequest::class)->disableOriginalConstructor()->getMock();
        $validator = $this->getMockBuilder(ValidatorInterface::class)->disableOriginalConstructor()->getMock();
        $validationTransformer = $this->getMockBuilder(ValidationTransformer::class)->disableOriginalConstructor()->getMock();
        $requestValidation = new RequestValidation($validator, $validationTransformer);
        $result = $requestValidation->validate($accountRequest);

        $this->assertTrue($result);
    }
}
