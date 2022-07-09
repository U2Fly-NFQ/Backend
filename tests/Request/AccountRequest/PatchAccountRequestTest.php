<?php

namespace App\Tests\Request\AccountRequest;

use App\Request\AccountRequest\PatchAccountRequest;
use PHPUnit\Framework\TestCase;

class PatchAccountRequestTest extends TestCase
{
    public function testGetImageId()
    {
        $patchAccountRequest = new PatchAccountRequest();
        $patchAccountRequest->setImageId(1);
        $result = $patchAccountRequest->getImageId();

        $this->assertEquals(1, $result);
    }

    public function testGetEmail()
    {
        $patchAccountRequest = new PatchAccountRequest();
        $patchAccountRequest->setEmail('sang@gmail.com');
        $result = $patchAccountRequest->getEmail();

        $this->assertEquals('sang@gmail.com', $result);
    }

    public function testGetRole()
    {
        $patchAccountRequest = new PatchAccountRequest();
        $patchAccountRequest->setRoles(['1'=>'ROLE_ADMIN']);
        $result = $patchAccountRequest->getRoles();

        $this->assertEquals(['1'=>'ROLE_ADMIN'], $result);
    }

    public function testGetPassword()
    {
        $patchAccountRequest = new PatchAccountRequest();
        $patchAccountRequest->setPassword('123');
        $result = $patchAccountRequest->getPassword();

        $this->assertEquals('123', $result);
    }
}
