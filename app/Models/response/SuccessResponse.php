<?php

namespace App\Models\response;

class SuccessResponse extends CommonResponse
{
    public function __construct(string $code, array $data)
    {
        parent::__construct("ok", $code, $data);
    }
}
