<?php

namespace App\Models;

abstract class CommonResponse
{
    protected string $status;
    protected string $code;
    protected array $data;
    public function __construct(string $status,string $code,array $data)
    {
        $this->status = $status;
        $this->data = $data;
    }
}
