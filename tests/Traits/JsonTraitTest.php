<?php

namespace App\Tests\Traits;

use App\Traits\JsonTrait;
use Cassandra\Exception\ValidationException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Exception\ValidatorException;

class JsonTraitTest extends TestCase
{
    use JsonTrait;

    public function testSuccess()
    {
        $data = ['name' => 'tolehoai'];
        $statusCode = 200;
        $result = $this->success($data, $statusCode);
        $expected = new JsonResponse;

        $this->assertEquals($result->getContent(), $expected->setData(["status" => "success", "data" => [
            "name" => "tolehoai"
        ]])->getContent());
    }

    public function testFailed()
    {
        $data = 'something went wrong';
        $statusCode = 400;
        $result = $this->failed($data, $statusCode);
        $expected = new JsonResponse;

        $this->assertEquals($result->getContent(), $expected->setData(["status" => "failed", "data" => 'something went wrong'])->getContent());
    }

    public function testError()
    {
        $data = [];
        $statusCode = 400;
        $result = $this->error($data, $statusCode);
        $expected = new JsonResponse;

        $this->assertEquals($result->getContent(), $expected->setData(['status' => 'error', 'data' => []])->getContent());
    }
}