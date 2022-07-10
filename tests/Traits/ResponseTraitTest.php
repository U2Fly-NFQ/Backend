<?php

namespace App\Tests\Traits;

use App\Traits\JsonTrait;
use App\Traits\ResponseTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;


class ResponseTraitTest extends TestCase
{
    use ResponseTrait;

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


    public function testError()
    {
        $data = ['error' => 'something went wrong'];
        $statusCode = 400;
        $result = $this->error($data, $statusCode);
        $expected = new JsonResponse;

        $this->assertEquals($result->getContent(), $expected->setData(['status' => 'error', 'errors' => ['error' => 'something went wrong']])->getContent());
    }
}