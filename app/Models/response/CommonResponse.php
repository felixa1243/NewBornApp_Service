<?php

namespace App\Models\response;

abstract class CommonResponse
{
    public string $status;
    public string $code;
    public array|null $data;

    public function __construct(string $status, string $code, array|null $data)
    {
        $this->status = $status;
        $this->data = $data;
    }

}
