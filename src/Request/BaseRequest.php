<?php

namespace App\Request;

abstract class BaseRequest
{
    const SEATS = [4, 7, 16];

    public function fromArray(?array $requests): self
    {
        foreach ($requests as $key => $request)
        {
            $action = 'set' . ucfirst($key);
            if (!method_exists($this, $action)){
                continue;
            }
            $this->{$action}($request);
        }
        return $this;
    }
}
