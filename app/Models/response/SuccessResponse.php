<?php

namespace App\Models;

use App\Models\CommonResponse;

class SuccessResponse extends CommonResponse
{
    public function __construct(string $code, array $data)
    {
        parent::__construct("ok", $code, $data);
    }
}
